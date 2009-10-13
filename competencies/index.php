<?php

// Lists all competencies in a given framework

require_once('../config.php');
require_once('./lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');

define('DEFAULT_PAGE_SIZE', 20);
define('SHOW_ALL_PAGE_SIZE', 5000);

///
/// Setup / loading data
///

$sitecontext    = get_context_instance(CONTEXT_SYSTEM);
$page           = optional_param('page', 0, PARAM_INT);                     // which page to show
$perpage        = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);  // how many per page
$competencyedit = optional_param('competencyedit', -1, PARAM_BOOL);

// Get params
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);
$hide        = optional_param('hide', 0, PARAM_INT);
$show        = optional_param('show', 0, PARAM_INT);
$moveup      = optional_param('moveup', 0, PARAM_INT);
$movedown    = optional_param('movedown', 0, PARAM_INT);

$hidecustomfields       = false;
$showcompetencyfullname = true;
$showdepthfullname      = true;

// Load framework
// If no framework id supplied, use default
if ($frameworkid == 0) {
    if (!$framework = get_record('competency_framework', 'isdefault', 1)) {
        error('Default competency framework does not exist');
    }

    $frameworkid = $framework->id;
} else {
    if (!$framework = get_record('competency_framework', 'id', $frameworkid)) {
        error('Competency framework does not exist');
    }
}

// Handle editing toggling
$options = array('frameworkid' => $frameworkid);
if (update_competency_button()) {
    if ($competencyedit !== -1) {
        $USER->competencyediting = $competencyedit;
    }
    $editingon = !empty($USER->competencyediting);
    $navbaritem = update_competency_button($options); // Must call this again after updating the state.
} else {
    $navbaritem = '';
    $editingon = false;
}

// Setup page and check permissions
admin_externalpage_setup('competencymanage', $navbaritem);


// Cache user capabilities
$can_add_comp = has_capability('moodle/local:createcompetencies', $sitecontext);
$can_edit_comp = has_capability('moodle/local:updatecompetencies', $sitecontext);
$can_delete_comp = has_capability('moodle/local:deletecompetencies', $sitecontext);
$can_add_depth = has_capability('moodle/local:createcompetencydepth', $sitecontext);
$can_edit_depth = has_capability('moodle/local:updatecompetencydepth', $sitecontext);


// Get competency depths
$depths = get_records('competency_depth', 'frameworkid', $framework->id, 'id');

// Link to add depth form
if (!$depths) {

    // Display page
    admin_externalpage_print_header();

    // Show framework selector
    $frameworks = get_records('competency_framework', 'visible', 1);

    if (count($frameworks) > 1) {
        $fwoptions = array();

        foreach ($frameworks as $fw) {
            $fwoptions[$fw->id] = $fw->fullname;
        }

        echo '<div class="frameworkpicker">';
        popup_form($CFG->wwwroot.'/competencies/index.php?frameworkid=', $fwoptions, 'switchframework', $framework->id, '');
        echo '</div>';
    }

    print_heading(get_string('nodepthlevels', 'competencies'));

    // Print button to add a depth level
    if ($can_add_depth) {
        echo '<div class="buttons">';

        $options = array('frameworkid' => $framework->id);
        print_single_button($CFG->wwwroot.'/competencies/depth/edit.php', $options, get_string('adddepthlevel', 'competencies'), 'get');

        echo '</div>';
    }

    print_footer();
    exit();
}


///
/// Process any actions
///

