<?php

    // Lists all items in a given hierarchy's framework

    require_once('../config.php');
    require_once('./lib.php');
    require_once('./filters/lib.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->libdir.'/tablelib.php');
    require_once($CFG->dirroot.'/competency/show_options_form.php');
    require_once($CFG->dirroot.'/competency/download_form.php');

    define('DEFAULT_PAGE_SIZE', 20);
    define('SHOW_ALL_PAGE_SIZE', 5000);

    /// Setup page
    $sitecontext    = get_context_instance(CONTEXT_SYSTEM);
    $spage          = optional_param('spage', 0, PARAM_INT);                     // which page to show
    $perpage        = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);  // how many per page
    $edit           = optional_param('edit', -1, PARAM_BOOL);

    // Get params
    $frameworkid = optional_param('frameworkid', 0, PARAM_INT);
    $hide        = optional_param('hide', 0, PARAM_INT);
    $show        = optional_param('show', 0, PARAM_INT);
    $moveup      = optional_param('moveup', 0, PARAM_INT);
    $movedown    = optional_param('movedown', 0, PARAM_INT);

    // table display options
    $showoptions = optional_param('showoptions', null, PARAM_BOOL);
    $hidecustomfields  = optional_param('hidecustomfields', null, PARAM_BOOL);
    $showitemfullname  = optional_param('showitemfullname', null, PARAM_BOOL);
    $showdepthfullname = optional_param('showdepthfullname', null, PARAM_BOOL);

    $hierarchy         = new competency();

    // Cache user capabilities
    $can_add_item    = has_capability('moodle/local:create'.$hierarchy->prefix, $sitecontext);
    $can_edit_item   = has_capability('moodle/local:update'.$hierarchy->prefix, $sitecontext);
    $can_delete_item = has_capability('moodle/local:delete'.$hierarchy->prefix, $sitecontext);
    $can_add_depth   = has_capability('moodle/local:create'.$hierarchy->prefix.'depth', $sitecontext);
    $can_edit_depth  = has_capability('moodle/local:update'.$hierarchy->prefix.'depth', $sitecontext);

    // Load framework
    $framework  = $hierarchy->get_framework($frameworkid);

    if ($can_edit_item || $can_delete_item || $can_add_depth || $can_edit_depth) {
        $options = array('frameworkid' => $framework->id, 'spage' => $spage);
        $navbaritem = $hierarchy->get_editing_button($edit, $options);
        $editingon = !empty($USER->{$hierarchy->prefix.'editing'});
    } else {
        $navbaritem = '';
    }

    // Setup page and check permissions
    admin_externalpage_setup($hierarchy->prefix.'manage', $navbaritem);

    // Get the framework depths
    $depths = $hierarchy->get_depths($framework->id);

