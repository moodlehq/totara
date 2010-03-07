<?php

require_once('../hierarchy/type/competency/lib.php');
$CFG->idpenablefavourites = false;

/**
 * Create a new Learning Plan along with an initial revision
 */
function create_new_plan($name='', $startdate=0, $enddate=0) {
    global $USER;

    // Default values
    $ctime = time();
    if (empty($name)) {
        $name = userdate($ctime);
    }
    if (0 == $startdate) {
        $startdate = strtotime('now');
    }
    if (0 == $enddate) {
        $enddate = $startdate + 4 * 30 * 24 * 60 * 60; // 4 months later
    }

    $id = false;
    begin_sql();

    // Create the plan
    $idp = new stdclass();
    $idp->name = substr($name, 0, 255); // maxlength 255
    $idp->userid = $USER->id;
    $idp->startdate = $startdate;
    $idp->enddate = $enddate;
    if (!$id = insert_record('idp', $idp)) {
        rollback_sql();
        return false;
    }

    // Create the initial revision
    $revision = new stdclass();
    $revision->idp = $id;
    $revision->ctime = $ctime;
    $revision->mtime = $ctime;
    $revision->visible = 0;
    if (!insert_record('idp_revision', $revision)) {
        rollback_sql();
        return false;
    }

    commit_sql();
    return $id;
}

/**
 * Get the Learning Plans for the current user.
 */
function get_plans($userid) {
    return get_records_select('idp', "userid = $userid", 'id DESC');
}

/**
 * Given a revision object, return the status of that revision.
 *
 * Note that the revision object in the database doesn't include an
 * "approval" field.  This field must be added to the revision prior
 * this calling this function. It must simply be non-empty if the
 * revision is approved.
 */
function get_revision_status($revision) {
    // Set the status of the revision
    if (!empty($revision->evaluatedtime)) {
        return 'completed';
    }
    elseif (!empty($revision->approval)) {
        if ($revision->evaluationdeadline < time()) {
            return 'overdue';
        }
        else {
            return 'approved';
        }
    }
    elseif ($revision->withdrawntime) {
        return 'withdrawn';
    }
    elseif ($revision->submittedtime) {
        return 'submitted';
    }
    elseif ($revision->visible) {
        return 'inrevision';
    }
    else {
        return 'notsubmitted';
    }
}

/**
 * Get either the specified revision of the given Learning Plan or the
 * latest one.
 *
 * This function does 3 DB queries, be careful when calling it from a loop!
 *
 * @param $planid  Use this to retrieve the latest revision for this plan
 * @param $revid   Use this to retrieve a specific revision from the
 *                 plan (the $planid can be zero when this one is set)
 */
function get_revision($planid, $revid=0, $pdf=false) {
    global $CFG;

    $revision = false;
    if ($pdf) {
        // Always get the approved revision if there is one
        $sql = 'SELECT r.*, a.approvedby, a.onbehalfof, a.ctime
                  FROM ' . $CFG->prefix . 'idp_revision r
                  JOIN ' . $CFG->prefix . 'idp_approval a
                    ON a.revision = r.id
                 WHERE r.idp = ' . $planid;
        $revision = get_record_sql($sql);
    }
    elseif ($revid > 0) {
        // Get the requested revision
        $revision = get_record('idp_revision', 'id', $revid);
    }
    else {
        // Get the latest revision
        $revision = get_record_select('idp_revision', "idp = $planid AND ctime = (SELECT MAX(ctime)
                                     FROM {$CFG->prefix}idp_revision WHERE idp = $planid)");
    }

    if ($revision) {
        // Get plan-wide fields
        $plan = get_record_sql("SELECT startdate, enddate, userid, name FROM {$CFG->prefix}idp WHERE id = $revision->idp");
        $revision->userid = $plan->userid;
        $revision->planname = $plan->name;

        // Text representation of the training period (start and end dates)
        $dates = new stdclass();
        $dates->start = strftime('%d-%m-%Y', $plan->startdate);
        $dates->end = strftime('%d-%m-%Y', $plan->enddate);
        $revision->period = get_string('starttoenddates', 'idp', $dates);

        // Extra information not directly in the revision table
        $revision->evaluationdeadline = idp_get_evaluation_deadline($plan);
        $revision->approval = get_record('idp_approval', 'revision', $revision->id);
        $revision->status = get_revision_status($revision);
    }

    return $revision;
}

/**
 * Returns true if the given revision refers to a plan which belong to
 * the current user (in the case of a trainee for example) or false if
 * a manager/staff is looking at a trainee's plan.
 */
function is_my_plan($revisionid) {
    global $USER, $CFG;

    $userid = get_field_sql("SELECT p.userid
                             FROM {$CFG->prefix}idp_revision r,
                                  {$CFG->prefix}idp p
                             WHERE r.id = $revisionid AND r.idp = p.id");

    return $USER->id == $userid;
}

/**
 * Return HTML code of a human-readable version of the status.
 *
 * @param $revision     Revision object (as returned by get_revision())
 * @param $showdetails  Show extra details like an approver's name in the satus
 * @param $showdate     Show the date where certain status were readched
 * @param $pdf          Set to true to generate a PDF-friendly version of the status
 */
function format_revision_status($revision, $showdetails=true, $showdate=true, $pdf=false) {

    $status = '';
    if ('approved' == $revision->status) {
        if ($showdate) {
            $timestring = userdate($revision->approval->ctime);
            $status = get_string('approvedondate', 'idp', $timestring);
        }
        else {
            $status = get_string('approved', 'idp');
        }

        if ($showdetails) {
            if ($pdf) {
                $approver = format_user_link($revision->approval->approvedby);
            }
            else {
                $approver = format_user_link($revision->approval->approvedby);
            }
            $status .= ' '.get_string('byuser', 'idp', $approver);

            if (!empty($revision->approval->onbehalfof)) {
                if ($pdf) {
                    $onbehalfof = format_user_link($revision->approval->onbehalfof);
                }
                else {
                    $onbehalfof = format_user_link($revision->approval->onbehalfof);
                }
                $status .= ' ('.get_string('onbehalfofuser', 'idp', $onbehalfof).')';
            }
        }
    }
    elseif ('withdrawn' == $revision->status) {
        if ($showdate) {
            $timestring = userdate($revision->withdrawntime);
            $status = get_string('withdrawnon', 'idp', $timestring);
        }
        else {
            $status = get_string('withdrawn', 'idp');
        }
    }
    elseif ('submitted' == $revision->status) {
        if ($showdate) {
            $timestring = userdate($revision->submittedtime);
            $status = get_string('submittedon', 'idp', $timestring);
        }
        else {
            $status = get_string('submitted', 'idp');
        }
    }
    elseif ('inrevision' == $revision->status) {
        $status = get_string('inrevision', 'idp');
    }
    elseif ('notsubmitted' == $revision->status) {
        $status = get_string('notsubmitted', 'idp');
    }
    elseif ('completed' == $revision->status) {
        if ($showdate) {
            $timestring = userdate($revision->evaluatedtime);
            $status = get_string('completedon', 'idp', $timestring);
        }
        else {
            $status = get_string('completed', 'idp');
        }
    }
    elseif ('overdue' == $revision->status) {
        $status = get_string('overdue', 'idp');
    }

    if ($pdf) {
        return $status; // No formatting for PDF export
    }
    else {
        return "<span class=\"revisionstatus {$revision->status}\">$status</span>";
    }
}


/**
 * Print details about the given revision.
 */
function print_revision_details($revision, $can_submit, $can_approve=false, $pdf=false, $showactions = true) {

    global $CFG;

    require_once($CFG->dirroot.'/local/reportlib.php');

    if (! $user = get_record('user', 'id', $revision->owner->id)) {
        error('User not found');
    }

    /// Add the custom profile fields to the user record
    include_once($CFG->dirroot.'/user/profile/lib.php');
    $usercustomfields = (array)profile_user_record($user->id);
    foreach ($usercustomfields as $cname=>$cvalue) {
        if (!isset($user->$cname)) { // Don't overwrite any standard fields
            $user->$cname = $cvalue;
        }
    }

    $columns = array(
        array(
            'column'      => '1',
            'sortorder'   => '1',
            'type'        => 'user',
            'value'       => 'fullname',
            'level'       => '',
            'headingtype' => 'lang',
            'heading'     => 'fullname',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '1',
            'type'        => 'organisation',
            'value'       => 'fullname',
            'level'       => '2',
            'headingtype' => 'defined',
            'heading'     => 'Conservancy',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '2',
            'type'        => 'user',
            'value'       => 'email',
            'level'       => '',
            'headingtype' => 'lang',
            'heading'     => 'email',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '2',
            'type'        => 'organisation',
            'value'       => 'fullname',
            'level'       => '3',
            'headingtype' => 'defined',
            'heading'     => 'Area Office',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '3',
            'type'        => 'usercustom',
            'value'       => 'title',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => '',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '3',
            'type'        => 'user',
            'value'       => 'idnumber',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => 'Jade id',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '4',
            'type'        => 'position',
            'value'       => 'fullname',
            'level'       => '1',
            'headingtype' => 'defined',
            'heading'     => 'Role',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '4',
            'type'        => 'usercustom',
            'value'       => 'nzqaid',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => '',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '5',
            'type'        => 'usercustom',
            'value'       => 'managerempcode',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => '',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '5',
            'type'        => 'usercustom',
            'value'       => 'datejoined',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => '',
        ),
    );

    echo mitms_print_report_heading($columns, $user, $usercustomfields);

    $table->tablealign = 'left';
    $table->class = 'generaltable personaldetails';

    $prefix = ($pdf) ? '<b>' : '';
    $suffix = ($pdf) ? '</b>' : '';

    // Personal information
    $table->data[] = array($prefix . get_string('trainingperiod', 'idp') . $suffix, $revision->period);

    // Creation and modification time
    $mtime = userdate($revision->mtime);
    if (!$pdf) {
        $mtime = "<span id=\"mtime\">$mtime</span>";
    }
    $table->data[] = array($prefix . get_string('createdon', 'idp') . $suffix, userdate($revision->ctime));
    $table->data[] = array($prefix . get_string('lastmodifiedon', 'idp') . $suffix, $mtime);

    // Next actions
    $nextactions = '';
    if ('approved' == $revision->status or 'overdue' == $revision->status) {
        if ($can_submit) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/evaluation.php?id=' . $revision->idp . '">'.get_string('evaluateplan', 'idp').'</a> - ';
        }
        $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/revision.php?id=' . $revision->idp . '&amp;print=1">'.get_string('printableview', 'idp').'</a>';
        $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/revision_pdf.php?id=' . $revision->idp . '">' . get_string('exporttopdf', 'idp') . '</a>';
    }
    elseif ('withdrawn' == $revision->status) {
        if ($can_submit) {
            $nextactions .= '<a href="'.$moduledir .'/revision.php?id='.$revision->idp.'">'.get_string('editlatestrevision', 'idp').'</a>';
        }
        else {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/revision.php?id='.$revision->idp.'">'.get_string('viewlatestrevision', 'idp').'</a>';
        }
    }
    elseif ('submitted' == $revision->status) {
        if ($can_approve) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/approve.php?rev='.$revision->id.'">'.get_string('approveplan', 'idp').'</a> - ';
            $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/reject.php?rev='.$revision->id.'">'.get_string('rejectplan', 'idp').'</a>';
        }

    }
    elseif ('inrevision' == $revision->status) {
        if ($can_submit) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/submit.php?rev='.$revision->id.'">'.get_string('submitplan', 'idp').'</a> - ';
        }
        $nextactions .= '<a style="cursor: pointer;" onclick="toggle_addcomments(); return 0;">' . get_string('commentonplan', 'idp') . '</a>';
    }
    elseif ('notsubmitted' == $revision->status) {
        if ($can_submit) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/submit.php?rev='.$revision->id.'">'.get_string('submitplan', 'idp').'</a>';
        }
    }
    elseif ('completed' == $revision->status) {
        $nextactions .= '<a href="'.$CFG->wwwroot.'/plan/revision.php?id=' . $revision->idp . '&amp;print=1">'.get_string('printableview', 'idp').'</a>';
    }

    if (empty($pdf)) {
        $table->data[] = array($prefix . get_string('currentstatus', 'idp') . $suffix,
                               format_revision_status($revision, true, true, $pdf));

        if ($showactions && !empty($nextactions)) {
            $table->data[] = array(get_string('nextaction', 'idp'), "<b>$nextactions</b>");
            $table->rowclass = array();
            $table->rowclass[ count($table->data) - 1 ] = 'actions';
        }
    }

    $table->summary = 'Summary of general plan details';
    print '<div class="pagesection">';
    print_table($table);
    print '</div>';
}