if ($editingon) {
    // Hide or show a competency
    if ((!empty($hide) or !empty($show))) {
        require_capability('moodle/local:updatecompetencies', $sitecontext);

        if (!empty($hide)) {
            $competency = get_record('competency', 'id', $hide);
            $visible = 0;
        } else {
            $competency = get_record('competency', 'id', $show);
            $visible = 1;
        }

        if ($competency) {
            if (!set_field('competency', 'visible', $visible, 'id', $competency->id)) {
                notify('Could not update that competency!');
            }
        }
    }

    /// Reorder a competency
    if ((!empty($moveup) or !empty($movedown))) {
        require_capability('moodle/local:updatecompetencies', $sitecontext);
        $movecompetency = NULL;
        $swapcompetency = NULL;

        // ensure the competency order has no gaps and isn't at 0
//        fix_competency_sortorder($category->id);

        // we are going to need to know the range
        $max = get_record_sql('SELECT MAX(sortorder) AS max, 1
                FROM ' . $CFG->prefix . 'competency WHERE frameworkid=' . $frameworkid);
        $max = $max->max + 100;

        if (!empty($moveup)) {
            $movecompetency = get_record('competency', 'id', $moveup);
            $swapcompetency = get_record('competency', 'frameworkid',  $frameworkid,
                    'sortorder', $movecompetency->sortorder - 1);
        } else {
            $movecompetency = get_record('competency', 'id', $movedown);
            $swapcompetency = get_record('competency', 'frameworkid',  $frameworkid,
                    'sortorder', $movecompetency->sortorder + 1);
        }

        if ($swapcompetency and $movecompetency) {
            // Renumber everything for robustness
            begin_sql();
            if (!(    set_field('competency', 'sortorder', $max, 'id', $swapcompetency->id)
                   && set_field('competency', 'sortorder', $swapcompetency->sortorder, 'id', $movecompetency->id)
                   && set_field('competency', 'sortorder', $movecompetency->sortorder, 'id', $swapcompetency->id)
                )) {
                notify('Could not update that competency!');
            }
            commit_sql();
        }
    }
} // End of editing stuff


///
/// Load competencies after any changes
///

// Get competencies for this page
$competencies = get_records('competency', 'frameworkid', $framework->id, 'sortorder');


///
/// Generate / display page
///
$str_edit         = get_string('edit');
$str_delete       = get_string('delete');
$str_moveup       = get_string('moveup');
$str_movedown     = get_string('movedown');
$str_hide         = get_string('hide');
$str_show         = get_string('show');
$str_customfields = get_string('customfields', 'customfields');
$str_spacer       = "<img src=\"{$CFG->wwwroot}/pix/spacer.gif\" class=\"iconsmall\" alt=\"\" /> ";

// Display page
admin_externalpage_print_header();

    // Show framework selector
    $frameworks = get_records('competency_framework', 'visible', 1);

    if (count($frameworks) > 1) {
        $fwoptions = array();

        foreach ($frameworks as $fw) {
            $fwoptions[$fw->id] = $fw->fullname;
        }

        echo '<div class="frameworkpicker">';
        popup_form($CFG->wwwroot.'/competencies/index.php?frameworkid=', $fwoptions, 'switchframework', $framework->id, '');
        echo '</div>';
    }

    $select = "SELECT id, depthid, shortname, fullname, visible";
    $from   = " FROM {$CFG->prefix}competency";
    $where  = " WHERE frameworkid=$frameworkid";
    $sort   = " ORDER BY sortorder";

    if (!$hidecustomfields) {
        // Retreive visible customfields definitions
        $sql = "SELECT cdf.id, cdf.depthid, cdf.shortname, cdf.fullname
                FROM {$CFG->prefix}competency_depth_info_field cdf
                JOIN {$CFG->prefix}competency_depth_info_category cdc
                    ON cdc.id=cdf.categoryid
                JOIN {$CFG->prefix}competency_depth cd
                    ON cd.id=cdf.depthid
                WHERE cd.frameworkid=$frameworkid AND cdf.hidden=0
                ORDER BY cdc.depthid, cdc.sortorder, cdf.sortorder";

        $customfields = get_records_sql($sql);
        $customfieldtrack  = array();
    }
    $colcount = 0;

    $tablecolumns = array();
    $tableheaders = array();

    foreach ($depths as $depth) {

        $tablecolumns[] = format_string($depth->fullname);

        if ($showdepthfullname) {
            $header = format_string($depth->fullname);
        } else {
            $header = format_string($depth->shortname);
        }
        if ($editingon && $can_edit_depth) {
            $header .= "<a href=\"{$CFG->wwwroot}/competencies/depth/edit.php?id={$depth->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a> ".
                "<a href=\"{$CFG->wwwroot}/competencies/depth/customfields/index.php?depthid={$depth->id}\" title=\"$str_customfields\">".
                "<img src=\"{$CFG->pixpath}/t/customfields.gif\" class=\"iconsmall\" alt=\"$str_customfields\" /></a>";
        }
        $tableheaders[] = $header;
        $colcount++;

        if (!$hidecustomfields) {
            $customfieldcount = 0;
            foreach ($customfields as $customfield) {
                if (!$customfield->hidden && $customfield->depthid == $depth->id) {
                    $tablecolumns[] = format_string($depth->fullname).'-'.format_string($customfield->fullname);
                    $tableheaders[] = format_string($customfield->fullname);
                    $customfieldcount++;
                    $colcount++;
                }
            }
            $customfieldtrack[$depth->depthlevel] = $customfieldcount;
        }
    }

    if ($editingon) {
        $tablecolumns[] = "edit";
        $tableheaders[] = "Edit";
        $colcount++;
    }

    $tablecolumns[] = "evidence";
    $tableheaders[] = "Evidence items";
    $colcount++;

    $table = new flexible_table('competency-framework-index-'.$frameworkid);

    $table->define_columns($tablecolumns);
    $table->define_headers($tableheaders);
    $table->define_baseurl($baseurl);

    $table->set_attribute('cellspacing', '0');
    $table->set_attribute('id', 'competencies');
    $table->set_attribute('class', 'generaltable generalbox');

    $table->set_control_variables(array(
                TABLE_VAR_SORT    => 'ssort',
                TABLE_VAR_HIDE    => 'shide',
                TABLE_VAR_SHOW    => 'sshow',
                TABLE_VAR_IFIRST  => 'sifirst',
                TABLE_VAR_ILAST   => 'silast',
                TABLE_VAR_PAGE    => 'spage'
                ));
    $table->setup();

    $table->initialbars(true);

    $matchcount = count_records_sql('SELECT COUNT (DISTINCT id) '.$from.$where);

    $table->pagesize($perpage, $matchcount);

    $competencylist = get_recordset_sql($select.$from.$where.$wheresearch.$sort,
            $table->get_page_start(),  $table->get_page_size());

    if ($competencylist)  {

        $competenciesfound = false;
        $competencytrack = array();
        $data = array();
        $i = 0;

        while ($competency = rs_fetch_next_record($competencylist)) {

            $competenciesfound = true;

            $j = 0;
            foreach ($depths as $depth) {

                if ($depth->id == $competency->depthid) {
                    $cssclass = !$competency->visible ? 'class="dimmed"' : '';
                    $competencyname = $showcompetencyfullname ? $competency->fullname : $competency->shortname;
                    $cell = "<a $cssclass href=\"{$CFG->wwwroot}/competencies/view.php?id={$competency->id}\">{$competencyname}</a>";
                    $data[$i][$j] = $cell;
                } else {
                    $data[$i][$j] = '';
                }
                $j++;
                if (!$hidecustomfields) {
                    for ($k=0; $k < $customfieldtrack[$depth->depthlevel]; $k++) {
                        $data[$i][$j] = '';
                        $j++;
                    }
                }
            }

            // Add edit and delete buttons
            if ($editingon) {
                $buttons = array();
                if ($can_edit_comp) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/edit.php?id={$competency->id}\" title=\"$str_edit\">".
                        "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

                    if ($competency->visible) {
                        $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/index.php?hide={$competency->id}\" title=\"$str_hide\">".
                            "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
                    } else {
                        $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/index.php?show={$competency->id}\" title=\"$str_show\">".
                            "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
                    }
                }
                if ($can_delete_comp) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/delete.php?id={$competency->id}\" title=\"$str_delete\">".
                        "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
                }
                if ($competency->depthid > 1) {
                    $up = true;
                    $down = true;

                    if ($up) {
                        $buttons[] = "<a href=\"index.php?moveup={$competency->id}\" title=\"$str->moveup\">".
                            "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str->moveup\" /></a> ";
                    } else {
                       $buttons[] = $str_spacer;
                    }
                    if ($down) {
                        $buttons[] = "<a href=\"index.php?movedown={$competency->id}\" title=\"$str_moveup\">".
                            "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a> ";
                    } else {
                       $buttons[] = $str_spacer;
                    }
                }
                $data[$i][$j] = implode($buttons, ' ');
                $j++;
            }

            // Evidence items
            $data[$i][$j] = '0';

            $i++;
            $competencytrack[] = $competency->id;
        }

        if ($competenciesfound) {
            if ($hidecustomfields) {
            // Go ahead and print the tabledata   

                for ($i=0; $i < count($competencytrack); $i++) {
                    $tabledata = array();
                    for ($j=0; $j < $colcount; $j++) {
                        $tabledata[] = $data[$i][$j];
                    }
                    $table->add_data($tabledata);
                }

            } else {
            // Get the custom data and populate the table

                $select = "SELECT c.id as competencyid, cdf.depthid, cdf.id as fieldid, cdd.data";
                $from   = " FROM {$CFG->prefix}competency c
                        LEFT OUTER JOIN {$CFG->prefix}competency_depth_info_field cdf 
                            ON cdf.depthid=c.depthid 
                        LEFT OUTER JOIN {$CFG->prefix}competency_depth_info_data cdd 
                            ON cdd.fieldid=cdf.id AND cdd.competencyid=c.id";
                $where  = " WHERE c.frameworkid=$frameworkid AND c.id IN (".implode(",", $competencytrack).") AND cdf.hidden=0";
                $sort   = " ORDER BY c.sortorder, cdf.categoryid, cdf.sortorder";

                $customdatalist = get_recordset_sql($select.$from.$where.$wheresearch.$sort);

                if ($customdatalist) {

                    $competencyid=0;
                    $depthid=0;
                    $i=0;
                    $j=0;

                    // Add the custom data to the array
                    while ($customdata = rs_fetch_next_record($customdatalist)) {

                        if ($competencyid != $customdata->competencyid) {

                            if (empty($competencyid)) {

                                // Initialise the first competency
                                $competencyid = $customdata->competencyid;
                                $depthid      = $customdata->depthid;

                            } else {

                                // We've got all the data for the last competency
                                // So we can add it to the table
                                $tabledata = array();
                                for ($k=0; $k < $colcount; $k++) {
                                    $tabledata[] = $data[$i][$k];
                                }
                                $table->add_data($tabledata);

                                // Now continue with the new competency
                                $competencyid = $customdata->competencyid;
                                $depthid      = $customdata->depthid;
                                $i++;
                                $j=0;

                            }

                            // Advance to the column starting with depthid
                            foreach ($depths as $depth) {
                                $j++; // add one for the competency
                                if ($depth->id == $depthid) {
                                    break;
                                } else {
                                    $j += $customfieldtrack[$depth->depthlevel];
                                }
                            }
                        }

                        $data[$i][$j] = $customdata->data;
                        $j++;

                    }
                }
            }
        }
    }

    // Display table
    $table->print_html();

    // Editing buttons
    if ($can_add_comp || $can_add_depth) {
        echo '<div class="buttons">';

        // Print button for creating new competency
        if ($can_add_comp) {
            $options = array('frameworkid' => $framework->id);
            print_single_button($CFG->wwwroot.'/competencies/edit.php', $options, get_string('addnewcompetency', 'competencies'), 'get');
        }

        // Print button to add a depth level
        if ($can_add_depth) {
            $options = array('frameworkid' => $framework->id);
            print_single_button($CFG->wwwroot.'/competencies/depth/edit.php', $options, get_string('adddepthlevel', 'competencies'), 'get');
        }


        echo '</div>';
    }

    print_footer();

    if ($competencylist) {
        rs_close($competencylist);
    }

