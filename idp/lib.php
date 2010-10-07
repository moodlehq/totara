<?php
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/idp/view-competencies.php');
require_once($CFG->dirroot.'/idp/view-competencytemplates.php');
require_once($CFG->dirroot.'/idp/view-courses.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/reportheading/lib.php');


/**
 * IDP related constants
 */
define('DATE_FORMAT', '%d/%m/%Y');

/**
 * Config options
 */
define('IDP_NO',  0);
define('IDP_OPT', 1);
define('IDP_REQ', 2);


$CFG->idpenablefavourites = false;

/**
 * Create a new Learning Plan along with an initial revision
 */
function create_new_plan($name='', $startdate=0, $enddate=0, $templateid=0) {
    global $USER, $CFG;

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
    $idp->templateid = $templateid;
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
    if (!$revisionid = insert_record('idp_revision', $revision)) {
        rollback_sql();
        return false;
    }

    // Get all cometency areas then loop through all frameworks
    // and add each cometency in that framework to the idp
    $now = time();
    $defaultsql = "SELECT s.defaultid AS id
        FROM {$CFG->prefix}idp_tmpl_priority_scale s
        JOIN {$CFG->prefix}idp_tmpl_priority_assign a
        ON s.id=a.priorityscaleid
        WHERE a.templateid={$templateid}";
    if($defaultpriority = get_record_sql($defaultsql)){
        $plancometencies = array();

        $sql = "SELECT c.id, c.name FROM mdl_comp c
            JOIN mdl_idp_comp_area_fw fw
            ON fw.frameworkid=c.frameworkid
            JOIN mdl_idp_comp_area ca
            ON fw.areaid=ca.id
            WHERE ca.templateid={$templateid}";
        if($competencies = get_records_sql($sql)){
            foreach($competencies as $competency){
                $idpcomp = new stdclass();
                $idpcomp->ctime = $now;
                $idpcomp->revision = $revisionid;
                $idpcomp->competency = $competency->id;
                $idpcomp->priority = $defaultpriority->id;
                $plancompetencies[] = $idpcomp;
            }

            foreach($plancompetencies as $record){
                if(!insert_record('idp_revision_competency', $record)){
                    rollback_sql();
                    return false;
                }
            }
        }
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
        $dates->start = strftime('%e %h %Y', $plan->startdate);
        $dates->end = strftime('%e %h %Y', $plan->enddate);
        $revision->period = get_string('starttoenddates', 'idp', $dates);

        // Extra information not directly in the revision table
        $revision->evaluationdeadline = idp_get_evaluation_deadline($plan);
        $revision->approval = get_record('idp_approval', 'revision', $revision->id);
        $revision->status = get_revision_status($revision);
    }

    return $revision;
}

/**
 * Return the plan that a given revision belongs to
 *
 * @param int $revisionid
 * @return object
 */