/**
 * Print a list of all revisions for the given plan
 */
function print_revision_list($planid, $currevisionid) {
    global $CFG;

    $revisions = get_records('idp_revision', 'idp', $planid, 'ctime DESC');

    if (count($revisions) > 1) {
        print '<div>'.collapsing_tree_node('revisionslabel', 'revisions', get_string('allrevisions', 'idp')).'</div>';

        print '<div id="revisions" style="display:none"><ul>';
        foreach ($revisions as $revision) {
            $datestring = userdate($revision->ctime);

            print '<li>';
            if ($revision->id != $currevisionid) {
                print "<a href=\"revision.php?id=$planid&amp;rev=$revision->id\">$datestring</a>";
            } else {
                print $datestring;
            }
            print "</li>\n";
        }
        print "</ul></div>\n";
    }
}

/**
 * Print the latest comment as well as links to all other comments
 */
function revision_comments($revision) {
    global $CFG;

    $comments = get_records('idp_revision_comment', 'revision', $revision->id, 'ctime DESC');
    $out = '';

    $out .= '<div id="commentscontainer">';

    // Print list of all comments with their contents
    if ($comments and count($comments) > 0) {

        $out .= '<div>'.collapsing_tree_node('commentslabel', 'comments', get_string('allcomments', 'idp'), 0, '', true).'</div>';

        $out .= '<div id="comments" style="display:block"><blockquote>';
        $firsttime = true;
        foreach ($comments as $comment) {
            $authorlink = format_user_link($comment->author, '', 'You');
            $datestring = userdate($comment->ctime);

            if (!$firsttime) {
                $out .= '<hr />';
            } else {
                $firsttime = false;
            }

            $out .= '<p><b>'.get_string('usersaid', 'idp', $authorlink);
            $out .= ' ('.get_string('ondate', 'idp',$datestring).'):';
            // Ensure line-breaks are represented.
            $comment->contents = preg_replace('/[\r\n]/', '<br />', $comment->contents);
            $out .= '</b><br />'.s($comment->contents).'</p>';
        }
        $out .= "</blockquote></div>\n";
    }
    $out .= "</div>\n";
    return $out;
}

/**
 * Return a table of themes and objectives for a given curriculum
 */
