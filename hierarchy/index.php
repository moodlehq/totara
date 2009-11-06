<?php

    // Lists all items in a given hierarchy's framework

    require_once('../config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->libdir.'/tablelib.php');
    require_once($CFG->dirroot.'/hierarchy/lib.php');
    require_once($CFG->dirroot.'/hierarchy/filters/lib.php');
    require_once($CFG->dirroot.'/hierarchy/show_options_form.php');
    require_once($CFG->dirroot.'/hierarchy/download_form.php');

    define('DEFAULT_PAGE_SIZE', 20);
    define('SHOW_ALL_PAGE_SIZE', 5000);

    global $SESSION;
    $sitecontext    = get_context_instance(CONTEXT_SYSTEM);

    /// Hierarchy type, framework params
    $type           = required_param('type', PARAM_SAFEDIR);
    $frameworkid    = optional_param('frameworkid', 0, PARAM_INT);

    // Page display params
    $spage          = optional_param('spage', 0, PARAM_INT);                     // which page to show
    $perpage        = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);  // how many per page

    // Editing params
    $edit        = optional_param('edit', -1, PARAM_BOOL);
    $hide        = optional_param('hide', 0, PARAM_INT);
    $show        = optional_param('show', 0, PARAM_INT);
    $moveup      = optional_param('moveup', 0, PARAM_INT);
    $movedown    = optional_param('movedown', 0, PARAM_INT);

    // Table display params
    $showoptions       = optional_param('showoptions', null, PARAM_BOOL);
    $hidecustomfields  = optional_param('hidecustomfields', null, PARAM_BOOL);
    $showitemfullname  = optional_param('showitemfullname', null, PARAM_BOOL);
    $showdepthfullname = optional_param('showdepthfullname', null, PARAM_BOOL);

    // Confirm the type exists
    if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
        require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
    } else {
        print_error('error:hierarchytypenotfound', 'hierarchy', $CFG->wwwroot, $type, 'hierarchy');
    }

    $hierarchy = new $type();

    // Cache user capabilities
    $can_add_item    = has_capability('moodle/local:create'.$type, $sitecontext);
    $can_edit_item   = has_capability('moodle/local:update'.$type, $sitecontext);
    $can_delete_item = has_capability('moodle/local:delete'.$type, $sitecontext);
    $can_add_depth   = has_capability('moodle/local:create'.$type.'depth', $sitecontext);
    $can_edit_depth  = has_capability('moodle/local:update'.$type.'depth', $sitecontext);

    // Load framework
    $framework   = $hierarchy->get_framework($frameworkid);
    $frameworkid = $framework->id;

    // Display editing button in navbar
    if ($can_edit_item || $can_delete_item || $can_add_depth || $can_edit_depth) {
        $options = array('type' => $type, 'frameworkid' => $frameworkid, 'spage' => $spage);
        $navbaritem = $hierarchy->get_editing_button($edit, $options);
        $editingon = !empty($USER->{$type.'editing'});
    } else {
        $navbaritem = '';
    }

    // Setup page and check permissions
    admin_externalpage_setup($type.'manage', $navbaritem);

    // Build return url path
    $returnurl = "{$CFG->wwwroot}/hierarchy/index.php";
    $urlparams = array();
    $urlparams[] = "type=$type";
    if($frameworkid != 0) {
        $urlparams[] = "frameworkid=$frameworkid";
    }
    if($spage != 0) {
        $urlparams[] = "spage=$spage";
    }
    if(count($urlparams) > 0) {
        $returnurl .= '?'.implode('&amp;', $urlparams);
    }

    // Get the framework depths
    $depths = $hierarchy->get_depths($frameworkid);

    // If no depths, add depth form
    if (!$depths) {

        // Display page
        admin_externalpage_print_header();

        $hierarchy->display_framework_selector();

        print_heading(get_string('nodepthlevels', $type));

        // Print button to add a depth level
        if ($can_add_depth) {
            echo '<div class="buttons">';

            $options = array('type' => $type, 'frameworkid' => $frameworkid);
            print_single_button($CFG->wwwroot.'/hierarchy/depth/edit.php', $options, get_string('adddepthlevel', $type), 'get');

            echo '</div>';
        }

        print_footer();
        exit();
    }

    ///
    /// Get database info
    ///

    // prepare SQL to get page data
    $select = "SELECT id, depthid, shortname, fullname, visible";
    if(!empty($hierarchy->extrafield)) {
        $select .= ', '.$hierarchy->extrafield;
    }
    $from   = " FROM {$CFG->prefix}{$type}";
    $where  = " WHERE frameworkid=$frameworkid";
    $sort   = " ORDER BY sortorder";

    // create the filter form
    $filtering = new hierarchy_filtering($type, null, $returnurl);
    $extrasql = $filtering->get_sql_filter();
    if ($extrasql !== '') {
        $extrasql = ' AND '.$extrasql;
    }

    $matchcount = count_records_sql('SELECT COUNT (DISTINCT id) '.$from.$where);
    $filteredmatchcount = count_records_sql('SELECT COUNT (DISTINCT id) '.$from
        .$where.$extrasql);

    if ($extrasql !== '') {
        $matchcount = $filteredmatchcount;
    }

    if (!$framework->hidecustomfields) {
        // Retreive visible customfields definitions
        $sql = "SELECT cdf.id, cdf.depthid, cdf.shortname, cdf.fullname, cdf.hidden
                FROM {$CFG->prefix}{$type}_depth_info_field cdf
                JOIN {$CFG->prefix}{$type}_depth_info_category cdc
                    ON cdc.id=cdf.categoryid
                JOIN {$CFG->prefix}{$type}_depth cd
                    ON cd.id=cdf.depthid
                WHERE cd.frameworkid=$frameworkid AND cdf.hidden=0
                ORDER BY cdc.depthid, cdc.sortorder, cdf.sortorder";

        $customfields = get_records_sql($sql);
        $customfieldtrack  = array();
    }
 

    ///
    /// Process any actions
    ///
    if ($editingon) {
        require_capability('moodle/local:update'.$type, $sitecontext);

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


    // Display options form 
    $display_options = new hierarchy_show_options_form(null, compact('framework','spage', 'type'));

    if ($display_options->is_cancelled()) {
        redirect($returnurl);
    } else if ($fromform = $display_options->get_data()) {
        if (empty($fromform->submitbutton)) {
            print_error('unknownbuttonclicked', $type, $returnurl);
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

        if(!update_record($type.'_framework', $todb)) {
            print_error('cannotupdatedisplaysettings', $type, $returnurl);
        }
        redirect($returnurl);

    } else {
        $toform = new object();
        $toform->hidecustomfields = $framework->hidecustomfields;
        $toform->showitemfullname = $framework->showitemfullname;
        $toform->showdepthfullname = $framework->showdepthfullname;
        $display_options->set_data($toform);
    }

    // Download form
    $download = new hierarchy_download_form(null, array('type'=>$type));
    if ($fromform = $download->get_data()) {
        require_once($CFG->dirroot.'/hierarchy/get_download_data.php');
        redirect($CFG->wwwroot.'/hierarchy/download.php?type='.$type);
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

    if ($extrasql !== '') {
        print_heading("$filteredmatchcount / $matchcount ".get_string('featureplural', $type));
    } else {
        print_heading("$matchcount ".get_string('featureplural', $type));
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
            $header .= "<a href=\"{$CFG->wwwroot}/hierarchy/depth/edit.php?type={$type}&id={$depth->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a> ".
                "<a href=\"{$CFG->wwwroot}/customfield/index.php?type={$type}&subtype=depth&depthid={$depth->id}\" title=\"$str_customfields\">".
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
                        $header .= ' <a title="'.$str_edit.'" href="'.$CFG->wwwroot.'/customfield/index.php?type='.$type.'&subtype=depth&depthid='.$depth->id.'&id='.$customfield->id.'&action=editfield"><img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.$str_edit.'" class="iconsmall" /></a>';
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
        $coledit = $colcount;
    }


    if(!empty($hierarchy->extrafield)) {
        $tablecolumns[] = $hierarchy->extrafield;
        $tableheaders[] = get_string($hierarchy->extrafield, $type);
        $colcount++;
    }

    $table = new flexible_table($type.'-framework-index-'.$frameworkid);

    $table->define_columns($tablecolumns);
    $table->define_headers($tableheaders);
    foreach ($tablecolumnscf as $tablecolumncf) {
        $table->column_style($tablecolumncf,'text-align','center');
    }
    $table->column_style('edit','width','80px');
    if (!empty($hierarchy->extrafield)) {
        $table->column_style($hierarchy->extrafield,'text-align','center');
    }

    $table->set_attribute('cellspacing', '0');
    $table->set_attribute('id', $type);
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
                    $cell = "<a $cssclass href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$type}&id={$item->id}\">{$itemname}</a>";
                    $data[$i][$j] = $cell;
                    if ($editingon) {
                        $moveiconup   = false;
                        if ($depthidtrack != 0 && $depth->depthlevel == 0) { // it's not the first and we're at the top level
                            $moveiconup   = true;
                        } elseif ($depthidtrack == $depth->id) {
                            // depthid hasn't changed so the item can move up and the last one can move down
                            $moveiconup       = true;
                            $data[$i-1][$coledit-1] .= "<a href=\"index.php?type={$type}&frameworkid={$frameworkid}&movedown=".end($itemtrack)."\" title=\"$str_movedown\">".
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
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/item/edit.php?type={$type}&frameworkid={$frameworkid}&id={$item->id}\" title=\"$str_edit\">".
                        "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

                    if ($item->visible) {
                        $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/index.php?type={$type}&frameworkid={$frameworkid}&hide={$item->id}\" title=\"$str_hide\">".
                            "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
                    } else {
                        $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/index.php?type={$type}&frameworkid={$frameworkid}&show={$item->id}\" title=\"$str_show\">".
                            "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
                    }
                }
                if ($can_delete_item) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/item/delete.php?type={$type}&frameworkid={$frameworkid}&id={$item->id}&spage={$spage}\" title=\"$str_delete\">".
                        "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
                }
                if ($moveiconup) {
                    $buttons[] = "<a href=\"index.php?type={$type}&frameworkid={$frameworkid}&moveup={$item->id}\" title=\"$str_moveup\">".
                        "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a> ";
                } else {
                   $buttons[] = $str_spacer;
                }
                $data[$i][$j] = implode($buttons, ' ');
                $j++;
            }

            
            if(!empty($hierarchy->extrafield)) {
                $data[$i][$j] = "<a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$type}&id={$item->id}\">{$item->{$hierarchy->extrafield}}</a>";
            }

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
                $from   = " FROM {$CFG->prefix}{$type} c
                        LEFT OUTER JOIN {$CFG->prefix}{$type}_depth_info_field cdf
                            ON cdf.depthid=c.depthid
                        LEFT OUTER JOIN {$CFG->prefix}{$type}_depth_info_data cdd
                            ON cdd.fieldid=cdf.id AND cdd.{$type}id=c.id";
                $where  = " WHERE c.frameworkid=$frameworkid AND c.id IN (".implode(",", $itemtrack).") AND cdf.hidden=0";
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

    // Add filters
    $filtering->display_add();
    $filtering->display_active();

    // Show options form or link
    if($showoptions) {
        $display_options->display();
    } else {
        if (strpos($returnurl, '?') !== false) {
            $showurl = "{$returnurl}&amp;showoptions=1";
        } else {
            $showurl = "{$returnurl}?showoptions=1";
        }
        print "<p><a href=\"$showurl\">".get_string('showdisplayoptions', 'hierarchy').'</a></p>';
    }

    // Display table
    $table->print_html();

    if (!$itemsfound) {
        echo "<i>".get_string('no'.$type, $type)."</i><br><br>";
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