function get_plan_for_revision($revisionid){
    global $CFG;
    
    return get_record_sql(
            "SELECT p.id, p.name, p.startdate, p.enddate, p.userid from "
            . "{$CFG->prefix}idp_revision r, "
            . "{$CFG->prefix}idp p "
            . "WHERE r.id = $revisionid and r.idp = p.id"
    );
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

    if (! $user = get_record('user', 'id', $revision->owner->id)) {
        error('User not found');
    }

    // display heading block for this user
    $heading = new reportheading($user->id);
    print $heading->display(2,false);
    print '<br />';

    // display another table with training info
    // TODO merge these two tables?

    $table->tablealign = 'left';
    $table->class = 'generaltable personaldetails';

    $prefix = ($pdf) ? '<b>' : '';
    $suffix = ($pdf) ? '</b>' : '';

    // Personal information
    if(!$pdf && $showactions){
        $printoptions = '';
        if ('approved' == $revision->status or 'overdue' == $revision->status) {
            $printoptions .= ' - <a href="'.$CFG->wwwroot.'/idp/revision_pdf.php?id=' . $revision->idp . '">' . get_string('exporttopdf', 'idp') . '</a>';
        }

        $table->data[] = array ($prefix . 'Display options' . $suffix, "<b>" . $printoptions . "</b>");
    }
    else {
        $table->data[] = array($prefix . get_string('trainingperiod', 'idp') . $suffix, $revision->period);
    }
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
        if ($can_submit && get_config(NULL, 'idp_enableeval')==2) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/idp/evaluation.php?id=' . $revision->idp . '">'.get_string('evaluateplan', 'idp').'</a>';
        }
        else{
            $nextactions .= 'Manager evaluation';
        }
    }
    elseif ('withdrawn' == $revision->status) {
        if ($can_submit) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/idp/revision.php?id='.$revision->idp.'">'.get_string('editlatestrevision', 'idp').'</a>';
        }
        else {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/idp/revision.php?id='.$revision->idp.'">'.get_string('viewlatestrevision', 'idp').'</a>';
        }
    }
    elseif ('submitted' == $revision->status) {
        if ($can_approve) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/idp/approve.php?rev='.$revision->id.'">'.get_string('approveplan', 'idp').'</a> - ';
            $nextactions .= '<a href="'.$CFG->wwwroot.'/idp/reject.php?rev='.$revision->id.'">'.get_string('rejectplan', 'idp').'</a>';
        }

    }
    elseif ('inrevision' == $revision->status) {
        if ($can_submit) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/idp/submit.php?submitbutton=1&rev='.$revision->id.'">'.get_string('submitplan', 'idp').'</a> - ';
        }
        $nextactions .= '<a href="#" id="toggle_addcomments">' . get_string('commentonplan', 'idp') . '</a>';
    }
    elseif ('notsubmitted' == $revision->status) {
        if ($can_submit) {
            $nextactions .= '<a href="'.$CFG->wwwroot.'/idp/submit.php?submitbutton=1&rev='.$revision->id.'">'.get_string('submitplan', 'idp').'</a>';
        }
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
function print_revision_list($planid, $currevisionid, $pdf=null) {
    global $CFG;

    $revisions = get_records('idp_revision', 'idp', $planid, 'ctime DESC');

    if (count($revisions) > 1) {
        print "<ul id=\"revisionlist\">\n";
        print "  <li>".get_string('allrevisions','idp')."\n";
        print "    <ul>\n";
        foreach ($revisions as $revision){
            $datestring = userdate($revision->ctime);
            if ($revision->id != $currevisionid){
                print "      <li><a href=\"revision.php?id={$planid}&amp;rev={$revision->id}\">{$datestring}</a></li>\n";
            } else {
                print "      <li>{$datestring}</li>\n";
            }
        }
        print "    </ul>\n";
        print "  </li>\n";
        print "</ul>\n";
        if(!$pdf){
            print "<script type=\"text/javascript\">\n";
            print "  $(\"#revisionlist\").treeview({\n";
            print "    collapsed: true\n";
            print "  });\n";
            print "</script>\n";
        }
    }
}

/**
 * Print a list of the comments for a revision
 * @global object $CFG
 * @param int $revision
 */
function print_comment_list($revision) {
    global $CFG;

    $comments = get_records('idp_revision_comment', 'revision', $revision->id, 'ctime DESC');
    $out = '';
    // Print list of all comments with their contents
    if ($comments and count($comments) > 0) {

        $out .= "<ul id=\"commentscontainer\">\n";
        $out .= "  <li>".get_string('allcommentsonthisrevision','idp')."\n";
        $out .= "    <ul>\n";

        foreach ($comments as $comment) {
            $out .= "      <li>";
            $authorlink = format_user_link($comment->author, 'You');
            $datestring = userdate($comment->ctime);

            $out .= '<b>'.get_string('usersaid', 'idp', $authorlink);
            $out .= ' ('.get_string('ondate', 'idp',$datestring).'):';
            // Ensure line-breaks are represented.
            $contents = s($comment->contents);
            $contents = preg_replace('/\n/', '<br />', $contents);
            $out .= '</b><br />'.$contents.'<br /><br />';
            $out .= "</li>\n";
        }
        $out .= "    </ul>\n";
        $out .= "  </li>\n";
        $out .= "</ul>\n";
        $out .= "<script type=\"text/javascript\">\n";
        $out .= "  \$(\"#commentscontainer\").treeview({\n";
        $out .= "    collapsed: true\n";
        $out .= "  });\n";
        $out .= "</script>\n";
    }
    print $out;
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
                $html .= " src=\"{$CFG->pixpath}/delete.gif\" class=\"iconsmall\" alt=\"Remove\" />";

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
    $html .= ' alt="'.get_string('edit').'"';
    $html .= ' title="'.get_string('edit').'"';
    $html .= " src=\"{$CFG->pixpath}/edit.gif\" class=\"iconsmall\" alt=\"Edit\" />";

    // Delete button
    $html .= '&nbsp;';
    $html .= "<img id=\"del$listtype{$item->id}\"";
    $html .= " onclick=\"listitem_action($revid, '$listtype', {$item->id}, 'del')\"";
    $html .= ' style="cursor: pointer"';
    $html .= ' alt="'.get_string('delete').'"';
    $html .= ' title="'.get_string('delete').'"';
    $html .= " src=\"{$CFG->pixpath}/delete.gif\" class=\"iconsmall\" alt=\"Remove\" />";

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
                $editcontrols .= ' value="'.get_string('save', 'idp').'" />';

                // Cancel button
                $editcontrols .= " <input type=\"button\" id=\"cancel$listtype{$item->id}\"";
                $editcontrols .= " style=\"display: none\"";
                $editcontrols .= " onclick=\"listitem_action($revid, '$listtype', {$item->id}, 'cancel')\"";
                $editcontrols .= ' value="'.get_string('cancel').'" />';

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
 * Prints a textbox to allow the user to comment on a revision of an IDP
 * @global object $CFG
 * @param int $revisionid
 */
function print_comment_textbox($revisionid) {
    global $CFG;

    print '<form method="get" id="commentsadd-form" action="'.$CFG->wwwroot.'/idp/revision-addcomment.php">';
    print '<input type="hidden" name="rev" value="'.$revisionid.'"/>';
    print '<div id="commentsadd">';
    print '<p>'.get_string('addcomment', 'idp').'&nbsp;';

    print '<textarea name="comment" id="commentfield" rows="5" cols="60" style="vertical-align:top; display: block;"></textarea>';

    print '<input type="submit" value="'.get_string('additembutton', 'idp').'" /></p>';
    print "</div>\n";
    print '</form>';
    // todo: add some code to do this comment adding by Ajax
    print <<<HTML
        <script type="text/javascript">
            $("#commentsadd").css( "display", "none" );
            $("#toggle_addcomments").click(function(){
                var display = $("#commentsadd").css( "display" );
                if ( display == "none" ){
                    $("#commentsadd").css( "display", "block" );
                } else {
                    $("#commentsadd").css( "display", "none" );
                }
                return false;
            });
        </script>
HTML;
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
 * Delete the given plan if it only contains one empty revision.
 */
function delete_plan($planid) {
    global $CFG;
    // Make sure there is only one revision
    if (count_records('idp_revision', 'idp', $planid) > 1) {
        return false;
    }

    $revisions = get_records_sql("SELECT * FROM {$CFG->prefix}idp_revision WHERE idp={$planid}");
    foreach($revisions as $revision){
        if(get_revision($planid) == $revision){
            // Make sure the current revision has not been submitted
            if ('notsubmitted' != $revision->status) {
                return false; // Status must be unsubmitted
            }
        }
        // Actual deletion
        begin_sql();
        if (!delete_records('idp_revision_competency', 'id', $revision->id)) {
            rollback_sql();
            return false;
        }
        if (!delete_records('idp_revision_course', 'id', $revision->id)) {
            rollback_sql();
            return false;
        }

        if (!delete_records('idp_revision_comment', 'id', $revision->id)) {
            rollback_sql();
            return false;
        }

        if (!delete_records('idp_list_item', 'id', $revision->id)) {
            rollback_sql();
            return false;
        }

        if (!delete_records('idp_revision', 'id', $revision->id)) {
            rollback_sql();
            return false;
        }
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
 * Add a comment to a plan
 *
 * @global object $USER
 * @global object $CFG
 * @param int $revisionid
 * @param string $comment
 * @return boolean success/failure
 */
function add_comment($revisionid, $comment) {
    global $USER, $CFG;

    if (empty($comment)) {
        return true; // Ignore empty strings
    }

    $record = new stdclass();
    $record->revision = $revisionid;
    $record->contents = addslashes($comment);
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
                'comment' => stripslashes($comment),
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
 * Create a new plan given a revision of a previous plan.
 */
function clone_plan($revisionid){

    $origionalplan = get_plan_for_revision($revisionid);

    $newplan = new stdclass();
    $newplan->name = addslashes($origionalplan->name);
    $newplan->startdate = $origionalplan->startdate;
    $newplan->enddate = $origionalplan->enddate;
    $newplan->userid = $origionalplan->userid;
    $newplan->current = 0;

    begin_sql();
    if (!$newplanid = insert_record('idp', $newplan)){
        rollback_sql();
        return false;
    }
    if (!$newrev = clone_revision($revisionid, $newplanid)){
        rollback_sql();
        return false;
    }

    commit_sql();
    return $newplanid;
}

/**
 * Create a new revision and copy all of the data from the given plan
 * revision.
 * Optional paramter of a plan to add the new revision to, if specified
 * the cloned revision will appear as 'Not yet submitted'
 */
function clone_revision($revisionid, $newplanid) {

    $ctime = time();
    $originalrev = get_revision(0, $revisionid);

    // Create the initial revision
    $newrev = new stdclass();
    if($newplanid){
        $newrev->idp = $newplanid;
        $newrev->visible = 0;
    }
    else {
        $newrev->idp = $originalrev->idp;
        $newrev->visible = 1;
    }
    $newrev->ctime = $ctime;
    $newrev->mtime = $ctime;

    begin_sql();
    if (!$newid = insert_record('idp_revision', $newrev)) {
        rollback_sql();
        return false;
    }

    if (!_clone_revision_objectives( 'idp_revision_competency', $originalrev->id, $newid )){
        rollback_sql();
    }
    if (!_clone_revision_objectives( 'idp_revision_competencytmpl', $originalrev->id, $newid )){
        rollback_sql();
    }
    if ( !_clone_revision_objectives( 'idp_revision_course', $originalrev->id, $newid ) ){
        rollback_sql();
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
 * Function to clone one of the objective tables for an IDP revision
 *
 * @param string $table name of the table
 * @return boolean success or failure
 */
function _clone_revision_objectives( $table, $origrevid, $newrevid ){
    $objectives = get_records($table, 'revision', $origrevid);
    if ($objectives and count($objectives) > 0) {
        foreach ($objectives as $objective) {
            $objective->revision = $newrevid;
            if (!insert_record($table, $objective)) {
                //rollback_sql();
                return false;
            }
        }
    }
    return true;
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

    $users = get_users_by_capability($contextuser, 'moodle/local:idpapproveplan', '', 'firstname,lastname');
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

        $plans = get_records_sql("SELECT r.id AS revid, p.id AS id, p.current,
                                         u.lastname AS lastname, u.firstname AS firstname,
                                         r.submittedtime AS submissiontime, r.mtime AS mtime,
                                         a.ctime AS approvaltime
                                    FROM {$CFG->prefix}idp p,
                                         {$CFG->prefix}idp_revision r,
                                         {$CFG->prefix}user u,
                                         ($revisionapprovedsubquery) a
                                   WHERE r.idp = p.id AND u.id = p.userid AND u.deleted <> 1 AND
                                         p.userid IN ($userids) AND a.revision = r.id
                                         ORDER BY p.current, $orderby, mtime DESC");
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

    $usercontext = get_context_instance(CONTEXT_USER, $userid);
    // Check if user is viewing his/her own page
    $ownpage = ($USER->id == $userid);

    // Fetch all plans, and add revision and approval info at same time.
    $plans = get_records_sql("SELECT r.id AS revid, p.id, p.name AS planname, p.enddate, p.current,
                                     r.mtime, r.visible, a.revision AS approval,
                                     r.submittedtime, r.withdrawntime, r.evaluatedtime
                                FROM {$CFG->prefix}idp p
                                JOIN {$CFG->prefix}idp_revision r ON r.idp=p.id
                           LEFT JOIN {$CFG->prefix}idp_approval a ON a.revision=r.id
                               WHERE p.userid = $userid AND
                                     r.ctime = (SELECT MAX(ctime)
                                                  FROM {$CFG->prefix}idp_revision
                                                  WHERE idp = p.id)
                                                  ORDER BY p.current DESC, r.mtime DESC");
    // Set the status on each revision
    if (!is_array($plans)) {
        $plans = array();
    }
    foreach ($plans as $plan) {
        $plan->evaluationdeadline = idp_get_evaluation_deadline($plan);
        $plan->status = get_revision_status($plan);
    }

    // Make list of trainee user IDs
    print "<div id=\"planlist\">\n";

    $visibleplans = 0; // Number of plans that could be displayed on the page if perpage was equal to infinity

    if ($plans and count($plans) > 0) {
        $table = '<table class="generalbox planlist boxaligncenter">';

        $table .= '<tr><th class="name">'.get_string('name').'</th>';
        if ($canviewplans) {
            $table .= '<th class="lastchanged">'.get_string('lastchanged', 'idp').'</th>';
            $table .= '<th class="status">'.get_string('status', 'idp').'</th>';
            $table .= '<th class="options">'.get_string('options', 'idp').'</th>';
        }
        $table .= '</tr>';

        // Load the button strings now, rather than doing it each time in the loop.
        $renameplanstr = get_string('renameplanbutton', 'idp');
        $deleteplanstr = get_string('deleteplanbutton', 'idp');
        $cloneplanstr = get_string('cloneplanbutton', 'idp');
        if ($plans) {
            $rowcount = 0;
            foreach($plans as $plan) {
                // Hide unsubmitted revisions from others
                if (($userid != $USER->id) and ($plan->visible != 1)) {
                    continue;
                }

                if ($canviewplans) {
                    // Get the full status of the plan
                    $formattedstatus = format_revision_status($plan, false, false, false);
                    if ($ownpage and ('approved' == $plan->status or 'overdue' == $plan->status) and get_config(NULL, 'idp_enableeval')==2) {
                        $evaluationdeadline = idp_get_evaluation_deadline($plan);
                        $formattedstatus .= ' (<a href="evaluation.php?id='.$plan->id.'">'.
                            get_string('selfevaluationdueby', 'idp',
                                       strftime('%d-%m-%Y', $evaluationdeadline)).'</a>)';
                    }

                    // Begin table row
                    $table .= "<tr class=\"r{$rowcount}\"><td><a href=\"revision.php?id={$plan->id}\">{$plan->planname}</a>";
                        if($plan->current==1){
                            $table .= " (".get_string('currentplan','idp').")";
                        }
                        $table .= "</td>";
                    $table .= '<td>'.userdate($plan->mtime, '%e %b %y').'</td>';
                    $table .= "<td>{$formattedstatus}</td>";

                    // Add editing buttons if appropriate
                    $table .= '<td class="options">';
                    if ($ownpage) {
                        if ('notsubmitted' == $plan->status) {
                            $table .= user_learning_plan_editbutton($plan->id, $renameplanstr)
                                .' '. user_learning_plan_deletebutton($plan->id, $deleteplanstr);
                        }
                        else {
                            $table .= '<img src="' . $CFG->pixpath . '/spacer.gif" class="iconsmall" />'
                                . ' ' . '<img src="' . $CFG->pixpath . '/spacer.gif" class="iconsmall" />';
                        }
                    }
                    if(has_capability('moodle/local:idpsetcurrent', $usercontext) && $plan->current!=1){
                        $table .= ' '. user_learning_plan_currentsetbutton($plan->id, get_string('currentset', 'idp'), $userid);
                    }
                    else{
                        $table .= '<img src="' . $CFG->pixpath . '/spacer.gif" class="iconsmall" />';
                    }
                    $table .= ' '.user_learning_plan_clonebutton($plan->id, $cloneplanstr);
                    $table .= '</td></tr>';
                }
                else {
                    $table .= "<tr><td><a href=\"revision.php?id={$plan->id}\">{$plan->planname}</a><td></tr>";
                }
                $rowcount = ($rowcount + 1) % 2;
            }
        } else {
            print '<i>'.get_string('noplansubmittedorapproved', 'idp').'</i>';
        }
        $table .= '</table>';
        echo $table;
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
            . "title=\"$renameplanstr\" src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"Edit\""
            . "/></a>";
    return $link;
}

function user_learning_plan_deletebutton($planid, $deleteplanstr) {
    global $CFG;
    $link = "<a href=\"plan.php?action=delete"
        . "&amp;planid={$planid}\">"
        . "<img id=\"deleteplan{$planid}\" "
        . "style=\"cursor: pointer\" alt=\"$deleteplanstr\" "
        . "title=\"$deleteplanstr\" src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"Remove\" "
        . "/></a>";
    return $link;
}

function user_learning_plan_currentsetbutton($planid, $makecurrentstr, $userid) {
    global $CFG;
    $link = "<a href=\"index.php?userid={$userid}"
        . "&amp;planid={$planid}&amp;current=1\">"
        . "<img id=\"current{$planid}\" "
        . "style=\"cursor: pointer\" alt\"$makecurrentstr\" "
        . "title=\"$makecurrentstr\" src=\"{$CFG->pixpath}/t/current.gif\" class=\"iconsmall\""
        . "/></a>";
    return $link;
}

function user_learning_plan_clonebutton($planid, $clonestr) {
    global $CFG;
    $link = "<a href=\"plan.php?planid={$planid}"
        . "&amp;action=clone \">"
        . "<img id=\"cloneplan{$planid}\" "
        . "style=\"cursor: pointer\" alt\"$clonestr\" "
        . "title=\"$clonestr\" src=\"{$CFG->pixpath}/t/copy.gif\" class=\"iconsmall\""
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
        return $CFG->wwwroot.'/idp/'.$page.'.php?id='.$record->planid.'&amp;rev='.$record->revid;
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
        return $CFG->wwwroot.'/idp/revision.php?id='.$record->planid.'&amp;rev='.$record->revid;
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
            $html .= " src=\"{$CFG->pixpath}/delete.gif\" class=\"iconsmall\" alt=\"Remove\" />";

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
    $subsargs->link = $CFG->wwwroot . '/idp/revision.php?rev=' . $revision->id . '&id=' . $revision->idp;
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


function print_revision_manager($revision, $plan, $formstartstr, $options=array()) {
    global $USER, $CFG;
    $defaultframeworkid = get_field_sql("SELECT id FROM {$CFG->prefix}comp_framework ORDER BY sortorder ASC");

    $type = optional_param('type', 'competencies', PARAM_ALPHA);
    if(!$frameworkid = optional_param('framework', $defaultframeworkid, PARAM_INT)){
        $frameworkid=0;
    }
    $page = optional_param('page', 0, PARAM_INT);
    $perpage = optional_param('perpage', 20, PARAM_INT);
    $start = $page*$perpage;

    // merge in options array, in case of unset options, defaults are provided.
    $options = array_merge(array(
        'can_submit'  =>  false,
        'can_approve' =>  false,
        'can_edit' => false
    ), $options);


    // Personal details
    print  '<h2>'.get_string('personaldetailsheading', 'idp').'</h2>';
    if (empty($revision->owner)) {
        $revision->owner = $USER;
    }

    print_revision_details($revision, $options['can_submit'], $options['can_approve'], false, true);
    print_revision_list($plan->id, $revision->id);
    print_comment_list($revision);
    print_comment_textbox($revision->id);

    // Get user's positions
    $user = (object) array('id' => $plan->userid);

    $position = new position();
    $haspositions = (bool) $position->get_user_positions($user);

    echo "{$formstartstr}\n";
    $currenttab = $type.$frameworkid;
    require('tabs.php');

    if($frameworkid!=0){
        if($type == 'competencies'){
            $compcount = get_record_sql("SELECT COUNT(*) FROM {$CFG->prefix}idp_revision_competency rc JOIN {$CFG->prefix}comp c ON rc.competency=c.id WHERE revision={$revision->id} AND frameworkid={$frameworkid}");

            $competencies = idp_get_user_competencies($plan->userid, $revision->id, $frameworkid, $start, $perpage, 'fullname');
            print_idp_competencies_view_flex($revision, $competencies, $options['can_edit'], $haspositions, $page, $perpage, $compcount->count);
        }

        if($type == 'comptemplates'){
            $templatecount = get_record_sql("SELECT COUNT(rct.id)
                FROM {$CFG->prefix}idp_revision_competencytmpl rct
                INNER JOIN {$CFG->prefix}comp_template ct
                ON rct.competencytemplate = ct.id
                WHERE revision={$revision->id} AND frameworkid={$frameworkid}");

            $competencytemplates = idp_get_user_competencytemplates($plan->userid, $revision->id, $frameworkid, $page, $perpage, 'fullname');
            print_idp_competency_templates_view_flex($revision, $competencytemplates, $options['can_edit'], $haspositions, $page, $perpage, $templatecount->count);
        }
    }
    else if($type == 'competencies' || $type == 'comptemplates') {
        echo get_string('noframeworks', 'competency');
    }
    if($type == 'courses'){
        $coursecount = get_record_sql("SELECT COUNT(*) FROM {$CFG->prefix}idp_revision_course WHERE revision={$revision->id}");

        $courses = idp_get_user_courses($plan->userid, $revision->id, $start, $perpage, null);
        print_idp_courses_view_flex($revision, $courses, $options['can_edit'], $page, $perpage, $coursecount->count);
    }

    print_revision_extracomment($revision);
}

function print_revision_trainee($revision, $plan, $formstartstr, $options=array()) {
    global $USER, $CFG;
    $defaultframeworkid = get_field_sql("SELECT id FROM {$CFG->prefix}comp_framework ORDER BY sortorder ASC");

    $type = optional_param('type', 'competencies', PARAM_ALPHA);
    if(!$frameworkid = optional_param('framework', $defaultframeworkid, PARAM_INT)){
        $frameworkid=0;
    }
    $page = optional_param('page', 0, PARAM_INT);
    $perpage = optional_param('perpage', 20, PARAM_INT);

    $start = $page*$perpage;

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

    print_revision_details($revision, $options['can_submit'], false, false, true);
    print_revision_list($plan->id, $revision->id);

    $status = get_revision_status($revision);
    if($status == 'inrevision'){
        print_comment_textbox($revision->id);
    }
    print_comment_list($revision);

    // Get user's positions
    $user = (object) array('id' => $plan->userid);
    $position = new position();
    $haspositions = (bool) $position->get_user_positions($user);

    echo "{$formstartstr}\n";
    $currenttab = $type.$frameworkid;
    require('tabs.php');

    if($frameworkid!=0){
        if($type == 'competencies'){
            $compcount = get_record_sql("SELECT COUNT(*) FROM {$CFG->prefix}idp_revision_competency rc JOIN {$CFG->prefix}comp c ON rc.competency=c.id WHERE revision={$revision->id} AND frameworkid={$frameworkid}");
            $competencies = idp_get_user_competencies($plan->userid, $revision->id, $frameworkid, $start, $perpage, 'fullname');
            print_idp_competencies_view_flex($revision, $competencies, $options['can_edit'], $haspositions, $page, $perpage, $compcount->count);
        }

        if($type == 'comptemplates'){
            $templatecount = get_record_sql("SELECT COUNT(rct.id)
                FROM {$CFG->prefix}idp_revision_competencytmpl rct
                INNER JOIN {$CFG->prefix}comp_template ct
                ON rct.competencytemplate = ct.id
                WHERE revision={$revision->id} AND frameworkid={$frameworkid}");

            $competencytemplates = idp_get_user_competencytemplates($plan->userid, $revision->id, $frameworkid, $page, $perpage, 'fullname');
            print_idp_competency_templates_view_flex($revision, $competencytemplates, $options['can_edit'], $haspositions, $page, $perpage, $templatecount->count);
        }
    }
    else if($type == 'competencies' || $type == 'comptemplates') {
        echo get_string('noframeworks', 'competency');
    }

    if($type == 'courses'){
        $coursecount = get_record_sql("SELECT COUNT(*) FROM {$CFG->prefix}idp_revision_course WHERE revision={$revision->id}");

        $courses = idp_get_user_courses($plan->userid, $revision->id, $start, $perpage, null);
        print_idp_courses_view_flex($revision, $courses, $options['can_edit'], $page, $perpage, $coursecount->count);
    }


    // Check for empty plans
    if (empty($objhtml) && empty($listshtml)) {
    } else {
        print $listshtml;
        print $objhtml;
        //print_revision_extracomment($revision);
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
        print_idp_competencies_view($revision, $competencies, false);
    } else {
       print '<p><i>'.get_string('emptyplancompetencies', 'idp')."</i></p>\n";
    }

    $competencytemplates = idp_get_user_competencytemplates($plan->userid, $revision->id);
    if ($competencytemplates) {
        print_idp_competency_templates_view($revision, $competencytemplates, false);
    } else {
        print '<p><i>'.get_string('emptyplancompetencytemplates','idp')."</i></p>\n";
    }

    $courses = idp_get_user_courses($plan->userid, $revision->id);
    if ( $courses ) {
        print_idp_courses_view($revision, $courses, false);
    } else {
        print '<p><i>'.get_string('emptyplancourses','idp')."</i></p>\n";
    }
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
        print_comment_list($revision);
    }

    $competencies = idp_get_user_competencies($plan->userid, $revision->id);
    if ($competencies) {
        print_idp_competencies_view($revision, $competencies, false);
    } else {
       print '<p><i>'.get_string('emptyplancompetencies', 'idp')."</i></p>\n";
    }

    $competencytemplates = idp_get_user_competencytemplates($plan->userid, $revision->id);
    if ($competencytemplates) {
        print_idp_competency_templates_view($revision, $competencytemplates, $options['can_edit']);
    } else {
        print '<p><i>'.get_string('emptyplancompetencytemplates','idp')."</i></p>\n";
    }

    $courses = idp_get_user_courses($plan->userid, $revision->id);
    if ( $courses ) {
        print_idp_courses_view($revision, $courses, $options['can_edit']);
    } else {
        print '<p><i>'.get_string('emptyplancourses','idp')."</i></p>\n";
    }

    print_revision_extracomment($revision);

}

/**
 * Display a floating print button at the
 */
function print_button() { //Currently disabled
    return '';/* '<div id="page_print_button" style="float:right;">'
        . '<button onclick="document.location += \'&amp;print=1\';">'
        . get_string('printviewbutton', 'idp').'</button></div>';*/
}

/**
 * Get this users competencies for this revision.
 *
 * @param class $revision       Revision object as returned by get_revision()
 * @param array $grades         Array of grades as submitted by the grades form
 * @param string $extracomment  Optional comment added to the evaluation
 */
function idp_get_user_competencies($userid, $currevisionid, $frameworkid=null, $start=null, $size=null, $sort=null) {
    global $CFG;

    $sql = "
        SELECT DISTINCT
            c.id AS id,
            c.fullname,
            f.id AS fid,
            f.fullname AS framework,
            d.fullname AS depth,
            r.duedate as duedate,
            r.priority as priority,
            sv.name as status,
            ce.id as ceid,
            ce.proficiency,
            cs.proficient as proficientlevel
        FROM
            {$CFG->prefix}idp_revision_competency r
        INNER JOIN
            {$CFG->prefix}comp c
         ON r.competency = c.id
        INNER JOIN
            {$CFG->prefix}comp_framework f
         ON f.id = c.frameworkid
        INNER JOIN
            {$CFG->prefix}comp_depth d
         ON d.id = c.depthid
        LEFT JOIN
            {$CFG->prefix}comp_evidence ce
         ON ce.competencyid = r.competency AND ce.userid = $userid
        LEFT JOIN
            {$CFG->prefix}comp_scale_values sv
         ON sv.id = ce.proficiency
        LEFT JOIN
            {$CFG->prefix}comp_scale cs
         ON cs.id = sv.scaleid
         WHERE r.revision = {$currevisionid}
        ";

    if(isset($frameworkid)){
        $sql .= " AND f.id={$frameworkid}";
    }
    if(isset($sort)){
        $sql .= " ORDER BY {$sort}";
    }
    if(isset($start) && isset($size)){
        return get_records_sql($sql, $start, $size);
    }
    else{
        return get_records_sql($sql);
    }
}


/**
 * @param int $userid ID of user
 * @return array of the user's current positions
 *
 *
**/
function idp_get_user_positions($userid) {
    global $CFG;

    $sql = "SELECT p.id, p.fullname
            FROM {$CFG->prefix}pos_assignment pa
            JOIN {$CFG->prefix}pos p
              ON pa.positionid=p.id
            WHERE userid={$userid}";

    return get_records_sql($sql);

}


/**
 * Get this users competency templates for this revision.
 *
 * @param class $revision       Revision object as returned by get_revision()
 * @param array $grades         Array of grades as submitted by the grades form
 */
function idp_get_user_competencytemplates($userid, $currevisionid, $frameworkid=null, $start=null, $size=null, $sort=null) {
    global $CFG;

    $sql = "
        SELECT DISTINCT
            c.id AS id,
            c.fullname AS fullname,
            f.id AS fid,
            f.fullname AS framework,
            r.duedate as duedate,
            r.priority as priority
        FROM
            {$CFG->prefix}idp_revision_competencytmpl r
        INNER JOIN
            {$CFG->prefix}comp_template c
         ON r.competencytemplate = c.id
        INNER JOIN
            {$CFG->prefix}comp_framework f
         ON f.id = c.frameworkid
        WHERE r.revision = {$currevisionid}
        ";

    if (!empty($frameworkid)) {
        $sql .= " AND f.id = {$frameworkid} ";
    }
    if(isset($sort)){
        $sql .= " ORDER BY {$sort}";
    }
    if(isset($start) && isset($size)){
        return get_records_sql($sql, $start, $size);
    }
    else{
        return get_records_sql($sql);
    }
}

/**
 * Get this users courses for this revision.
 *
 * @param class $revision       Revision object as returned by get_revision()
 * @param array $grades         Array of grades as submitted by the grades form
 * @param string $extracomment  Optional comment added to the evaluation
 */

function idp_get_user_courses($userid, $currevisionid, $start=null, $size=null, $sort=null) {
    global $CFG;

    $sql = "
        SELECT DISTINCT
            c.id,
            c.fullname as fullname,
            cc.id as ccid,
            cc.name as category,
            r.duedate as duedate,
            r.priority,
            ccomp.timestarted,
            ccomp.timeenrolled,
            ccomp.timecompleted,
            ccomp.rpl
        FROM {$CFG->prefix}idp_revision_course r
        INNER JOIN {$CFG->prefix}course c
          ON c.id=r.course
        INNER JOIN {$CFG->prefix}course_categories cc
          ON c.category=cc.id
        LEFT JOIN {$CFG->prefix}course_completions ccomp
          ON c.id=ccomp.course AND ccomp.userid = {$userid}
        WHERE r.revision = {$currevisionid}
        ";

    if(isset($sort)){
        $sql .= " ORDER BY {$sort}";
    }
    if(isset($start) && isset($size)){
        return get_records_sql($sql, $start, $size);
    }
    else{
        return get_records_sql($sql);
    }
}


/**
 * Mark the given revision as "evaluated" and give a grade to each
 * revision objective.
 *
 * @param class $revision       Revision object as returned by get_revision()
 * @param array $compevals         Array of grades as submitted by the grades form
 * @param string $extracomment  Optional comment added to the evaluation
 */
function idp_submit_evaluation($revision, $compevals, $extracomment) {
    global $USER, $CFG;
    require_once($CFG->dirroot.'/hierarchy/type/competency/evidence/evidence.php');

    $record = new stdclass();
    $record->id = $revision->id;
    $record->evaluatedtime = time();
    $record->evaluationcomment = addslashes($extracomment);

    $allcompetencies = get_all_revision_competencies($revision->id);
    if ( !$allcompetencies ){
        return false;
    }
    $frameworklist = get_all_competency_frameworks($allcompetencies);

    begin_sql();
    foreach ($allcompetencies as $competency ) {
        if (!isset($compevals[$competency->id])) {
            // One of the objectives was not evaluated
            rollback_sql();
            return false;
        }

        // Verify the scale value entered is valid
        $isscalevaluecorrect = false;
        foreach( $frameworklist[$competency->frameworkid]->scale->valuelist as $scalevalue ){
            if ( $scalevalue->id == $compevals[$competency->id] ){
                $isscalevaluecorrect = true;
                break;
            }
        }
        if ( !$isscalevaluecorrect ){
            rollback_sql();
            return false;
        }

        $evalrecord = new stdclass();
        $evalrecord->revisionid = $revision->id;
        $evalrecord->competencyid = $competency->id;
        $evalrecord->scalevalueid = $compevals[$competency->id];
        $evalrecord->timecreated = time();
        $evalrecord->timemodified = time();
        $evalrecord->usermodified = $USER->id;

        if (!insert_record('idp_competency_eval', $evalrecord)) {
            rollback_sql();
            return false;
        }

        //Updating and creating competency evidence items when evaluating IDP
        $compevidence = new competency_evidence(array('userid'=>$revision->userid, 'competencyid'=>$competency->id));
        $compevidence->reaggregate = time();
        $compevidence->update_proficiency($compevals[$competency->id]);

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
 * Return a table of competencies for a particular framework, along with the
 * self-evaluation "grade" for a given competency
 * 
 * @global <type> $CFG
 * @param int $revisionid
 * @param object $framework
 * @return boolean success or failure
 */
function framework_evaluations($revisionid, $framework) {
    global $CFG;

    if ($framework->competencies and count($framework->competencies) > 0) {

        $table = new stdclass();
        $table->class = 'generaltable objectiveevaluation';
        $table->rowclass[] = 'header';
        $firstrow = array(get_string('themeorobjectivecolumn', 'idp'));
        foreach( $framework->scale->valuelist as $scalevalue ){
            $firstrow[] = $scalevalue->name;
        }
  //      $firstrow[] = '&nbsp;';
        $table->data[] = $firstrow;
        $table->tablealign = 'left';
        $table->summary = 'List of Competencies and a way to grade them';

        $userobj = get_record_sql("SELECT i.userid FROM {$CFG->prefix}idp_revision ir LEFT JOIN {$CFG->prefix}idp i ON ir.idp=i.id WHERE ir.id={$revisionid}");
        $userid = intval($userobj->userid);

        $lasttheme = '';
        foreach ($framework->competencies as $competency) {

            // Form elements
            //$idfield = '<input type="hidden" name="compid[]" value="'.$competency->id .'" />';
            $sql = "SELECT proficiency FROM {$CFG->prefix}comp_evidence WHERE competencyid = {$competency->id} AND userid = {$userid}";
            $temp = get_record_sql($sql);
            $competency->currentproficiency = intval($temp->proficiency);

            $grades = array();
            foreach( $framework->scale->valuelist as $scalevalue ){
                if($scalevalue->id == $competency->currentproficiency){
                    $gradestr = '<input type="radio" name="compeval['.$competency->id.']" value="'.$scalevalue->id.'" checked="1" ';
                }
                else {
                    $gradestr = '<input type="radio" name="compeval['.$competency->id.']" value="'.$scalevalue->id.'" ';
                }

                // TODO: apparently this is an ajax function to store the thing 
                // as soon as you click it!
                //$gradestr .= "onclick=\"grade_objective($competency->id, $i)\" ";
                $gradestr .= "/>";
                $grades[] = $gradestr;
            }

            $row = array( s($competency->fullname) );
            foreach ( $grades as $grade ){
                $row[] = $grade;
            }
            $table->data[] = $row;

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
function print_evaluation_summary($userid) {
    global $CFG;
    require_once($CFG->libdir.'/tablelib.php');

    // Get all the evaluated competencies for this user
    $sql = <<<SQL
        select
            eval.id as eval_id,
            comp.id,
            comp.fullname,
            comp.frameworkid,
            comp.sortorder as comp_sortorder,
            eval.scalevalueid,
            eval.timemodified as evaltime,
            fw.sortorder as fw_sortorder
        from
            {$CFG->prefix}comp comp,
            {$CFG->prefix}idp_competency_eval eval,
            {$CFG->prefix}idp idp,
            {$CFG->prefix}idp_revision rev,
            {$CFG->prefix}comp_framework fw
        where
            idp.userid = {$userid}
            and eval.competencyid = comp.id
            and eval.revisionid = rev.id
            and rev.idp = idp.id
            and comp.frameworkid = fw.id
        order by
            fw_sortorder,
            comp_sortorder,
            comp.id,
            eval.timemodified desc
SQL;
    $comps = get_records_sql($sql);
    
    // Get only the most recent evaluation for each competency (probably more
    // efficient to do this here in PHP rather than on the DB side, but it
    // depends on the DB particulars)
    //
    // Note this code depends heavily on the ORDER BY clause of the preceeding SQL
    $uniquecomps = array();
    foreach( $comps as $comp ){
        if( !array_key_exists( $comp->id, $uniquecomps ) ){
            $uniquecomps[$comp->id] = $comp;
        }
    }

    $frameworks = get_all_competency_frameworks($uniquecomps);

    foreach( $frameworks as $framework ){
        print "<h2>{$framework->fullname}</h2>\n";
        $tableid = "idp-eval-summary-user{$userid}-framework{$framework->id}";
        $table = new flexible_table($tableid);

        $compcollabel = "{$tableid}-competencyname";
        $columnids = array($compcollabel);
        $columnlabels = array(get_string('competency','competency'));

        $scalevalues = $framework->scale->valuelist;
        $scalecollabel = "{$tableid}-value";
        foreach( $scalevalues as $scalevalue ){
            $columnids[] = $scalecollabel . $scalevalue->id;
            $columnlabels[] = $scalevalue->name;
        }

        $evalcollabel = "{$tableid}-evaldate";
        $columnids[] = $evalcollabel;
        $columnlabels[] = get_string('lastevaluatedcolumn','idp');

        $table->define_columns($columnids);
        $table->define_headers($columnlabels);
        $table->set_attribute('class','generaltable objectiveevaluation');
//        $table->rowclass[] = 'header';
        $table->collapsible(false);
        $table->sortable(false);
        $table->pageable(false);
        $table->initialbars(true);
        $table->setup();

        foreach( $framework->competencies as $competency ){
            $row = array();
            $row[$compcollabel] = $competency->fullname;
            $row[$scalecollabel . $competency->scalevalueid] =
                    '<img src="'
                    . $CFG->wwwroot
                    . '/theme/totara/pix/t/clear.gif" alt="'
                    . htmlspecialchars($scalevalues[$competency->scalevalueid]->name)
                    . '" />';
            $row[$evalcollabel] = userdate($competency->evaltime, '%e %b %y');
            $table->add_data_keyed($row);
        }
        $table->print_html();
        print "<br />\n";
    }
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
 * Return the fullname of the user linking to his profile page.
 *
 * @param $userid     User ID of the user to display
 * @param $youstring  String to be used when userid is the logged in user
 *                    (set to false to use the fullname)
 */
function format_user_link($userid, $youstring='Yourself') {
    global $CFG, $USER;

    if ($userid == $USER->id and $youstring !== false) {
        return $youstring;
    }

    $user = get_record('user', 'id', $userid);
    $link = $CFG->wwwroot."/user/view.php?id=$userid";

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
    if (preg_match('|(\d{1,2})/(\d{1,2})/(\d{4})|', $datestring, $matches)) {
        return mktime(0,0,0,$matches[2], $matches[1], $matches[3]);
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

/**
 * Return a clickable arrow which hides/shows the corresponding div.
 * Can optionally include a caption which will also be clickable.
 *
 * @param $id         ID of the clickable caption
 * @param $divid      ID of the div which will be hidden/displayed when collapsing/expanding
 * @param $caption    If a caption isn't provided, only the clickable arrow will be displayed
 * @param $spacing    Extra space (in pixels) to add before the arrow
 * @param $extracell  Extra cell to append at the end of the row
 * @param $initialexpanded  False if the node should be collapsed by default
 * @param $groupmutexid     Optionally specify a group which this node will
 *                          belong to.  This allows only one node of each group
 *                          to be open at a time.  Make sure to 'print collapse_groups_script()'
 *                          at the end of your page.
 */
function collapsing_tree_node($id, $divid, $caption='', $spacing=0, $extracell='',
                              $initialexpanded=false, $groupmutexid='') {
    global $CFG;
    global $collapsing_tree_node_groups;

    require_js($CFG->wwwroot.'/idp/collapsing_tree_node.js');

    $defaultimage = '/t/switch_plus.gif';
    if ($initialexpanded) {
        $defaultimage = '/t/switch_minus.gif';
    }
    $image = "<img id=\"arrow_{$divid}\" src=\"{$CFG->pixpath}{$defaultimage}\" alt=\"expand/collapse\" />";
    $arrowlink = "<a style=\"cursor: pointer\" onclick=\"toggle_div('{$divid}', '{$groupmutexid}');\">{$image}</a>";
    if ($spacing > 0) {
        $spacercell = '<td>'.print_spacer(1, $spacing, false, true).'</td>';
    } else {
        $spacercell = '';
    }

    if (!empty($extracell)) {
        $extracell = "<td class=\"extracell\">{$extracell}</td>";
    }

    if (!empty($groupmutexid)) {
        $collapsing_tree_node_groups[$groupmutexid][] = $divid;
    }

    if (empty($caption)) {
        return $arrowlink;
    } else {
        $captionlink = "<a style=\"cursor: pointer\" id=\"{$id}\" onclick=\"toggle_div('{$divid}', '{$groupmutexid}');\">{$caption}</a>";
        return "<table summary=\"\"><tr>{$spacercell}<td>{$arrowlink}</td>".
            "<td valign=\"middle\">{$captionlink}</td>{$extracell}</tr></table>".
            "<script type=\"text/javascript\">var config = {'pixpath': '{$CFG->pixpath}'};</script>";
    }
}


/**
 * Get a list of all the distinct competencies for this revision. This includes
 * competencies that are in competency templates.
 *
 * @global object $CFG
 * @param int $revisionid
 * @return array
 */
function get_all_revision_competencies($revisionid){
    global $CFG;

    $sql = <<<SQL
    select comp.*
    from
        {$CFG->prefix}comp comp,
        {$CFG->prefix}comp_framework fwork
    where
        comp.id in (
            select distinct revcomp.competency
            from {$CFG->prefix}idp_revision_competency revcomp
            where revcomp.revision = {$revisionid}
        union
            select distinct complist.instanceid
            from
                {$CFG->prefix}idp_revision_competencytmpl revtemp,
                {$CFG->prefix}comp_template_assignment complist
            where
                revtemp.revision = {$revisionid}
                and revtemp.competencytemplate = complist.templateid
        )
        and comp.frameworkid = fwork.id
    order by
        fwork.sortorder,
        comp.sortorder
SQL;
    return get_records_sql($sql);
}

/**
 * Given a list of competencies such as that returned by get_all_revision_competencies,
 * return details (including competency scales) for all the frameworks shared
 * by those competencies.
 * 
 * @param <type> $fullcompetencylist
 * @return array
 */
function get_all_competency_frameworks($fullcompetencylist){
    $frameworktocompetencyhash = array();

    // Create an array with one entry for each framework. The key will be
    // the framework id, and the value will be an array of all the competencies
    // under that framework
    foreach( $fullcompetencylist as $competency ){
        $frameworktocompetencyhash[$competency->frameworkid][] = $competency;
    }

    $frameworklist = array();
    $hierarchy = new competency();
    foreach( $frameworktocompetencyhash as $frameworkid => $competencylist ){
        $framework = get_record('comp_framework', 'id', $frameworkid);

        $hierarchy->frameworkid = $frameworkid;
        $scale = $hierarchy->get_competency_scale();
        $framework->scale = $scale;
        $framework->competencies = $competencylist;

        $frameworklist[$frameworkid] = $framework;
    }
    return $frameworklist;
}

/**
 * Print a revision that has been completed (i.e. its evaluation was submitted)
 * You won't be able to edit it, and you'll just see its competencies and their
 * evaluations, rather than competency templates.
 * 
 * @global object $USER
 * @global object $CFG
 * @param object $revision
 * @param object $plan
 */
function print_revision_completed($revision, $plan) {
    global $USER, $CFG;

    // Personal details
    print  '<h2>'.get_string('personaldetailsheading', 'idp').'</h2>';
    if (empty($revision->owner)) {
        $revision->owner = $USER;
    }

    print_revision_details($revision, false, false, false, false);
    print_revision_list($plan->id, $revision->id);
    print_comment_list($revision);
    print_comment_textbox($revision->id);

    print_heading(get_string('competencies', 'competency'));
    $table = new stdClass();
    $table->head = array('Framework', 'Competency', 'Evaluation');
    $table->class = 'generalbox planitems boxaligncenter viewcoures';
    $table->summary = 'Each competency in this plan, and its evaluation.';
    $table->data = array();

    $frameworks = get_all_competency_frameworks(get_all_revision_competencies($revision->id));
    foreach( $frameworks as $framework ){
        foreach( $framework->competencies as $competency ){
            $eval = get_competency_evaluation( $revision->id, $competency->id );
            $table->data[] = array($framework->fullname, $competency->fullname, $eval->name);
        }
    }

    print_table($table, false);

    $courses = idp_get_user_courses($plan->userid, $revision->id);
    print_idp_courses_view($revision, $courses, false);

    print_revision_extracomment($revision);
}

/**
 * Get the competency scale value for the evaluation of the given competency
 * in the given IDP revision
 *
 * @param int $revisionid
 * @param int $competencyid
 * @return string
 */
function get_competency_evaluation($revisionid, $competencyid){
    global $CFG;
    $sql = <<<SQL
        select value.*
        from
            {$CFG->prefix}comp_scale_values value,
            {$CFG->prefix}idp_competency_eval compeval
        where
            compeval.scalevalueid = value.id
            and compeval.revisionid = {$revisionid}
            and compeval.competencyid = {$competencyid}
SQL;
    $eval = get_record_sql($sql);
    if ( !$eval ){
        $eval = '';
    }
    return $eval;
}

function idp_get_assigned_to_comptemplate($id, $userid) {
    global $CFG;

    $sql = "SELECT DISTINCT
            c.id AS id,
            d.fullname AS depth,
            c.fullname AS competency,
            sv.name as status
        FROM
            {$CFG->prefix}comp_template_assignment a
        LEFT JOIN
            {$CFG->prefix}comp_template t
         ON t.id = a.templateid
        LEFT JOIN
            {$CFG->prefix}comp c
         ON a.instanceid = c.id
        LEFT JOIN
            {$CFG->prefix}comp_depth d
         ON c.depthid = d.id
        LEFT JOIN
            {$CFG->prefix}comp_evidence ce
            ON ce.competencyid = c.id
            AND ce.userid = {$userid}
        LEFT JOIN
            {$CFG->prefix}comp_scale_values sv
         ON sv.id = ce.proficiency
        WHERE
            t.id = {$id}
            ";
    echo "<br>";
    return get_records_sql($sql);
}


function get_priorities() {
    return get_records('idp_tmpl_priority_scale', '', '', 'name');
}

function idp_get_priority_scale_values_menu($idpid=0) {
    global $CFG;

    $sql = "SELECT val.id, val.name FROM {$CFG->prefix}idp_tmpl_priority_scal_val val
            JOIN {$CFG->prefix}idp_tmpl_priority_scale ps ON val.priorityscaleid=ps.id
            JOIN {$CFG->prefix}idp_tmpl_priority_assign pa ON ps.id=pa.priorityscaleid
            JOIN {$CFG->prefix}idp_template temp ON pa.templateid=temp.id
            JOIN {$CFG->prefix}idp i ON temp.id=i.templateid ";
    if (!empty($idpid)) {
        $sql .= " WHERE i.id={$idpid} ORDER BY val.sortorder ASC";
    }

    $priorities = get_records_sql($sql);

    return is_array($priorities) ? $priorities : array();
}

function idp_get_default_scale_value($idpid) {
    global $CFG;
    $sql = "SELECT val.* FROM {$CFG->prefix}idp_tmpl_priority_scal_val val
            JOIN {$CFG->prefix}idp_tmpl_priority_scale ps ON val.id=ps.defaultid
            JOIN {$CFG->prefix}idp_tmpl_priority_assign pa ON ps.id=pa.priorityscaleid
            JOIN {$CFG->prefix}idp_template temp ON pa.templateid=temp.id
            JOIN {$CFG->prefix}idp i ON temp.id=i.templateid
            WHERE i.id = {$idpid}";

     return get_record_sql($sql);
}

function get_competency_areas() {
    return get_records('idp_comp_area', '', '', 'sortorder');
}

?>