function curriculum_objectives($curriculumcode, $revision, $can_edit=false) {
    global $CFG;

    $objectives = get_records_sql("SELECT ro.id, o.id AS objectiveid, t.name AS themename,
                                          o.name AS objectivename, ro.grade, o.urlsuffix, c.baseurl
                                     FROM {$CFG->prefix}idp_revision_objective ro,
                                          {$CFG->prefix}racp_curriculum c,
                                          {$CFG->prefix}racp_domain d,
                                          {$CFG->prefix}racp_theme t,
                                          {$CFG->prefix}racp_objective o
                                    WHERE ro.revision = $revision->id AND
                                          c.code = '$curriculumcode' AND
                                          ro.objective = o.id AND o.theme = t.id AND
                                          t.domain = d.id AND d.curriculum = c.id
                                 ORDER BY themename, objectivename");

    $table = new stdclass();
    $table->class = 'generaltable objectivelist noevaluations';
    $table->head = array(get_string('themescolumn', 'idp'),
                         get_string('learningobjectivescolumn', 'idp'));

    if ('completed' == $revision->status) {
        $table->class = 'generaltable objectivelist';
        $table->head[] = get_string('evaluation', 'idp');
    }

    if ($objectives and count($objectives) > 0) {

        if ($revision->id and $can_edit) {

            foreach ($objectives as $objective) {

                $html = "<img id=\"deleteobjective$objective->id\"";
                $html .= " onclick=\"toggle_objective($revision->id, $objective->objectiveid, '$curriculumcode', '$can_edit', 'deleteobj')\"";
                $html .= ' style="cursor: pointer"';
                $html .= ' title="'.get_string('removefromplanbutton', 'idp').'"';
                $html .= ' alt="'.get_string('removefromplanbutton', 'idp').'"';
                $html .= " src=\"{$CFG->pixpath}/delete.gif\" />";

                $table->data[] = array(s($objective->themename),
                                       s($objective->objectivename),
                                       $html);
            }
        }
        else {
            foreach ($objectives as $objective) {
                $row = array();
                $row[] = s($objective->themename);
                $row[] = s($objective->objectivename);
                if ('completed' == $revision->status) {
                    $row[] = get_string("plangrade$objective->grade", 'idp');
                }
                $row[] = online_curriculum_link($objective->baseurl,
                                                $objective->urlsuffix);
                $table->data[] = $row;
            }
        }

        $table->head[] = '';
        $table->tablealign = 'left';
        $table->summary = 'List of Learning Objectives with their associated theme';

        return print_table($table, true);
    }
    elseif ($can_edit) {
        $noneyet = '<i>'.get_string('noneyet', 'idp').'</i>';
        $table->data[] = array($noneyet, $noneyet);

        $table->tablealign = 'left';
        $table->summary = 'Empty table';

        return print_table($table, true).'<i>'.get_string('noobjectivesindomain', 'idp')."</i>\n";
    }
    return '';
}

/**
 * Returns the code for a collapsing tree (in Javascript) of the
 * domains, themes and objectives for the given curriculum, along with
 * the appropriate buttons to add objectives to the plan revision.
 */
function can_edit_curriculum_browser($curriculumcode, $revisionid, $enablefavourites, $indentation=0) {

    $alreadyadded = get_alreadyadded($curriculumcode, $revisionid);
    return curriculum_browser($curriculumcode, true, $revisionid, $alreadyadded, $enablefavourites, $indentation);
}

function list_item_edit_controls($revid, $listtype, $item) {
    global $CFG;
    $html = '';


    // Edit button
    $html .= '&nbsp;';
    $html .= "<img id=\"edit$listtype{$item->id}\"";
    $html .= " onclick=\"listitem_action($revid, '$listtype', {$item->id}, 'edit')\"";
    $html .= ' style="cursor: pointer"';
    $html .= ' alt="'.get_string('editbutton', 'local').'"';
    $html .= ' title="'.get_string('editbutton', 'local').'"';
    $html .= " src=\"{$CFG->pixpath}/edit.gif\" />";

    // Delete button
    $html .= '&nbsp;';
    $html .= "<img id=\"del$listtype{$item->id}\"";
    $html .= " onclick=\"listitem_action($revid, '$listtype', {$item->id}, 'del')\"";
    $html .= ' style="cursor: pointer"';
    $html .= ' alt="'.get_string('deletebutton', 'local').'"';
    $html .= ' title="'.get_string('deletebutton', 'local').'"';
    $html .= " src=\"{$CFG->pixpath}/delete.gif\" />";

    return $html;
}

/**
 * Return a table of list items for a revision
 */
function get_list_items($revid, $listtype, $can_edit) {
    global $CFG;

    $listitems = get_records_select('idp_list_item', "revision = $revid AND listtype = $listtype", 'ctime');

    // So we can index using $listtype
    $typestrings = array(
        'howtomeasureobjectives',
        'howtomeetobjectives'
        );

    $table = new stdclass;
    $table->class = 'generaltable freeformlist';

    if ($listitems and count($listitems) > 0) {
        $table->head = array('', get_string($typestrings[$listtype], 'idp'));

        if ($can_edit) {
            $i = 1;
            foreach ($listitems as $item) {
                $html = list_item_edit_controls($revid, $listtype, $item);

                // Edit box
                $editcontrols = "<textarea id=\"editor{$listtype}{$item->id}\"";
                $editcontrols .= " style=\"display: none\" cols=\"80\" rows=\"3\"";
                $editcontrols .= " onkeyup=\"form_element_keypress(event, ";
                $editcontrols .= "function() { listitem_action($revid, '$listtype', {$item->id}, 'save') }, ";
                $editcontrols .= "function() { listitem_action($revid, '$listtype', {$item->id}, 'cancel') })\"";
                $editcontrols .= '>'.s($item->contents).'</textarea>';

                // Save button
                $editcontrols .= "<br /><input type=\"button\" id=\"save$listtype{$item->id}\"";
                $editcontrols .= " style=\"display: none\"";
                $editcontrols .= " onclick=\"listitem_action($revid, '$listtype', {$item->id}, 'save')\"";
                $editcontrols .= ' value="'.get_string('savebutton', 'local').'" />';

                // Cancel button
                $editcontrols .= " <input type=\"button\" id=\"cancel$listtype{$item->id}\"";
                $editcontrols .= " style=\"display: none\"";
                $editcontrols .= " onclick=\"listitem_action($revid, '$listtype', {$item->id}, 'cancel')\"";
                $editcontrols .= ' value="'.get_string('cancelbutton', 'local').'" />';

                $itemhtml = "<span id=\"item{$listtype}{$item->id}\">"
                    . s($item->contents) . '</span>' . $editcontrols;

                $table->data[] = array($i++, $itemhtml, $html);
            }

            $table->head[] = ''; // extra column for the buttons
        }
        else {
            $i = 1;
            foreach ($listitems as $item) {
                $table->data[] = array($i++, s($item->contents));
            }
        }

        $table->tablealign = 'left';
        $table->summary = array(get_string($typestrings[$listtype], 'idp'));

        return print_table($table, true);
    }
    else if ($can_edit) {
        $nothingyet = '<i>'.get_string('nothingyet', 'idp').'</i>';
        $table->data[] = array($nothingyet);

        $table->head = array(get_string($typestrings[$listtype], 'idp'));
        $table->tablealign = 'left';
        $table->summary = 'Empty table';

        return print_table($table, true);
    }

    return '';
}

/**
 * Print a textbox which allows trainees to add list items
 */
function print_freeform_textbox($revisionid, $listtype, $return=false) {
    global $CFG;

    $out = '';
    $out .= '<p><textarea rows="2" cols="100" id="listitem'.$listtype.'"';
    $out .= " onkeyup=\"form_element_keypress(event, ";
    $out .= "function() { add_list_item($revisionid, $listtype) }, ";
    $out .= "function() { clear_list_item($listtype) })\"";
    $out .= ' ></textarea></p>';
    $out .= '<p><input type="submit"';
    $out .= ' value="'.get_string('additembutton', 'idp').'"';
    $out .= " onclick=\"add_list_item($revisionid, $listtype)\" /></p>\n";
    if ($return) {
        return $out;
    }
    print $out;
}

/**
 * Print a textbox which allows trainees to add comment
 */
function print_comment_textbox($revisionid) {

    print '<div id="commentsadd" style="display:none">';
    print '<p>'.get_string('addcomment', 'idp').'&nbsp;';

    print '<textarea rows="5" cols="60" style="vertical-align:top; display: block;" id="commentfield"></textarea>';

    print '<input type="button" value="'.get_string('additembutton', 'idp').'"';
    print " onclick=\"add_comment($revisionid)\" /></p>";
    print "</div>\n";
}

/**
 * Set the "last modification" time of the revision to the current time
 */
function update_modification_time($revisionid) {
    $record = new stdclass();
    $record->id = $revisionid;
    $record->mtime = time();
    return update_record('idp_revision', $record);
}

/**
 * Output a human-readable version of the last modification time for
 * the given plan revision.
 */
function get_modification_time($revisionid) {
    if ($mtime = get_field('idp_revision', 'mtime', 'id', $revisionid)) {
        return userdate($mtime);
    }
    return false;
}

/**
 * Remove a learning objective from a plan revision
 *
 * @param integer $objectiveid   ID of the objective to delete
 * @param integer $revision      ID of the revision containing the objective
 * @param boolean $postapproval  Whether or not this action is being performed
 *                               after the revision has been approved
 */
function delete_plan_objective($objectiveid, $revisionid, $postapproval=0) {
    begin_sql();
    if (delete_records('idp_revision_objective', 'objective', $objectiveid,
                       'revision', $revisionid, 'postapproval', $postapproval)) {
        commit_sql();
        return true;
    }
    rollback_sql();
    return false;
}

/**
 * Delete the given plan if it only contains one empty revision.
 */
function delete_plan($planid) {

    // Make sure there is only one revision
    if (count_records('idp_revision', 'idp', $planid) > 1) {
        return false;
    }
    $revision = get_revision($planid);

    // Make sure the revision is empty
    if ('notsubmitted' != $revision->status) {
        return false; // Status must be unsubmitted
    }
    if (count_records('idp_revision_competency', 'revision', $revision->id) > 0) {
        return false; // There are competencies in this revision
    }
    if (count_records('idp_revision_course', 'revision', $revision->id) > 0) {
        return false; // There are courses in this revision
    }
    if (count_records('idp_revision_comment', 'revision', $revision->id) > 0) {
        return false; // There are comments on this revision
    }
    if (count_records('idp_list_item', 'revision', $revision->id) > 0) {
        return false; // There are list items on this revision
    }

    // Actual deletion
    begin_sql();
    if (!delete_records('idp_revision', 'id', $revision->id)) {
        rollback_sql();
        return false;
    }
    if (!delete_records('idp', 'id', $planid)) {
        rollback_sql();
        return false;
    }

    commit_sql();
    return true;
}

/**
 * Rename a plan which hasn't been submitted yet.
 */
function rename_plan($planid, $name, $startdate, $enddate) {

    if (empty($name) || (0 == $planid)) {
        return false;
    }

    // Get latest revision
    $revision = get_revision($planid);

    // Make sure the revision is empty
    if ('approved' == $revision->status or 'submitted' == $revision->status) {
        return false; // Status must be unsubmitted
    }

    $plan = new stdclass();
    $plan->id = $planid;
    $plan->name = substr($name, 0, 255); // maxlength 255
    $plan->startdate = $startdate;
    $plan->enddate = $enddate;

    return update_record('idp', $plan);
}

/**
 * Perform the given AJAX action.
 *
 * @param integer $objectiveid   ID of the objective to add/delete
 * @param integer $revision      ID of the revision containing the objective
 * @param string $action         One of: addobj, deleteobj
 * @param boolean $postapproval  Whether or not this action is being performed
 *                               after the revision has been approved
 */
function objective_ajax_action($objectiveid, $revisionid, $action, $postapproval=0) {

    if ('addobj' == $action) {
        if ($id = get_field('idp_revision_objective', 'id', 'objective', $objectiveid, 'revision', $revisionid)) {
            return true; // objective already in the revision
        }

        // Add objective to the revision
        $record = new stdclass();
        $record->objective = $objectiveid;
        $record->revision = $revisionid;
        $record->ctime = time();
        $record->postapproval = $postapproval;

        begin_sql();
        if (insert_record('idp_revision_objective', $record)) {
            // Don't update the modification time for postapproval additions
            if ($postapproval || update_modification_time($revisionid)) {
                commit_sql();
                return true;
            }
        }
        rollback_sql();
    }
    elseif ('deleteobj' == $action) {
        return delete_plan_objective($objectiveid, $revisionid, $postapproval);
    }

    return false;
}

/**
 * Add text contents related to how to measure and meet objectives.
 */
function add_list_item($revisionid, $listtype, $itemtext) {

    if (empty($itemtext)) {
        return true; // Ignore empty strings
    }

    $record = new stdclass();
    $record->revision = $revisionid;
    $record->contents = $itemtext;
    $record->listtype = $listtype;
    $record->ctime = time();

    begin_sql();
    if (insert_record('idp_list_item', $record) and
        update_modification_time($revisionid)) {

        commit_sql();
        return true;
    }
    rollback_sql();

    return false;
}

function update_list_item($revisionid, $listtype, $itemid, $itemtext) {

    if (empty($itemtext)) {
        return true; // Ignore empty strings
    }

    $record = new stdclass();
    $record->contents = $itemtext;
    $record->id = $itemid;

    begin_sql();
    if (update_record('idp_list_item', $record) and
        update_modification_time($revisionid)) {

        commit_sql();
        return true;
    }
    rollback_sql();

    return false;
}

/**
 * Delete text contents related to how to measure and meet objectives.
 */
function delete_list_item($revisionid, $itemid) {

    begin_sql();
    if (delete_records('idp_list_item', 'id', $itemid) and
        update_modification_time($revisionid)) {

        commit_sql();
        return true;
    }
    rollback_sql();

    return false;
}

/**
 * Add comments to the learning plan
 */
function add_comment($revisionid, $itemtext) {
    global $USER, $CFG;

    if (empty($itemtext)) {
        return true; // Ignore empty strings
    }

    $record = new stdclass();
    $record->revision = $revisionid;
    $record->contents = $itemtext;
    $record->author = $USER->id;
    $record->ctime = time();

    begin_sql();
    if (insert_record('idp_revision_comment', $record) and
        update_modification_time($revisionid)) {
        // send email notification
        $owner = get_field_sql("SELECT p.userid FROM {$CFG->prefix}idp p
            JOIN {$CFG->prefix}idp_revision r on r.idp = p.id WHERE r.id = {$revisionid}");
        $revision = get_record('idp_revision', 'id', $revisionid);
        if ($owner == $USER->id) {
            $fullname = fullname(get_user_light($owner));
            $namekey = 'traineename';
            $type = 'traineecommented';

        } else {
            $fullname = fullname(get_user_light($USER->id));
            $namekey = 'managername';
            $type = 'managercommented';
        }
        $planname = get_field_sql(
            "SELECT p.name
                FROM {$CFG->prefix}idp p
                JOIN {$CFG->prefix}idp_revision r
                    ON r.idp = p.id
                WHERE r.id = $revisionid");
        idp_email_notification($type, $revision,
            array(
                $namekey => $fullname,
                'comment' => stripslashes($itemtext),
                'planname' => $planname,
            )
        );

        commit_sql();
        return true;
    }
    rollback_sql();

    return false;
}

/**
 * Submit the given plan revision to the trainee's manager.
 */
function submit_revision($revisionid) {
    global $CFG;

    $revision = get_revision(0, $revisionid);

    // The revision must be not yet submitted
    if ($revision->status != 'notsubmitted' and $revision->status != 'inrevision') {
        return false; // Cannot re-submit
    }

    // Make sure another revision of this plan hasn't been approved
    // already
    $approved = count_records_sql("SELECT count(*)
                                     FROM {$CFG->prefix}idp_approval a,
                                          {$CFG->prefix}idp_revision r,
                                          {$CFG->prefix}idp p
                                    WHERE a.revision = r.id AND r.idp = p.id AND
                                          p.id = $revision->idp");
    if ($approved) {
        return false;
    }

    // Mark the revision as submitted
    $record = new stdclass();
    $record->id = $revisionid;
    $record->submittedtime = time();
    $record->visible = 1;

    begin_sql();
    if (update_record('idp_revision', $record)) {
        update_modification_time($revisionid);
        commit_sql();
        // send email notification
        $fullname = fullname(get_user_light(get_field('idp', 'userid', 'id', $revision->idp)));
        idp_email_notification('submitted', $revision, array('traineename' => $fullname));
        return true;
    }
    else {
        rollback_sql();
        return false;
    }
}

/**
 * Create a new revision and copy all of the data from the given plan
 * revision.
 */
function clone_revision($revisionid) {

    $ctime = time();
    $originalrev = get_revision(0, $revisionid);

    // Create the initial revision
    $newrev = new stdclass();
    $newrev->idp = $originalrev->idp;
    $newrev->ctime = $ctime;
    $newrev->mtime = $ctime;
    $newrev->visible = 1;

    begin_sql();
    if (!$newid = insert_record('idp_revision', $newrev)) {
        rollback_sql();
        return false;
    }

    // Copy objectives from original revision
    $objectives = get_records('idp_revision_objective', 'revision', $originalrev->id);
    if ($objectives and count($objectives) > 0) {
        foreach ($objectives as $objective) {
            $objective->revision = $newid;
            if (!insert_record('idp_revision_objective', $objective)) {
                rollback_sql();
                return false;
            }
        }
    }

    // Copy list items from original revision
    $listitems = get_records('idp_list_item', 'revision', $originalrev->id);
    if ($listitems and count($listitems) > 0) {
        foreach ($listitems as $item) {
            $item->revision = $newid;
            $item->contents = clean_param($item->contents, PARAM_TEXT);

            if (!insert_record('idp_list_item', $item)) {
                rollback_sql();
                return false;
            }
        }
    }

    commit_sql();
    return $newid;
}

/**
 * Withdraw a previously submitted plan revision
 */
function withdraw_revision($revisionid) {

    $revision = get_revision(0, $revisionid);

    // The revision must be submitted but not approved
    if ($revision->status != 'submitted') {
        return false;
    }

    // Mark the revision as withdrawn
    $record = new stdclass();
    $record->id = $revisionid;
    $record->withdrawntime = time();
    $record->visible = 0;

    begin_sql();
    if (update_record('idp_revision', $record)) {
        update_modification_time($revisionid);

        // Create a new revision based on this one
        if ($newid = clone_revision($revisionid)) {
            commit_sql();
            return $newid;
        }
        else {
            rollback_sql();
            return false;
        }
    }
    else {
        rollback_sql();
        return false;
    }
}

/**
 * Withdraw the given revision and add a comment
 */
function reject_revision($revisionid, $comment) {
    if (withdraw_revision($revisionid)) {
        return add_comment($revisionid, $comment);
    }
}

/**
 * Allows a manager/staff to approve a trainee's Learning Plan.
 */
function approve_revision($revision, $onbehalfof=false) {
    global $CFG, $USER;

    // The revision must be submitted
    if ($revision->status != 'submitted') {
        return false;
    }

    // Mark the revision as approved
    $record = new stdclass();
    $record->revision = $revision->id;
    $record->ctime = time();
    $record->approvedby = $USER->id;
    if ($onbehalfof && ($onbehalfof != $USER->id)) {
        $onbehalfofuser = get_user_light($onbehalfof);
        $record->onbehalfof = $onbehalfof;
        $onbehalfofstring = ' ' . get_string('onbehalfofuser', 'idp', fullname($onbehalfofuser));
    }
    else {
        $onbehalfofstring = '';
    }

    if (insert_record('idp_approval', $record)) {

        $fullname = fullname(get_user_light($USER->id));
        $duedate = strftime('%d-%m-%Y', $revision->evaluationdeadline);

        idp_email_notification('approved', $revision,
                                 array('managername' => $fullname,
                                       'onbehalfof' => $onbehalfofstring,
                                       'duedate' => $duedate));
        idp_email_notification('approvedonbehalf', $revision,
                                 array('managername' => $fullname,
                                       'onbehalfof' => $onbehalfofstring,
                                       'onbehalfofuser' => $onbehalfofuser,
                                       'planname' => $revision->planname,
                                       'duedate' => $duedate));
        return true;
    }
    return false;
}

/**
 * Return a list of user IDs of users who can approve the trainee's
 * Learning Plans.
 */
function get_approvers($contextuser) {
    global $USER;

    $approvers = array();

    $users = get_users_by_capability($contextuser, 'mod/idp:approveplan', '', 'firstname,lastname');
    if ($users and count($users) > 0) {
        foreach ($users as $key => $user) {
            if ($user->id != $USER->id) {
                $approvers[] = $user->id;
            }
        }
    }

    return $approvers;
}

/**
 * Return a list of user IDs of users who can receive notification emails
 */
function get_notification_receivers($contextuser) {
    global $USER;

    $receivers = array();

    $users = get_users_by_capability($contextuser, 'mod/idp:receivenotification');
    if ($users and count($users) > 0) {
        foreach ($users as $key => $user) {
            if ($user->id != $USER->id) {
                $receivers[] = $user->id;
            }
        }
    }

    return $receivers;
}

/**
 * Returns the manager for the given userid,
 */
function get_user_manager($userid) {
    global $CFG;

    $contextlevel = CONTEXT_USER;
    $managers = get_records_sql("SELECT
                                        u.*,
                                        r.shortname
                                    FROM
                                         {$CFG->prefix}context c
                                    JOIN {$CFG->prefix}role_assignments ra ON ra.cONtextid=c.id
                                    JOIN {$CFG->prefix}role r ON r.id=ra.roleid
                                    JOIN {$CFG->prefix}user u ON u.id=ra.userid
                                    WHERE
                                        c.instanceid = $userid AND u.deleted <> 1
                                        AND c.contextlevel = $contextlevel
                                        AND r.shortname = 'manager'
                                            ORDER BY r.shortname
                                    ");
    if (!is_array($managers)) {
        return false;
    }

    $super = array_shift($managers);
    return $super;
}

/**
 * Get a list of the trainees supervised by the given user.
 *
 * @param $userid       ID of the manager who's page we want to look at
 */
function get_trainees($userid) {
    global $CFG;

    $contextlevel = CONTEXT_USER;
    $trainees = get_records_sql("SELECT u.*
                                   FROM {$CFG->prefix}role_assignments ra
                                   JOIN {$CFG->prefix}context c ON ra.contextid = c.id
                                   JOIN {$CFG->prefix}user u ON c.instanceid = u.id
                                  WHERE c.contextlevel = $contextlevel AND ra.userid = $userid AND
                                        u.deleted <> 1 AND ra.roleid IN
                                        (SELECT id FROM {$CFG->prefix}role
                                          WHERE shortname ='manager')");
    return $trainees;
}

/**
 * Return the clickable column heading for the approval table on the
 * manager's overview page.
 */
function approval_plan_column_heading($columnname, $showapproved) {
    global $ovorderby, $orderby, $userid, $CFG;

    $sortmark = '';
    if ($orderby == $columnname) {
        $sortmark = '&nbsp;<img src="' . $CFG->pixpath . '/sortmarker.gif" />';
    }
    $url  = 'index.php?userid='.$userid;
    $url .= '&orderby='.$columnname;
    $url .= "&ovorderby={$ovorderby}";
    $url .= '&showapproved='.$showapproved;
    $link = '<a href="' . htmlentities($url) .  '">'
            . get_string("column:$columnname", 'idp')
            . '</a>'
            . $sortmark;
    return $link;
}

/**
 * Return the clickable column heading for the approval table on the
 * user's overview page.
 */
function user_learning_plan_column_heading($columnname, $userid) {

    $link  = '<a href="index.php?orderby='.$columnname;
    $link .= '&amp;userid='.$userid;
    $link .= '">'.get_string("column:$columnname", 'idp').'</a>';
    return $link;
}


/**
 * Print a table of the plans pending approvals
 */
function print_pending_plans($trainees, $orderby, $showapproved) {
    global $CFG;

    // Make list of trainee user IDs
    $userids = '';
    if ($trainees and count($trainees) > 0) {
        foreach ($trainees as $trainee) {
            if (!empty($userids)) {
                $userids .= ', ';
            }
            $userids .= $trainee->id;
        }
    }

    print "<div id=\"planlist\">\n";

    // Get pending/approved plans
    $plans = array();
    if (!empty($userids)) {
        // Get table of (revisionid, approvaltime) where approval is 0 if unapproved
        $revisionapprovedsubquery = "SELECT id AS revision, 0 AS ctime
                                       FROM {$CFG->prefix}idp_revision
                                      WHERE visible = 1 AND
                                            id NOT IN
                                            (SELECT revision FROM {$CFG->prefix}idp_approval)";
        if ($showapproved) {
            $revisionapprovedsubquery .= " UNION SELECT revision, ctime
                                            FROM {$CFG->prefix}idp_approval";
        }

        $plans = get_records_sql("SELECT r.id AS revid, p.id AS id,
                                         u.lastname AS lastname, u.firstname AS firstname,
                                         r.submittedtime AS submissiontime, r.mtime AS mtime,
                                         a.ctime AS approvaltime
                                    FROM {$CFG->prefix}idp p,
                                         {$CFG->prefix}idp_revision r,
                                         {$CFG->prefix}user u,
                                         ($revisionapprovedsubquery) a
                                   WHERE r.idp = p.id AND u.id = p.userid AND u.deleted <> 1 AND
                                         p.userid IN ($userids) AND a.revision = r.id
                                ORDER BY $orderby, mtime DESC");
    }

    if ($plans and count($plans) > 0) {

        $table = new stdclass();
        $table->summary = 'List of pending/approved Learnings Plans of your trainees';
        $table->tablealign = 'left';

        $table->head = array(approval_plan_column_heading('lastname', $showapproved),
                             approval_plan_column_heading('firstname', $showapproved),
                             approval_plan_column_heading('mtime', $showapproved),
                             approval_plan_column_heading('approvaltime', $showapproved));

        $planid = 0;
        foreach ($plans as $plan) {
            $planid = $plan->id;

            $status = get_string('inrevision', 'idp');
            if ($plan->approvaltime > 0) {
                $status = get_string('approved', 'idp');
            }
            elseif ($plan->submissiontime > 0) {
                $status = get_string('pendingapproval', 'idp');
            }
            $statuslink = "<a href=\"revision.php?id=$plan->id&amp;rev={$plan->revid}\">$status</a>";

            $table->data[] = array($plan->lastname, $plan->firstname,
                                   userdate($plan->mtime),
                                   $statuslink);
        }

        print_table($table);
    }
    else {
        print '<i>'.get_string('noplans', 'idp').'</i>';
    }

    print "</div>\n";
}

/**
 * Used by print_user_learning_plans() to sort the list of plans on
 * the trainee summary page.
 */
function cmp_plan($a, $b, $field, $descending=false) {
    if ($a->id == $b->id) {
        return 0;
    }
    if ($descending) {
        return ($a->{$field} > $b->{$field}) ? -1 : 1;
    }
    else{
        return ($a->{$field} < $b->{$field}) ? -1 : 1;
    }
}

/**
 * Sort plans by descending modification time
 */
function approvaltime_cmp_plan($a, $b) {
    return cmp_plan($a, $b, 'mtime', true);
}

/**
 * Sort plans by descending modification time
 */
function mtime_cmp_plan($a, $b) {
    return cmp_plan($a, $b, 'mtime', true);
}

/**
 * Sort plans by status field
 */
function status_cmp_plan($a, $b) {
    return cmp_plan($a, $b, 'status');
}

/**
 * Sort plans by name
 */
function planname_cmp_plan($a, $b) {
    return cmp_plan($a, $b, 'planname');
}

/**
 * Print a table of all learning plans for the given user.
 *
 * @param integer $userid       ID of the owner of the plans to list
 * @param boolean $canviewplans Whether or not to show links to the full plans
 * @param integer $page         Page number for the currently displayed page
 * @param integer $perpage      Number of plans to list per page
 * @param string $orderby       Database field to use when sorting the plans
 *
 * @return boolean False if there are no learning plans to show, True otherwise.
 */
function print_user_learning_plans($userid, $canviewplans, $page, $perpage, $orderby='status') {
    global $CFG, $USER;
    $retval = true;

    // Get pending/approved plans
    $plans = array();

    $userid = intval($userid);  // just in case, as we don't know where it's been :)

    // Check if user is viewing his/her own page
    $ownpage = ($USER->id == $userid);

    // Fetch all plans, and add revision and approval info at same time.
    $plans = get_records_sql("SELECT r.id AS revid, p.id, p.name AS planname, p.enddate,
                                     r.mtime, r.visible, a.revision AS approval,
                                     r.submittedtime, r.withdrawntime, r.evaluatedtime
                                FROM {$CFG->prefix}idp p
                                JOIN {$CFG->prefix}idp_revision r ON r.idp=p.id
                           LEFT JOIN {$CFG->prefix}idp_approval a ON a.revision=r.id
                               WHERE p.userid = $userid AND
                                     r.ctime = (SELECT MAX(ctime)
                                                  FROM {$CFG->prefix}idp_revision
                                                 WHERE idp = p.id)");
    // Set the status on each revision
    if (!is_array($plans)) {
        $plans = array();
    }
    foreach ($plans as $plan) {
        $plan->evaluationdeadline = idp_get_evaluation_deadline($plan);
        $plan->status = get_revision_status($plan);
    }

    // Sort the plans
    if ($plans) {
        uasort($plans, "{$orderby}_cmp_plan");
    }

    // Make list of trainee user IDs
    print "<div id=\"planlist\">\n";

    $visibleplans = 0; // Number of plans that could be displayed on the page if perpage was equal to infinity

    if ($plans and count($plans) > 0) {

        $table = new stdclass();
        $table->summary = 'List of your Learning Plans';
        $table->class = 'generaltable learningplanlist';
        $table->tablealign = 'left';

        $table->head = array(user_learning_plan_column_heading('planname', $userid));
        if ($canviewplans) {
            $table->head[] = user_learning_plan_column_heading('mtime', $userid);
            $table->head[] = user_learning_plan_column_heading('status', $userid);
        }
        if ($ownpage) {
            $table->head[] = '&nbsp;';
        }

        // Load the button strings now, rather than doing it each time in the loop.
        $renameplanstr = get_string('renameplanbutton', 'idp');
        $deleteplanstr = get_string('deleteplanbutton', 'idp');

        $firstplantoshow = $page * $perpage;
        $lastplantoshow = $firstplantoshow + $perpage - 1;
        foreach($plans as $plan) {
            // Hide unsubmitted revisions from others
            if (($userid != $USER->id) and ($plan->visible != 1)) {
                continue;
            }

            // Deal with paging stuff
            ++$visibleplans;
            if ($visibleplans < $firstplantoshow) {
                continue; // Skip this plan, it's on a previous page
            }
            elseif ($visibleplans > $lastplantoshow) {
                continue; // We have already displayed enough plans on this page
            }

            if ($canviewplans) {
                // Get the full status of the plan
                $formattedstatus = format_revision_status($plan, false, false, false);
                if ($ownpage and ('approved' == $plan->status or 'overdue' == $plan->status)) {
                    $evaluationdeadline = idp_get_evaluation_deadline($plan);
                    $formattedstatus .= ' (<a href="evaluation.php?id='.$plan->id.'">'.
                        get_string('selfevaluationdueby', 'idp',
                                   strftime('%d-%m-%Y', $evaluationdeadline)).'</a>)';
                }

                // Begin table row
                $row = array("<a href=\"revision.php?id={$plan->id}\">{$plan->planname}</a>",
                             userdate($plan->mtime),
                             $formattedstatus
                             );
                // Add editing buttons if appropriate
                if ($ownpage) {
                    if ('notsubmitted' == $plan->status) {
                        $row[] = user_learning_plan_editbutton($plan->id, $renameplanstr)
                            .' '. user_learning_plan_deletebutton($plan->id, $deleteplanstr);
                        $showeditcolumn = true;
                    }
                    else {
                        $row[] = '&nbsp;';
                    }
                }
                $table->data[] = $row;
            }
            else {
                $table->data[] = array("<a href=\"revision.php?id={$plan->id}\">{$plan->planname}</a>");
            }
        }

        if ($visibleplans) {
            print_table($table);
            print_paging_bar($visibleplans, $page, $perpage, "index.php?userid={$userid}&amp;orderby={$orderby}&amp;", $pagevar='page');
        } else {
            print '<i>'.get_string('noplansubmittedorapproved', 'idp').'</i>';
        }
    }
    else {
        print '<i>'.get_string('noplans', 'idp').'</i>';
        $retval = false;
    }

    print "</div>\n";
    return $retval;
}

function user_learning_plan_editbutton($planid, $renameplanstr) {
    global $CFG;
    $link   = "<a href=\"plan.php?action=rename"
            . "&amp;planid={$planid}\">"
            . "<img id=\"renameplan{$planid}\" "
            . "style=\"cursor: pointer\" alt=\"$renameplanstr\" "
            . "title=\"$renameplanstr\" src=\"{$CFG->pixpath}/t/edit.gif\" "
            . "/></a>";
    return $link;
}

function user_learning_plan_deletebutton($planid, $deleteplanstr) {
    global $CFG;
    $link = "<a href=\"plan.php?action=delete"
        . "&amp;planid={$planid}\">"
        . "<img id=\"deleteplan{$planid}\" "
        . "style=\"cursor: pointer\" alt=\"$deleteplanstr\" "
        . "title=\"$deleteplanstr\" src=\"{$CFG->pixpath}/t/delete.gif\" "
        . "/></a>";
    return $link;
}

/**
 * Return a URL to the latest revision of the latest approved plan, or
 * empty string if there are no approved plans.
 *
 * @param integer $userid User ID for the user
 * @param boolean $evaluation Set to true to get a link to the Self-Evaluation page instead
 */
function current_plan_url($userid, $evaluation=false) {
    global $CFG;

    $record = get_record_sql("SELECT p.id AS planid, r.id AS revid
                                FROM {$CFG->prefix}idp_approval a,
                                     {$CFG->prefix}idp_revision r,
                                     {$CFG->prefix}idp p
                               WHERE p.userid = $userid AND
                                     p.id = r.idp AND
                                     a.revision = r.id AND
                                     r.evaluatedtime = 0");

    if ($record) {
        $page = $evaluation ? 'evaluation' : 'revision';
        return $CFG->wwwroot.'/mod/idp/'.$page.'.php?id='.$record->planid.'&amp;rev='.$record->revid;
    }
    else {
        return '';
    }
}

/**
 * Return a link to the latest revision of the latest unapproved plan.
 * Creating a new revision if none exist.
 */
function upcoming_plan_url($userid) {
    global $CFG;

    $record = get_record_sql("SELECT p.id AS planid, r.id AS revid
                                FROM {$CFG->prefix}idp_revision r,
                                     {$CFG->prefix}idp p
                               WHERE p.userid = $userid AND
                                     p.id = r.idp AND
                                     r.withdrawntime IS NULL AND
                                     r.id NOT IN
                                         (SELECT revision FROM {$CFG->prefix}idp_approval)
                            ORDER BY r.mtime DESC");

    if ($record) {
        return $CFG->wwwroot.'/mod/idp/revision.php?id='.$record->planid.'&amp;rev='.$record->revid;
    }
    else {
        return '';
    }
}

/**
 * Add the given objective to the user's favourites.
 */
function add_to_favourites($userid, $objectiveid) {

    if (count_records('idp_favourite', 'userid', $userid, 'objective', $objectiveid) > 0) {
        return true; // Don't add favourites more than once
    }

    $record = new stdclass();
    $record->objective = $objectiveid;
    $record->userid = $userid;
    $record->ctime = time();

    return insert_record('idp_favourite', $record);
}

/**
 * Remove the given objective from the user's favourites.
 */
function delete_from_favourites($userid, $objectiveid) {

    if (0 == count_records('idp_favourite', 'userid', $userid, 'objective', $objectiveid)) {
        return true; // Objective has already been deleted
    }

    return delete_records('idp_favourite', 'userid', $userid, 'objective', $objectiveid);
}

/**
 * Format the given list of favourites with editing controls.
 */
function format_favourites($favourites, $revisionid, $curriculumcode) {
    global $CFG;

    $html = '';

    $opendiv = '<tr><td>';
    $opendiv .= print_spacer(1, 30, false, true);
    $opendiv .= '</td><td valign="middle">';
    $opendiv .= '<img alt="bullet" src="'.$CFG->pixpath.'/small_bullet_yellow.gif" />&nbsp;';
    $opendiv .= '</td><td valign="middle">';
    $closediv = "</td></tr>\n";

    $html .= "<table summary=\"\">\n";
    if (count($favourites) > 0) {
        // Get the list of objectives already added
        $alreadyadded = get_alreadyadded($curriculumcode, $revisionid);

        foreach ($favourites as $fav) {
            $html .= $opendiv;
            $html .= s($fav->objectivename);
            $html .= '</td><td class="editor_controls">';

            // Online curriculum button
            $html .= online_curriculum_link($fav->baseurl, $fav->urlsuffix);

            // Add to plan button
            $display = '';
            if (in_array($fav->objectiveid, $alreadyadded)) {
                $display = 'none';
            }
            $html .= '&nbsp;';
            $html .= "<img id=\"addfavobjective$fav->objectiveid\"";
            $html .= " style=\"display: $display; cursor: pointer\"";
            $html .= " onclick=\"toggle_objective($revisionid, $fav->objectiveid, '$curriculumcode', 1, 'addobj')\"";
            $html .= ' alt="'.get_string('addbutton', 'idp').'"';
            $html .= ' title="'.get_string('addbutton', 'idp').'"';
            $html .= " src=\"{$CFG->pixpath}/add.gif\" />";

            // Delete from favourites button
            $html .= '&nbsp;';
            $html .= "<img id=\"delfav$fav->objectiveid\"";
            $html .= " onclick=\"toggle_favourite($revisionid, $fav->objectiveid, '$curriculumcode', 'delfromfav')\"";
            $html .= ' style="cursor: pointer"';
            $html .= ' alt="'.get_string('delfavouritebutton', 'local').'"';
            $html .= ' title="'.get_string('delfavouritebutton', 'local').'"';
            $html .= " src=\"{$CFG->pixpath}/delete.gif\" />";

            $html .= $closediv;
        }
    }
    else {
        $html .= '<tr><td><i>'.print_spacer(18, 30, false, true);
        $html .= get_string('nofavourites', 'idp')."</i></td></tr>";
    }
    $html .= "</table>\n";

    return $html;
}

/**
 * Send email notifications out.
 *
 * @param string $type     The type of notification determines recipients and message contents
 * @param class $revision  Revision object as returned by get_revision()
 * @param class $subsargs  Values for the placeholders in the message contents
 */
function idp_email_notification($type, $revision, $subsargs) {
    global $CFG;

    if (empty($revision->userid)) {
        $revision->userid = get_field('idp', 'userid', 'id', $revision->idp);
    }
    $users = array();
    $from = get_string('emailnotificationfromname', 'idp');
    $subject = get_string('emailsubject' . $type, 'idp');
    $body = isset($CFG->{'idp_' . $type . '_text'})
        ? $CFG->{'idp_' . $type . '_text'}
        : get_string('admin:' . $type . 'textdefault', 'idp');
    $extras = '';
    $subsargs = (object)$subsargs;
    $validkeys = array();
    switch ($type) {
        case 'traineecommented':
            // get a list of the managers and send it them
            $users = get_notification_receivers(get_context_instance(CONTEXT_USER, $revision->userid));
            $validkeys = array('traineename', 'planname', 'link');
            $extras = $subsargs->comment; // take this out before doing the string substitution
            unset($subsargs->comment);
        break;
        case 'managercommented':
            // just send it to the trainee
            $users[] = get_user_light($revision->userid);
            $validkeys = array('managername', 'planname', 'link');
            $extras = $subsargs->comment; // take this out before doing the string substitution
            unset($subsargs->comment);
        break;
        case 'completed':
        case 'submitted':
            // mail all the managers
            $users = get_notification_receivers(get_context_instance(CONTEXT_USER, $revision->userid));
            $validkeys = array('traineename', 'link');
        break;
        case 'approved':
            // mail the trainee
            $users[] = get_user_light($revision->userid);
            $validkeys = array('managername', 'onbehalfof', 'duedate', 'link');
        break;
        case 'approvedonbehalf':
            // mail the trainee, and person on whose behalf approval was made.
            $users[] = $subsargs->onbehalfofuser;
            $subsargs->traineename = fullname(get_user_light($revision->userid));
            $validkeys = array('managername', 'traineename', 'planname', 'duedate', 'link');
        break;
        default: // invalid type
            return false;
        break;
    }
    // link is always valid
    $validkeys[] = 'link';
    $subsargs->link = $CFG->wwwroot . '/mod/idp/revision.php?rev=' . $revision->id . '&id=' . $revision->idp;
    foreach ($validkeys as $key) {
        if (!isset($subsargs->{$key})) {
            $subsargs->{$key} = ''; //  Still replace the placeholder, we don't want the {{xyz}} tags appearing in output.
        }
        $body = preg_replace('/' . preg_quote('{{'  . $key . '}}') . '/', $subsargs->{$key}, $body);
    }
    if (!empty($extras)) {
        $extras .= "\n\n";
    }
    $extras .= "---\n\n" . get_string('emailnotificationfooter', 'idp');
    $body .= "\n\n" . $extras;
    foreach ($users as $user) {
        if (is_numeric($user)) {
            $user = get_user_light($user);
        }
        $fullname = fullname($user);
        $bodycopy = preg_replace('/' . preg_quote('{{recipientname}}') . '/', fullname($user), $body);
        email_to_user($user, $from, $subject, $bodycopy);
    }
}


/**
 * Show the curriculum browser and the list of objectives in a table.
 * (Used by revision.php and submit.php.)
 *
 * @param string $curriculumcode  The one-letter code for the curriculum to display
 * @param class $revision         Record from the idp_revision table, as returned by get_revision()
 * @param boolean $can_edit       Should the curriculum browser (used to add objectives) be shown?
 * @param boolean $return         Return the HTML code instead of printing it directly?
 */
function print_curriculum($curriculumcode, $revision, $can_edit, $return = false) {
    global $CFG;

    $listdata = '';
    $out = '';
    $out .=  '<div class="pagesection">';
    $out .=  '<h2>'.get_string("curriculum_{$curriculumcode}_title", 'idp').'</h2>';
    $out .=  '<blockquote>';

    $out .=  '<div id="objectivelist'.$curriculumcode.'">';
    $listdata = curriculum_objectives($curriculumcode, $revision, $can_edit);
    $out .=  $listdata;
    $out .=  "</div>\n";

    if ($can_edit) {
        $out .=  can_edit_curriculum_browser($curriculumcode, $revision->id, $CFG->idpenablefavourites);
    }

    if ($can_edit && $revision->id && $CFG->idpenablesearch) {
        $out .=  objsearch_form($curriculumcode, $revision->id);
    }

    $out .=  '</blockquote>';

    if (!$can_edit && empty($listdata)) {
        $out = '';
    } else {
        $out .=  '</div>';
    }

    if ($return) {
        return $out;
    }
    print $out;
}

/**
 * Show the list of freeform items along with the edit box.
 *
 * @param string $revisionid  ID of the revision to display
 * @param string $listtype    Type of the list to display.
 * @param boolean $can_edit   Should the multi-line edit box (used to add items) be shown?
 * @param boolean $return     Return the HTML code instead of printing it directly?
 */
function print_freeform_list($revisionid, $listtype, $can_edit = false, $return = false) {
    $out = '';
    $listdata = '';

    $out .= '<div class="pagesection">';
    if ($can_edit) {
        $out .= '<div class="editplanquestions">'.get_string("list{$listtype}description", 'idp');
        $out .=  helpbutton("list{$listtype}", get_string("help:list{$listtype}", 'idp'), 'idp', true, false, '', true);
        $out .= '</div>';
    }

    $out .=  '<h2>'.get_string("list{$listtype}heading", 'idp').'</h2>';
    $out .=  '<blockquote>';

    $out .=  '<div id="itemlist' . $listtype . '">';
    $listdata = get_list_items($revisionid, $listtype, $can_edit);
    $out .= $listdata;
    $out .=  '</div>';

    if ($can_edit) {
        $out .=  '<p>'.get_string("list{$listtype}explanation2", 'idp').'</p>';
        $out .=  print_freeform_textbox($revisionid, $listtype, true);
    }

    $out .=  '</blockquote>';
    $out .= '</div>';
    if (!$can_edit && empty($listdata)) {
        $out = '';
    }
    if ($return) {
        return $out;
    }
    print $out;
}


function print_revision_manager($revision, $plan, $options=array()) {
    global $USER, $CFG;

    // merge in options array, in case of unset options, defaults are provided.
    $options = array_merge(array(
        'can_submit'  =>  false,
        'can_approve' =>  false,
    ), $options);


    // Personal details
    print  '<h2>'.get_string('personaldetailsheading', 'idp').'</h2>';
    if (empty($revision->owner)) {
        $revision->owner = $USER;
    }

    print_revision_details($revision, $options['can_submit'], $options['can_approve'], false, true);
    print_revision_list($plan->id, $revision->id);
    print revision_comments($revision);
    print_comment_textbox($revision->id);

    $usercurriculum = get_field('user', 'curriculum', 'id', $plan->userid);

    $competencies = idp_get_user_competencies($plan->userid, $revision->id);
    include $CFG->dirroot.'/plan/view-competencies.html';

    // Free-form lists
//    $objhtml = print_freeform_list($revision->id, 0, false, true);
//    $objhtml .= print_freeform_list($revision->id, 1, false, true);

    print_revision_extracomment($revision);
}

function print_revision_trainee($revision, $plan, $options=array()) {
    global $USER, $CFG;
    // merge in options array, in case of unset options, defaults are provided.
    $options = array_merge(array(
        'can_edit'      =>  false,
        'can_submit'    =>  false,
    ), $options);


    // Personal details
    print  '<h2>'.get_string('personaldetailsheading', 'idp').'</h2>';
    if (empty($revision->owner)) {
        $revision->owner = $USER;
    }

//    print_revision_details($revision, $options['can_submit'], false, false, true);
//    print_revision_list($plan->id, $revision->id);

    if ($options['can_edit']) {
        print_comment_textbox($revision->id);
    }
    print revision_comments($revision);

    $competencies = idp_get_user_competencies($plan->userid, $revision->id);
    include $CFG->dirroot.'/plan/view-competencies.html';

    $competencytemplates = idp_get_user_competencytemplates($plan->userid, $revision->id);
    include $CFG->dirroot.'/plan/view-competencytemplates.html';

    $courses = idp_get_user_courses($plan->userid, $revision->id);
    include $CFG->dirroot.'/plan/view-courses.html';

    // Free-form lists
//    $objhtml = print_freeform_list($revision->id, 0, $options['can_edit'], true);
//    $objhtml .= print_freeform_list($revision->id, 1, $options['can_edit'], true);

    // Check for empty plans
    if (empty($objhtml) && empty($listshtml)) {
//        print '<p><i>'.get_string('emptyplan', 'idp')."</i></p>\n";
    } else {
        print $listshtml;
        print $objhtml;
//        print_revision_extracomment($revision);
    }
}

/**
 * Prints out a preview of the contents of the given revision. Used by
 * the submit and approve pages.
 *
 * @param object  $revision  Revision object as returned by get_revision()
 * @param object  $plan      Record from idp table
 * @param boolean $printable Should the print button be visible?
 */
function print_revision_preview($revision, $plan, $printable=true) {
    global $USER, $CFG;

    // Personal details
    print  '<h2>'.get_string('personaldetailsheading', 'idp').'</h2>';
    if (empty($revision->owner)) {
        $revision->owner = $USER;
    }

    if ($printable) {
        print print_button();
    }

//    print_revision_details($revision, false, false, false, false);

    $competencies = idp_get_user_competencies($plan->userid, $revision->id);
    if ($competencies) {
       require $CFG->dirroot.'/plan/view-competencies.html';
    } else {
       print '<p><i>'.get_string('emptyplancompetencies', 'idp')."</i></p>\n";
    }

/*
    // Free-form lists
    $objhtml = print_freeform_list($revision->id, 0, false, true);
    $objhtml .= print_freeform_list($revision->id, 1, false, true);

    // Check for empty plans
    if (empty($objhtml) && empty($listshtml)) {
        print '<p><i>'.get_string('emptyplan', 'idp')."</i></p>\n";
    } else {
        print $listshtml;
        print $objhtml;
        print_revision_extracomment($revision);
    }
*/
}

function print_revision_pdf($revision, $plan, $options=array()) {
    global $USER, $CFG;

    // merge in options array, in case of unset options, defaults are provided.
    $options = array_merge(array(
        'can_submit'      =>  false,
        'show_comments'         =>  false,
    ), $options);


    // Personal details
    print  '<h2>'.get_string('personaldetailsheading', 'idp').'</h2>';
    if (empty($revision->owner)) {
        $revision->owner = $USER;
    }

    print_revision_details($revision, $options['can_submit'], false, true, false);
    if ($options['show_comments']) {
        print revision_comments($revision);
    }

    $competencies = idp_get_user_competencies($plan->userid, $revision->id);
    if ($competencies) {
       require $CFG->dirroot.'/plan/view-competencies.html';
    } else {
       print '<p><i>'.get_string('emptyplancompetencies', 'idp')."</i></p>\n";
    }

    // Free-form lists
//    $objhtml = print_freeform_list($revision->id, 0, false, true);
//    $objhtml .= print_freeform_list($revision->id, 1, false, true);

    print_revision_extracomment($revision);

}

/**
 * Display a floating print button at the
 */
function print_button() {
    return  '<div id="page_print_button" style="float:right;">'
        . '<button onclick="document.location += \'&amp;print=1\';">'
        . get_string('printviewbutton', 'idp').'</button></div>';
}

/**
 * Get this users competencies for this revision.
 *
 * @param class $revision       Revision object as returned by get_revision()
 * @param array $grades         Array of grades as submitted by the grades form
 * @param string $extracomment  Optional comment added to the evaluation
 */
function idp_get_user_competencies($userid, $currevisionid) {
    global $CFG;

    $sql = "
        SELECT DISTINCT
            c.id AS id,
            c.fullname,
            f.id AS fid,
            f.fullname AS framework,
            d.fullname AS depth
        FROM
            {$CFG->prefix}idp_revision_competency r
        INNER JOIN
            {$CFG->prefix}competency c
         ON r.competency = c.id
        INNER JOIN
            {$CFG->prefix}competency_framework f
         ON f.id = c.frameworkid
        INNER JOIN
            {$CFG->prefix}competency_depth d
         ON d.id = c.depthid
        WHERE r.revision = {$currevisionid}
        ";
    return get_records_sql($sql);
}

/**
 * Get this users competency templates for this revision.
 *
 * @param class $revision       Revision object as returned by get_revision()
 * @param array $grades         Array of grades as submitted by the grades form
 */
function idp_get_user_competencytemplates($userid, $currevisionid) {
    global $CFG;

    $sql = "
        SELECT DISTINCT
            c.id AS id,
            c.fullname,
            f.id AS fid,
            f.fullname AS framework
        FROM
            {$CFG->prefix}idp_revision_competencytemplate r
        INNER JOIN
            {$CFG->prefix}competency_template c
         ON r.competencytemplate = c.id
        INNER JOIN
            {$CFG->prefix}competency_framework f
         ON f.id = c.frameworkid
        WHERE r.revision = {$currevisionid}
        ";
    return get_records_sql($sql);
}

/**
 * Get this users courses for this revision.
 *
 * @param class $revision       Revision object as returned by get_revision()
 * @param array $grades         Array of grades as submitted by the grades form
 * @param string $extracomment  Optional comment added to the evaluation
 */
function idp_get_user_courses($userid, $currevisionid) {
    global $CFG;

    $sql = "
        SELECT DISTINCT
            c.id,
            c.fullname,
            cc.id as ccid,
            cc.name as category
        FROM {$CFG->prefix}idp_revision_course r
        INNER JOIN {$CFG->prefix}course c
          ON c.id=r.course
        INNER JOIN {$CFG->prefix}course_categories cc
          ON c.category=cc.id
        WHERE r.revision = {$currevisionid}
        ";
    return get_records_sql($sql);
}

/**
 * Mark the given revision as "evaluated" and give a grade to each
 * revision objective.
 *
 * @param class $revision       Revision object as returned by get_revision()
/**
 * Mark the given revision as "evaluated" and give a grade to each
 * revision objective.
 *
 * @param class $revision       Revision object as returned by get_revision()
 * @param array $grades         Array of grades as submitted by the grades form
 * @param string $extracomment  Optional comment added to the evaluation
 */
function idp_submit_evaluation($revision, $grades, $extracomment) {

    $record = new stdclass();
    $record->id = $revision->id;
    $record->evaluatedtime = time();
    $record->evaluationcomment = $extracomment;

    begin_sql();
    if ($grades->objid) {
        foreach ($grades->objid as $roid) {
            if (!isset($grades->{"grade$roid"})) {
                // One of the objectives was not evaluated
                return false;
            }

            $rorecord = new stdclass();
            $rorecord->id = clean_param($roid, PARAM_NUMBER);
            $rorecord->grade = clean_param($grades->{"grade$roid"}, PARAM_NUMBER);

            if (!update_record('idp_revision_objective', $rorecord)) {
                rollback_sql();
                return false;
            }
        }
    }

    if (!update_record('idp_revision', $record)) {
        rollback_sql();
        return false;
    }

    commit_sql();
    $fullname = fullname(get_user_light($revision->userid));
    idp_email_notification('completed', $revision, array('traineename' => $fullname));
    return true;
}

/**
 * Return a timestamp with the evaluation deadline for this plan.
 *
 * @param object $plan A plan record which includes the enddate field
 */
function idp_get_evaluation_deadline($plan) {
    return $plan->enddate - 2 * WEEKSECS;
}

/**
 * Return a table of themes and objectives along with the
 * self-evaluation "grade" for a given curriculum
 */
function curriculum_evaluations($curriculumcode, $revisionid) {
    global $CFG;

    $objectives = get_records_sql("SELECT ro.id AS roid, o.id AS objectiveid, t.name AS themename,
                                          d.name AS domainname, o.name AS objectivename, ro.postapproval,
                                          o.deleted AS objectivedeleted, o.urlsuffix AS objectiveurlsuffix,
                                          t.urlsuffix AS themeurlsuffix, c.baseurl, ro.grade
                                     FROM {$CFG->prefix}idp_revision_objective ro,
                                          {$CFG->prefix}racp_curriculum c,
                                          {$CFG->prefix}racp_domain d,
                                          {$CFG->prefix}racp_theme t,
                                          {$CFG->prefix}racp_objective o
                                    WHERE ro.revision = $revisionid AND
                                          c.code = '$curriculumcode' AND
                                          ro.objective = o.id AND o.theme = t.id AND
                                          t.domain = d.id AND d.curriculum = c.id");

    if ($objectives and count($objectives) > 0) {

        sort_objectives($objectives);

        $table = new stdclass();
        $table->class = 'generaltable objectiveevaluation';
        $table->rowclass[] = 'header';
        $table->data[] = array(get_string('themeorobjectivecolumn', 'idp'),
                               get_string('plangrade1', 'idp'),
                               get_string('plangrade2', 'idp'),
                               get_string('plangrade3', 'idp'),
                               get_string('plangrade4', 'idp'),
                               get_string('plangrade0', 'idp'),
                               '&nbsp;');
        $table->tablealign = 'left';
        $table->summary = 'List of Learning Objectives and a way to grade them';

        $lasttheme = '';
        foreach ($objectives as $objective) {
            if ($lasttheme != $objective->themename) {
                // Theme sub heading
                $table->rowclass[] = 'themename';
                $table->data[] = array(get_string('themeprefix', 'local') .
                                       s($objective->themename),
                                       '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;',
                                       online_curriculum_link($objective->baseurl,
                                                              $objective->themeurlsuffix));
                $lasttheme = $objective->themename;
            }

            // Form elements
            $idfield = '<input type="hidden" name="objid[]" value="'.$objective->roid .'" />';
            $grades = array();
            for ($i = 0; $i <= 4; $i += 1) {
                $grades[$i] = '<input type="radio" name="grade'.$objective->roid.'" value="'.$i.'" ';
                if ($objective->grade !== null and $objective->grade == $i) {
                    $grades[$i] .= 'checked="checked" ';
                }
                $grades[$i] .= "onclick=\"grade_objective($objective->roid, $i)\" />";
            }

            $deletebutton = '';
            if ($objective->postapproval) {
                $id = $objective->objectiveid;
                $deletebutton = '&nbsp;';
                $deletebutton .= "<img id=\"delobj$objective->objectiveid\"";
                $deletebutton .= " onclick=\"toggle_objective($revisionid, $objective->objectiveid, '$curriculumcode', true, 'deleteobj', this)\"";
                $deletebutton .= ' style="cursor: pointer"';
                $deletebutton .= ' alt="'.get_string('deletebutton', 'local').'"';
                $deletebutton .= ' title="'.get_string('deletebutton', 'local').'"';
                $deletebutton .= " src=\"{$CFG->pixpath}/delete.gif\" />";

                $table->rowclass[] = 'postapproval';
            }
            else {
                $table->rowclass[] = '';
            }

            $table->data[] = array($idfield . s($objective->objectivename),
                                   $grades[1], $grades[2], $grades[3], $grades[4], $grades[0],
                                   online_curriculum_link($objective->baseurl,
                                                          $objective->objectiveurlsuffix).$deletebutton);

        }

        return print_table($table, true);
    }
    else {
        return get_string('error:noobjectivestoevaluate', 'idp');
    }
}

/**
 * Show each learning objective which has been evaluated along with
 * the latest grade.
 */
function evaluation_summary($curriculumcode, $userid) {
    global $CFG;

    $themeobjectives = array(); // hash: $themename => array of $objective records
    {
        $themes = get_records_sql("SELECT t.name AS themename, d.name AS domainname,
                                          t.urlsuffix, c.baseurl
                                     FROM {$CFG->prefix}racp_theme t
                                     JOIN {$CFG->prefix}racp_domain d ON d.id = t.domain
                                     JOIN {$CFG->prefix}racp_curriculum c ON c.id = d.curriculum
                                    WHERE t.deleted = 0 AND c.code = '$curriculumcode'");
        sort_themes($themes);

        foreach ($themes as $theme) {
            $themeobjectives[$theme->themename] = $theme;
            $themeobjectives[$theme->themename]->objectives = array();
        }
    }

    {
        $joinsql = "FROM {$CFG->prefix}racp_curriculum c
                    JOIN {$CFG->prefix}racp_domain d ON d.curriculum = c.id
                    JOIN {$CFG->prefix}racp_theme t ON t.domain = d.id
                    JOIN {$CFG->prefix}racp_objective o ON o.theme = t.id
                    JOIN {$CFG->prefix}idp_revision_objective ro ON ro.objective = o.id
                    JOIN {$CFG->prefix}idp_revision r ON ro.revision = r.id
                    JOIN {$CFG->prefix}idp p ON r.idp = p.id";

        $wheresql = "WHERE p.userid = $userid AND c.code = '$curriculumcode' AND
                           r.evaluatedtime > 0";

        $objectives = get_records_sql("SELECT ro.id AS roid, o.id, t.name AS themename,
                                              ro.grade, r.evaluatedtime, d.name AS domainname,
                                              o.deleted AS objectivedeleted, o.name AS objectivename,
                                              o.urlsuffix, c.baseurl
                                              {$joinsql},
                                              (SELECT o.id, MAX(r.evaluatedtime) AS latesttime
                                                      $joinsql $wheresql GROUP BY o.id) sq
                                              $wheresql AND
                                              o.id = sq.id AND r.evaluatedtime = sq.latesttime");

        if ($objectives and count($objectives) > 0) {
            sort_objectives($objectives);

            foreach ($objectives as $obj) {
                $themeobjectives[$obj->themename]->objectives[] = $obj;
            }
        }
    }

    $table = new stdclass();
    $table->class = 'generaltable objectiveevaluation';

    // Table heading
    $table->rowclass[] = 'header';
    $table->data[] = array(get_string('themeorobjectivecolumn', 'idp'),
                           get_string('plangrade1', 'idp'),
                           get_string('plangrade2', 'idp'),
                           get_string('plangrade3', 'idp'),
                           get_string('plangrade4', 'idp'),
                           get_string('plangrade0', 'idp'),
                           get_string('lastevaluatedcolumn', 'idp'),
                           '&nbsp;');

    $table->tablealign = 'left';
    $table->summary = 'List of Learning Objectives and their self-evaluation grade';

    $lasttheme = '';
    foreach ($themeobjectives as $theme) {

        // Theme sub heading
        if ($lasttheme != $theme->themename) {
            $table->rowclass[] = 'themename';
            $table->data[] = array(get_string('themeprefix', 'local') .
                                   s($theme->themename),
                                   '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;',
                                   online_curriculum_link($theme->baseurl,
                                                          $theme->urlsuffix));
            $lasttheme = $theme->themename;
        }

        foreach ($theme->objectives as $objective) {

            $grades = array(0 => '&nbsp;', 1 => '&nbsp;', 2 => '&nbsp;', 3 => '&nbsp;', 4 => '&nbsp;');
            switch ($objective->grade) {
            case '0':
                $grades[0] = '<img title="'.get_string('plangrade0', 'idp').'"';
                $grades[0] .= ' alt="'.get_string('plangrade0', 'idp').'"';
                $grades[0] .= " src=\"{$CFG->pixpath}/redx.gif\" />";
                break;
            case '1':
            case '2':
            case '3':
            case '4':
                $grades[$objective->grade] = '<img title="'.get_string('plangrade'.$objective->grade, 'idp').'"';
                $grades[$objective->grade] .= ' alt="'.get_string('plangrade'.$objective->grade, 'idp').'"';
                $grades[$objective->grade] .= " src=\"{$CFG->pixpath}/greentick.gif\" />";
                break;
            }

            $table->rowclass[] = '';
            $table->data[] = array(s($objective->objectivename),
                                   $grades[1], $grades[2], $grades[3], $grades[4], $grades[0],
                                   strftime('%d-%m-%Y', $objective->evaluatedtime),
                                   online_curriculum_link($objective->baseurl,
                                                          $objective->urlsuffix));
        }
    }

    return print_table($table, true);
}

/**
 * Print a heading and the additional self-evaluation comments (if
 * any) for this revision.
 */
function print_revision_extracomment($revision) {
    if (!empty($revision->evaluationcomment)) {
        print '<h2>'.get_string('extraselfevaluationcommentsheading', 'idp').'</h2>';
        print '<blockquote><p>'.s($revision->evaluationcomment).'</p></blockquote>';
    }
}

/**
 * Get the list of favourites for a given user in a particular curriculum.
 */
function get_favourites($userid, $curriculumcode) {
    global $CFG;

    $favs = get_records_sql("SELECT o.id AS objectiveid, o.name AS objectivename,
                                    o.urlsuffix AS urlsuffix, c.baseurl AS baseurl
                             FROM {$CFG->prefix}idp_favourite f,
                                  {$CFG->prefix}racp_curriculum c,
                                  {$CFG->prefix}racp_domain d,
                                  {$CFG->prefix}racp_theme t,
                                  {$CFG->prefix}racp_objective o
                            WHERE c.code = '$curriculumcode' AND f.userid = $userid AND
                                  f.objective = o.id AND o.theme = t.id AND
                                  t.domain = d.id AND d.curriculum = c.id");
    if ($favs) {
        return $favs;
    }
    else {
        return array();
    }
}

/**
 * Search the given curriculum for the given search terms
 */
function search_objectives($searchterms, $curriculumcode, $revisionid) {
    global $CFG, $USER;
    $html = '';

    // Prepare the where clause of the SQL query
    $whereclause = '';
    $terms = explode(' ', $searchterms);
    if ($terms and count($terms) > 0) {
        foreach ($terms as $term) {
            $s = trim_punctuation($term);

            if (!empty($s)) {
                if (!empty($whereclause)) {
                    $whereclause .= ' AND ';
                }

                $whereclause .= "o.name ILIKE '%{$s}%'";
            }
        }
    }

    if (empty($whereclause)) {
        return ''; // Ignore empty searches
    }

    // Get data used to set initial state of buttons
    $alreadyadded = get_alreadyadded($curriculumcode, $revisionid);
    $favourites = false;
    if ($CFG->idpfavourites) {
        $favourites = array_keys(get_favourites($USER->id, $curriculumcode));
    }

    // Actual search
    $objectives = get_records_sql("SELECT o.*, c.baseurl AS baseurl
                                     FROM {$CFG->prefix}racp_objective o,
                                          {$CFG->prefix}racp_theme t,
                                          {$CFG->prefix}racp_domain d,
                                          {$CFG->prefix}racp_curriculum c
                                    WHERE c.code = '$curriculumcode' AND
                                          c.id = d.curriculum AND d.id = t.domain AND
                                          t.id = o.theme AND $whereclause
                                 ORDER BY o.name");

    $html .= '<h3>' . get_string('searchresults', 'idp') . '</h3>';
    if ($objectives and count($objectives) > 0) {
        $html .= "<table summary=\"\">\n";
        foreach ($objectives as $obj)  {
            // URL for the Online Curriculum
            $urlparts = array('suffix' => $obj->urlsuffix,
                              'base' => $obj->baseurl);

            $html .= objective_entry($obj->id, $obj->name, $obj->deleted, $obj->theme, $urlparts, true,
                                     $revisionid, $curriculumcode, $alreadyadded, $favourites, 'search');
        }
        $html .= "</table>\n";
    }
    else {
        $html .= '<p><i>'.print_spacer(1, 30, false, true).get_string('nosearchresults', 'idp')."</i></p>\n";
    }

    return $html;
}

/**
 * Get the list of objectives already added in the given revision and
 * curriculum.
 */
function get_alreadyadded($curriculumcode, $revisionid) {
    global $CFG;

    $alreadyadded = array();
    if ($revisionid) {
        // Cache all currently added objectives to hide the Add button
        $records = get_records_sql("SELECT o.id AS objectiveid
                                    FROM {$CFG->prefix}racp_curriculum c,
                                         {$CFG->prefix}racp_domain d,
                                         {$CFG->prefix}racp_theme t,
                                         {$CFG->prefix}racp_objective o,
                                         {$CFG->prefix}idp_revision_objective ro
                                    WHERE c.code = '$curriculumcode' AND
                                          o.id = ro.objective AND
                                          ro.revision = $revisionid AND
                                          o.theme = t.id AND t.domain = d.id AND
                                          d.curriculum = c.id");
        if ($records and count($records) > 0) {
            foreach ($records as $record) {
                $alreadyadded[] = $record->objectiveid;
            }
        }
    }

    return $alreadyadded;
}

/**
 * Set the self-evaluation grade for the given revision objective.
 *
 * @param integer $roid  ID in the idp_revision_objective table
 * @param integer $grade Grade from 0 to 4 (or NULL for "not graded")
 */
function idp_grade_objective($roid, $grade=null) {
    $record = new stdclass;
    $record->id = $roid;
    $record->grade = $grade;

    return update_record('idp_revision_objective', $record);
}

/**
 * Return a form to search for users and take
 * users to a results page linking to Learning Plan and profile pages.
 *
 * @param string  $search     Initial search string
 */
function usersearch_form($search='') {
    global $CFG;

    $url  = $CFG->wwwroot .'/plan/user_search.php';
    $text = '<form id="idp_search" method="get" action="'.  $url . '">';
    $text .= '<div>';
    $text .= '<input type="text" name="search" value="' . s($search) . '"/>';
    $text .= '<input type="submit" value="Search" />';
    $text .= '</div>';
    $text .= '</form>';
    return $text;
}

/**
 * Return the fullname of the user linking to his profile page.
 *
 * @param $userid     User ID of the user to display
 * @param $youstring  String to be used when userid is the logged in user
 *                    (set to false to use the fullname)
 */
function format_user_link($userid, $youstring='Yourself') {
    global $CFG, $USER;

    $user = get_record('user', 'id', $userid);
    $link = $CFG->wwwroot."/user/view.php?id=$userid";

    if ($user->id == $USER->id and $youstring !== false) {
        return $youstring;
    }

    return "<a href=\"$link\">".fullname($user).'</a>';
}

/**
 * Convert a date entered as a string by the user to a UNIX timestamp.
 *
 * The supported formats are:
 *   YYYYMMDD
 *   YYYY-MM-DD (ISO 8601 -- preferred format)
 *   YYYY/MM/DD
 *   DD/MM/YYYY
 *   DD-MM-YYYY
 *
 * Plus anything that strtotime() supports, see the GNU docummentation at:
 *
 *   http://www.gnu.org/software/tar/manual/html_node/tar_113.html
 */
function convert_userdate($datestring) {
    // Check for DD/MM/YYYY
    if ($datearray = strptime($datestring, '%d/%m/%Y')) {
        return mktime($datearray['tm_hour'], $datearray['tm_min'], $datearray['tm_sec'],
                      1 + $datearray['tm_mon'], $datearray['tm_mday'], 1900 + $datearray['tm_year']);
    }

    return strtotime($datestring);
}

$collapsing_tree_node_groups = array();

/**
 * Writes out the data, for mutually exclusive collapsing_tree_nodes.  These
 * mutex groups must be created by using the groupid parameter of
 * collapsing_tree_node.
 */
function collapse_groups_script() {
    global $collapsing_tree_node_groups;

    $out =  "<script type=\"text/javascript\">\nvar _toggle_div_groups = {\n";
    $outarr = array();
    foreach($collapsing_tree_node_groups as $groupid => $divs) {
        if (!empty($divs)) {
            $outarr[] = $groupid . ": [ '" . implode("', '", $divs) . "' ]";
        }
    }
    $out .= implode(",\n", $outarr);
    $out .= "\n};\n</script>";
    return $out;
}

/**
 * This function sends headers suitable for all JSON returning scripts.
 *
 * (taken from Mahara, lib/web.php)
 */
function json_headers() {
    header('Content-type: text/plain');
    header('Pragma: no-cache');
}

function get_user_light($id) {
    return get_record('user', 'id', $id, '', '', '', '', 'id,firstname,lastname,email,idnumber');
}

?>