// Link to add depth form
if (!$depths) {

    // Display page
    admin_externalpage_print_header();

    $hierarchy->display_framework_selector();

    print_heading(get_string('nodepthlevels', $hierarchy->prefix));

    // Print button to add a depth level
    if ($can_add_depth) {
        echo '<div class="buttons">';

        $options = array('frameworkid' => $framework->id);
        print_single_button($CFG->wwwroot.'/'.$hierarchy->prefix.'/depth/edit.php', $options, get_string('adddepthlevel', $hierarchy->prefix), 'get');

        echo '</div>';
    }

    print_footer();
    exit();
}

    ///
    /// Process any actions
    ///
    if ($editingon) {
        require_capability('moodle/local:update'.$hierarchy->prefix, $sitecontext);

        // Hide an item
        if ($hide) {
            $hierarchy->hide_item($hide);
        } elseif ($show) {
           $hierarchy->show_item($show);
        } elseif ($moveup) {
            $hierarchy->move_item($moveup, true);
        } elseif ($movedown) {
            $hierarchy->move_item($movedown, false);
        }
    } // End of editing stuff


    $returnurl = "{$CFG->wwwroot}/competency/index.php";
    $urlparams = array();
    if($frameworkid != 0) {
        $urlparams[] = "frameworkid=$frameworkid";
    }
    if($spage != 0) {
        $urlparams[] = "spage=$spage";
    }
    if(count($urlparams) > 0) {
        $returnurl .= '?'.implode('&amp;', $urlparams);
    }

    // display options form 
    $display_options = new competency_show_options_form(null, compact('framework','spage'));

    if ($display_options->is_cancelled()) {
        redirect($returnurl);
    }
    else if ($fromform = $display_options->get_data()) {
        if (empty($fromform->submitbutton)) {
            print_error('unknownbuttonclicked', 'competency', $returnurl);
        }

        $todb = new object();
        if(!isset($fromform->hidecustomfields)) {
            $fromform->hidecustomfields = 0;
        }
        $todb->hidecustomfields = $fromform->hidecustomfields;
        
        if(!isset($fromform->showitemfullname)) {
            $fromform->showitemfullname = 0;
        }
        $todb->showitemfullname = $fromform->showitemfullname;

        if(!isset($fromform->showdepthfullname)) {
            $fromform->showdepthfullname = 0;
        }
        $todb->showdepthfullname = $fromform->showdepthfullname;
        $todb->id = $fromform->frameworkid; 

        if(!update_record('competency_framework', $todb)) {
            print_error('cannotupdatedisplaysettings', 'competency', $returnurl);
        }
        redirect($returnurl);

    } else {
        $toform = new object();
        $toform->hidecustomfields = $framework->hidecustomfields;
        $toform->showitemfullname = $framework->showitemfullname;
        $toform->showdepthfullname = $framework->showdepthfullname;
        $display_options->set_data($toform);
    }


    // download form
    $download = new competency_download_form();
    if ($fromform = $download->get_data()) {
        // TODO set session data. What do we need to send?
        redirect($CFG->wwwroot.'/competency/download_competencies.php');
    }    

   
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

    $hierarchy->display_framework_selector();

    $select = "SELECT id, depthid, shortname, fullname, visible, evidencecount";
    $from   = " FROM {$CFG->prefix}{$hierarchy->prefix}";
    $where  = " WHERE frameworkid=$framework->id";
    $sort   = " ORDER BY sortorder";

    // create the competency filter form
    $cfiltering = new competency_filtering();
    $extrasql = $cfiltering->get_sql_filter();
    if ($extrasql !== '') {
        $extrasql = ' AND '.$extrasql;
    }

    $matchcount = count_records_sql('SELECT COUNT (DISTINCT id) '.$from.$where);
    $filteredmatchcount = count_records_sql('SELECT COUNT (DISTINCT id) '.$from
        .$where.$extrasql);

    if ($extrasql !== '') {
        print_heading("$filteredmatchcount / $matchcount ".get_string('competencies', 'competency'));
        $matchcount = $filteredmatchcount;
    } else {
        print_heading("$matchcount ".get_string('competencies', 'competency'));
    }


    if (!$framework->hidecustomfields) {
        // Retreive visible customfields definitions
        $sql = "SELECT cdf.id, cdf.depthid, cdf.shortname, cdf.fullname, cdf.hidden
                FROM {$CFG->prefix}{$hierarchy->prefix}_depth_info_field cdf
                JOIN {$CFG->prefix}{$hierarchy->prefix}_depth_info_category cdc
                    ON cdc.id=cdf.categoryid
                JOIN {$CFG->prefix}{$hierarchy->prefix}_depth cd
                    ON cd.id=cdf.depthid
                WHERE cd.frameworkid=$framework->id AND cdf.hidden=0
                ORDER BY cdc.depthid, cdc.sortorder, cdf.sortorder";

        $customfields = get_records_sql($sql);
        $customfieldtrack  = array();
    }
    $colcount = 0;

    $tablecolumns   = array(); // all columns
    $tablecolumnscf = array(); // just the customfield columns
    $tableheaders   = array();

    foreach ($depths as $depth) {

        $tablecolumns[] = format_string($depth->fullname);
        $tablecolumnsd[] = format_string($depth->fullname);

        if ($framework->showdepthfullname) {
            $header = format_string($depth->fullname);
        } else {
            $header = format_string($depth->shortname);
        }
        if ($editingon && $can_edit_depth) {
            $header .= "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/depth/edit.php?id={$depth->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a> ".
                "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/depth/customfields/index.php?depthid={$depth->id}\" title=\"$str_customfields\">".
                "<img src=\"{$CFG->pixpath}/t/customfields.gif\" class=\"iconsmall\" alt=\"$str_customfields\" /></a>";
        }
        $tableheaders[] = $header;
        $colcount++;

        if (!$framework->hidecustomfields && !empty($customfields)) {
            $customfieldcount = 0;
            foreach ($customfields as $customfield) {
                if (!$customfield->hidden && $customfield->depthid == $depth->id) {
                    $tablecolumns[] = format_string($depth->fullname).'-'.format_string($customfield->fullname);
                    $tablecolumnscf[] = format_string($depth->fullname).'-'.format_string($customfield->fullname);
                    $header = format_string($customfield->fullname);
                    if ($editingon && $can_edit_depth) {
                        $header .= ' <a title="'.$str_edit.'" href="'.$CFG->wwwroot.'/'.$hierarchy->prefix.'/depth/customfields/index.php?id='.$customfield->id.'&amp;depthid='.$depth->id.'&amp;action=editfield"><img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.$str_edit.'" class="iconsmall" /></a>';
                    }
                    $tableheaders[] = $header;
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
    $coledit = $colcount;
    $colcount++;

    $table = new flexible_table($hierarchy->prefix.'-framework-index-'.$framework->id);

    $table->define_columns($tablecolumns);
    $table->define_headers($tableheaders);
    foreach ($tablecolumnscf as $tablecolumncf) {
        $table->column_style($tablecolumncf,'text-align','center');
    }
    $table->column_style('edit','width','80px');
    $table->column_style('evidence','text-align','center');

    $table->set_attribute('cellspacing', '0');
    $table->set_attribute('id', $hierarchy->prefix);
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


    $table->pagesize($perpage, $matchcount);

    $itemlist = get_recordset_sql($select.$from.$where.$extrasql.$sort,
            $table->get_page_start(),  $table->get_page_size());

    $itemsfound = false;   // track if we found any items

    if ($itemlist)  {

        $itemtrack       = array(); // track all the items found, used after the loop to add custom data for each item
        $depthidtrack    = 0;       // flag if we've moved to a new depthid in the loop
        $moveiconup      = false;   // the up icon is needed for an item (down icon is handled after)
        $data = array();
        $i = 0;

        while ($item = rs_fetch_next_record($itemlist)) {

            $itemsfound = true;

            $j = 0;
            foreach ($depths as $depth) {

                if ($depth->id == $item->depthid) {
                    $cssclass = !$item->visible ? 'class="dimmed"' : '';
                    $itemname = $framework->showitemfullname ? $item->fullname : $item->shortname;
                    $cell = "<a $cssclass href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/view.php?id={$item->id}\">{$itemname}</a>";
                    $data[$i][$j] = $cell;
                    if ($editingon) {
                        $moveiconup   = false;
                        if ($depthidtrack != 0 && $depth->depthlevel == 0) { // it's not the first and we're at the top level
                            $moveiconup   = true;
                        } elseif ($depthidtrack == $depth->id) {
                            // depthid hasn't changed so the item can move up and the last one can move down
                            $moveiconup       = true;
                            $data[$i-1][$coledit-1] .= "<a href=\"index.php?movedown=".end($itemtrack)."\" title=\"$str_movedown\">".
                                     "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a> ";
                        }
                        $depthidtrack = $depth->id;
                    }
                } else {
                    $data[$i][$j] = '';
                }
                $j++;
                if (!$framework->hidecustomfields && !empty($customfieldtrack)) {
                    for ($k=0; $k < $customfieldtrack[$depth->depthlevel]; $k++) {
                        $data[$i][$j] = '';
                        $j++;
                    }
                }
            }

            // Add edit and delete buttons
            if ($editingon) {
                $buttons = array();
                if ($can_edit_item) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/edit.php?id={$item->id}\" title=\"$str_edit\">".
                        "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

                    if ($item->visible) {
                        $buttons[] = "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/index.php?hide={$item->id}\" title=\"$str_hide\">".
                            "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
                    } else {
                        $buttons[] = "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/index.php?show={$item->id}\" title=\"$str_show\">".
                            "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
                    }
                }
                if ($can_delete_item) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/delete.php?id={$item->id}&spage={$spage}\" title=\"$str_delete\">".
                        "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
                }
                if ($moveiconup) {
                    $buttons[] = "<a href=\"index.php?moveup={$item->id}\" title=\"$str_moveup\">".
                        "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a> ";
                } else {
                   $buttons[] = $str_spacer;
                }
                $data[$i][$j] = implode($buttons, ' ');
                $j++;
            }

            // Evidence items
            $data[$i][$j] = "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/view.php?id={$item->id}\">{$item->evidencecount}</a>";

            $i++;
            $itemtrack[] = $item->id;
        }

        if ($itemsfound) {
            if ($framework->hidecustomfields) {
            // Go ahead and print the tabledata   

                for ($i=0; $i < count($itemtrack); $i++) {
                    $tabledata = array();
                    for ($j=0; $j < $colcount; $j++) {
                        $tabledata[] = $data[$i][$j];
                    }
                    $table->add_data($tabledata);
                }

            } else {
            // Get the custom data and populate the table

                $select = "SELECT c.id as itemid, cdf.depthid, cdf.id as fieldid, cdd.data";
                $from   = " FROM {$CFG->prefix}{$hierarchy->prefix} c
                        LEFT OUTER JOIN {$CFG->prefix}{$hierarchy->prefix}_depth_info_field cdf
                            ON cdf.depthid=c.depthid
                        LEFT OUTER JOIN {$CFG->prefix}{$hierarchy->prefix}_depth_info_data cdd
                            ON cdd.fieldid=cdf.id AND cdd.{$hierarchy->prefix}id=c.id";
                $where  = " WHERE c.frameworkid=$framework->id AND c.id IN (".implode(",", $itemtrack).") AND cdf.hidden=0";
                $sort   = " ORDER BY c.sortorder, cdf.categoryid, cdf.sortorder";

                $customdatalist = get_recordset_sql($select.$from.$where.$sort);

                if ($customdatalist) {

                    $customdatafound = false;
                    $itemid=0;
                    $depthid=0;
                    $i=0;
                    $j=0;

                    // Add the custom data to the array
                    while ($customdata = rs_fetch_next_record($customdatalist)) {

                        $customdatafound = true;

                        if ($itemid != $customdata->itemid) {

                            if (empty($itemid)) {

                                // Initialise the first item
                                $itemid  = $customdata->itemid;
                                $depthid = $customdata->depthid;

                            } else {

                                // We've got all the data for the last item
                                // So we can add it to the table
                                $tabledata = array();
                                for ($k=0; $k < $colcount; $k++) {
                                    $tabledata[] = $data[$i][$k];
                                }
                                $table->add_data($tabledata);

                                // Now continue with the new item
                                $itemid  = $customdata->itemid;
                                $depthid = $customdata->depthid;
                                $i++;
                                $j=0;

                            }

                            // Advance to the column starting with depthid
                            foreach ($depths as $depth) {
                                $j++; // add one for the item
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
                if ($customdatafound) {

                    // We need add the last row
                    $tabledata = array();
                    for ($k=0; $k < $colcount; $k++) {
                        $tabledata[] = $data[$i][$k];
                    }
                    $table->add_data($tabledata);

                } else {

                    // We need to add all the rows
                    for ($i=0; $i < count($itemtrack); $i++) {
                        $tabledata = array();
                        for ($j=0; $j < $colcount; $j++) {
                            $tabledata[] = $data[$i][$j];
                        }
                        $table->add_data($tabledata);
                    }
                }
            }
        } else {
            $table->add_data(array());
        }
        rs_close($itemlist);
    }

    // add filters
    $cfiltering->display_add();
    $cfiltering->display_active();

    // show options form or link
    if($showoptions) {
        $display_options->display();
    } else {
        if (strpos($returnurl, '?') !== false) {
            $showurl = "{$returnurl}&amp;showoptions=1";
        } else {
            $showurl = "{$returnurl}?showoptions=1";
        }
        print "<p><a href=\"$showurl\">".get_string('showdisplayoptions', 'competency').'</a></p>';
    }

    // Display table
    $table->print_html();

    if (!$itemsfound) {
        echo "<i>".get_string('nocompetency', 'competency')."</i><br><br>";
    } else {
        $download->display();
    }

    // Editing buttons
    echo '<div class="buttons">';
    if ($can_add_item) {
        $hierarchy->display_add_item_button($spage);
    }
    if ($can_add_depth) {
        $hierarchy->display_add_depth_button($spage);
    }
    echo '</div>';

    print_footer();

