<?php  // $Id$

    require_once("../../config.php");
    require_once($CFG->dirroot.'/mod/scorm/locallib.php');
    
    $id = optional_param('id', '', PARAM_INT);       // Course Module ID, or
    $a = optional_param('a', '', PARAM_INT);         // scorm ID
    $organization = optional_param('organization', '', PARAM_INT); // organization ID

    if (!empty($id)) {
        if (! $cm = get_coursemodule_from_id('scorm', $id)) {
            error("Course Module ID was incorrect");
        }
        if (! $course = get_record("course", "id", $cm->course)) {
            error("Course is misconfigured");
        }
        if (! $scorm = get_record("scorm", "id", $cm->instance)) {
            error("Course module is incorrect");
        }
    } else if (!empty($a)) {
        if (! $scorm = get_record("scorm", "id", $a)) {
            error("Course module is incorrect");
        }
        if (! $course = get_record("course", "id", $scorm->course)) {
            error("Course is misconfigured");
        }
        if (! $cm = get_coursemodule_from_instance("scorm", $scorm->id, $course->id)) {
            error("Course Module ID was incorrect");
        }
    } else {
        error('A required parameter is missing');
    }

    require_login($course->id, false, $cm);

    $context = get_context_instance(CONTEXT_COURSE, $course->id);
    $contextmodule = get_context_instance(CONTEXT_MODULE,$cm->id);

    if (isset($SESSION->scorm_scoid)) {
        unset($SESSION->scorm_scoid);
    }

    $strscorms = get_string("modulenameplural", "scorm");
    $strscorm  = get_string("modulename", "scorm");

    $pagetitle = strip_tags($course->shortname.': '.format_string($scorm->name));

    add_to_log($course->id, 'scorm', 'pre-view', 'view.php?id='.$cm->id, "$scorm->id", $cm->id);

    // if this is a direct launch, skip straight to the player
    if (!empty($scorm->directview) && optional_param('directview', '', PARAM_INT)) {
        $scoes = array();
        if ($scoid =  optional_param('scoid', 0, PARAM_INT)) {
            $scoes = get_records_select('scorm_scoes','scorm='.$scorm->id.' AND id='.$scoid, 'id', 'id');
        }
        if (empty($scoes)) {
            $scoes = get_records_select('scorm_scoes','scorm='.$scorm->id.' AND launch<>\''.sql_empty().'\'', 'id', 'id');
        }
        $sco = current($scoes);
        $scoid = $sco->id;

        $mode = optional_param('mode', 'normal', PARAM_ALPHA); // navigation mode
        $currentorg = optional_param('currentorg', '', PARAM_RAW); // selected organization
        $newattempt = optional_param('newattempt', 'off', PARAM_ALPHA); // the user request to start a new attempt

        //
        // TOC processing
        //
        $scorm->version = strtolower(clean_param($scorm->version, PARAM_SAFEDIR));   // Just to be safe
        if (!file_exists($CFG->dirroot.'/mod/scorm/datamodels/'.$scorm->version.'lib.php')) {
            $scorm->version = 'scorm_12';
        }
        require_once($CFG->dirroot.'/mod/scorm/datamodels/'.$scorm->version.'lib.php');
        $attempt = scorm_get_last_attempt($scorm->id, $USER->id);
        if (($newattempt=='on') && (($attempt < $scorm->maxattempt) || ($scorm->maxattempt == 0))) {
            $attempt++;
            $mode = 'normal';
        }
        $attemptstr = '&amp;attempt=' . $attempt;

        $result = scorm_get_toc($USER,$scorm,'structurelist',$currentorg,$scoid,$mode,$attempt,true);
        $sco = $result->sco;

        if (($mode == 'browse') && ($scorm->hidebrowse == 1)) {
           $mode = 'normal';
        }
        if ($mode != 'browse') {
            if ($trackdata = scorm_get_tracks($sco->id,$USER->id,$attempt)) {
                if (($trackdata->status == 'completed') || ($trackdata->status == 'passed') || ($trackdata->status == 'failed')) {
                    $mode = 'review';
                } else {
                    $mode = 'normal';
                }
            } else {
                $mode = 'normal';
            }
        }

        add_to_log($course->id, 'scorm', 'view', "player.php?id=$cm->id&scoid=$sco->id", "$scorm->id", $cm->id);

        /// Mark as viewed
        $completion = new completion_info($course);
        $completion->set_module_viewed($cm);

        $scoidstr = '&amp;scoid='.$sco->id;
        $scoidpop = '&scoid='.$sco->id;
        $modestr = '&amp;mode='.$mode;
        if ($mode == 'browse') {
            $modepop = '&mode='.$mode;
        } else {
            $modepop = '';
        }
        $orgstr = '&currentorg='.$currentorg;

        $SESSION->scorm_scoid = $sco->id;
        $SESSION->scorm_status = 'Not Initialized';
        $SESSION->scorm_mode = $mode;
        $SESSION->scorm_attempt = $attempt;

    //
    // Print the page header
    //
     ?>
    <html>
        <head>
            <title><?php echo $pagetitle;?></title>
        </head>
     <body id="mod-scorm-view">
    <div id="wrapper" style="height: 100%;  width: 100%;">
    <div id="container" style="height: 100%;  width: 100%;">
    <div id="content" class=" clearfix" style="height: 100%;  width: 100%;">
        <script type="text/javascript" src="request.js"></script>
        <script type="text/javascript" src="api.php?id=<?php echo $cm->id.$scoidstr.$modestr.$attemptstr ?>"></script>
        <script type="text/javascript" src="<?php echo $CFG->wwwroot; ?>/mod/scorm/rd.js"></script>
        <script type="text/javascript">
        <!--
            scorm_resize(<?php echo $scorm->width.", ".$scorm->height; ?>);
            window.onresize = function() {
                scorm_resize(<?php echo $scorm->width.", ".$scorm->height; ?>);
            };
        -->
        </script>
    <?php
        //}
        if (($sco->previd != 0) && ((!isset($sco->previous)) || ($sco->previous == 0))) {
            $scostr = '&scoid='.$sco->previd;
            echo '    <script type="text/javascript">'."\n//<![CDATA[\n".'var prev="'.$CFG->wwwroot.'/mod/scorm/player.php?id='.$cm->id.$orgstr.$modepop.$scostr."\";\n//]]>\n</script>\n";
        } else {
            echo '    <script type="text/javascript">'."\n//<![CDATA[\n".'var prev="'.$CFG->wwwroot.'/mod/scorm/view.php?id='.$cm->id."\";\n//]]>\n</script>\n";
        }
        if (($sco->nextid != 0) && ((!isset($sco->next)) || ($sco->next == 0))) {
            $scostr = '&scoid='.$sco->nextid;
            echo '    <script type="text/javascript">'."\n//<![CDATA[\n".'var next="'.$CFG->wwwroot.'/mod/scorm/player.php?id='.$cm->id.$orgstr.$modepop.$scostr."\";\n//]]>\n</script>\n";
        } else {
            echo '    <script type="text/javascript">'."\n//<![CDATA[\n".'var next="'.$CFG->wwwroot.'/mod/scorm/view.php?id='.$cm->id."\";\n//]]>\n</script>\n";
        }
    ?>
        <div id="scormpage" style="height: 100%; width: 100%;">
    <?php
        if ($scorm->hidetoc == 0) {
            $class = ' class="toc"';
        } else {
            $class = ' class="no-toc"';
        }
        $style = array();
        // no TOC or TOC above
        if(($scorm->hidetoc == 2) || ($scorm->hidetoc == 1)) {
            $style[]= "width: 100%";
        }
        else {
            // add in the TOC, and float to right - must be 1% less because of IE
            $style[]= "width: 84%";
            $style[]= "float: right";
        }
        if($scorm->height == '100') {
            $style[]= "height: 100%";
        }
    ?>
            <div id="scormbox"<?php echo $class; if(!empty($style)){echo 'style="'.implode('; ', $style).'"';}?>>
    <?php
        // This very big test check if is necessary the "scormtop" div
        if (
               ($mode != 'normal') ||  // We are not in normal mode so review or browse text will displayed
               (
                   ($scorm->hidenav == 0) &&  // Teacher want to display navigation links
                   ($scorm->hidetoc != 0) &&  // The buttons has not been displayed
                   (
                       (
                           ($sco->previd != 0) &&  // This is not the first learning object of the package
                           ((!isset($sco->previous)) || ($sco->previous == 0))   // Moodle must manage the previous link
                       ) ||
                       (
                           ($sco->nextid != 0) &&  // This is not the last learning object of the package
                           ((!isset($sco->next)) || ($sco->next == 0))       // Moodle must manage the next link
                       )
                   )
               ) || ($scorm->hidetoc == 2)      // Teacher want to display toc in a small dropdown menu
           ) {
    ?>
                <div id="scormtop">
            <?php echo $mode == 'browse' ? '<div id="scormmode" class="scorm-left">'.get_string('browsemode','scorm')."</div>\n" : ''; ?>
            <?php echo $mode == 'review' ? '<div id="scormmode" class="scorm-left">'.get_string('reviewmode','scorm')."</div>\n" : ''; ?>
    <?php
           if (($scorm->hidenav == 0) || ($scorm->hidetoc == 2) || ($scorm->hidetoc == 1)) {
    ?>
                    <div id="scormnav" class="scorm-right">
            <?php
                $orgstr = '&amp;currentorg='.$currentorg;
                if (($scorm->hidenav == 0) && ($sco->previd != 0) && (!isset($sco->previous) || $sco->previous == 0) && (($scorm->hidetoc == 2) || ($scorm->hidetoc == 1)) ) {

                    // Print the prev LO button
                    $scostr = '&amp;scoid='.$sco->previd;
                    $url = $CFG->wwwroot.'/mod/scorm/'.($scorm->directview ? 'view.php?directview=1&' : 'player.php?').'id='.$cm->id.$orgstr.$modestr.$scostr;
    ?>
                        <form name="scormnavprev" method="post" action="player.php?id=<?php echo $cm->id ?>" target="_top" style= "display:inline">
                            <input name="prev" type="button" value="<?php print_string('prev','scorm') ?>" onClick="document.location.href=' <?php echo $url; ?> '"/>
                        </form>
    <?php
                }
                if ($scorm->hidetoc == 2) {
                    echo $result->tocmenu;
                }
                if (($scorm->hidenav == 0) && ($sco->nextid != 0) && (!isset($sco->next) || $sco->next == 0) && (($scorm->hidetoc == 2) || ($scorm->hidetoc == 1))) {
                    // Print the next LO button
                    $scostr = '&amp;scoid='.$sco->nextid;
                    $url = $CFG->wwwroot.'/mod/scorm/'.($scorm->directview ? 'view.php?directview=1&' : 'player.php?').'id='.$cm->id.$orgstr.$modestr.$scostr;
    ?>
                        <form name="scormnavnext" method="post" action="player.php?id=<?php echo $cm->id ?>" target="_top" style= "display:inline">
                            <input name="next" type="button" value="<?php print_string('next','scorm') ?>" onClick="document.location.href=' <?php echo $url; ?> '"/>
                        </form>
    <?php
                }
            ?>
                    </div>
    <?php
            }
    ?>
                </div> <!-- Scormtop -->
    <?php
        } // The end of the very big test
    ?>
                <div id="scormobject" class="scorm-right" style="height: 100%; width: 100%;">
                    <noscript>
                        <div id="noscript">
                            <?php print_string('noscriptnoscorm','scorm'); // No Martin(i), No Party ;-) ?>
                        </div>
                    </noscript>
    <?php
        if ($result->prerequisites) {
            if ($scorm->popup == 0) {
                echo "                <script type=\"text/javascript\">scorm_resize(".$scorm->width.", ".$scorm->height.");</script>\n";
                $fullurl="loadSCO.php?id=".$cm->id.$scoidstr.$modestr;
                echo "                <iframe id=\"scoframe1\" class=\"scoframe\" style=\"height: 100%; width: 100%;\" height=\"100%\" width=\"100%\" name=\"scoframe1\" src=\"{$fullurl}\"></iframe>\n";
            } else {
                // Clean the name for the window as IE is fussy
                $name = ereg_replace("[^A-Za-z0-9]", "", $scorm->name);
                if (!$name) {
                    $name = 'DefaultPlayerWindow';
                }
                $name = 'scorm_'.$name;
                ?>
                        <script type="text/javascript">
                        //<![CDATA[
                            scorm_resize(<?php echo $scorm->width.", ". $scorm->height; ?>);
                            function openpopup(url,name,options,width,height) {
                                fullurl = "<?php echo $CFG->wwwroot.'/mod/scorm/' ?>" + url;
                                windowobj = window.open(fullurl,name,options);
                                if ((width==100) && (height==100)) {
                                    // Fullscreen
                                    windowobj.moveTo(0,0);
                                }
                                if (width<=100) {
                                    width = Math.round(screen.availWidth * width / 100);
                                }
                                if (height<=100) {
                                    height = Math.round(screen.availHeight * height / 100);
                                }
                                windowobj.resizeTo(width,height);
                                windowobj.focus();
                                return windowobj;
                            }

                            url = "loadSCO.php?id=<?php echo $cm->id.$scoidpop ?>";
                            width = <?php p($scorm->width) ?>;
                            height = <?php p($scorm->height) ?>;
                            var main = openpopup(url, "<?php p($name) ?>", "<?php p($scorm->options) ?>", width, height);
                        //]]>
                        </script>
                        <noscript>
                        <iframe id="main" class="scoframe" style="height: 100%; width: 100%;" src="loadSCO.php?id=<?php echo $cm->id.$scoidstr.$modestr ?>">
                        </iframe>
                        </noscript>
    <?php
                //Added incase javascript popups are blocked
                print_simple_box(get_string('popupblockmessage','scorm'),'center','','',5,'generalbox','altpopuplink');
                $linkcourse = '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$scorm->course.'">' . get_string('finishscormlinkname','scorm') . '</a>';
                print_simple_box(get_string('finishscorm','scorm',$linkcourse),'center','','',5,'generalbox','altfinishlink');
            }
        } else {
            print_simple_box(get_string('noprerequisites','scorm'),'center');
        }
    ?>
                </div> <!-- SCORM object -->
            </div> <!-- SCORM box  -->
    <?php
        if ($scorm->hidetoc == 0) {
    ?>
            <div id="tocbox" style="width: 15%; float: left;">
    <?php
            if ($scorm->hidenav == 0){
    ?>
                <!-- Bottons nav at left-->
                <div id="tochead">
                    <form name="tochead" method="post" action="player.php?id=<?php echo $cm->id ?>" target="_top">
    <?php
                $orgstr = '&amp;currentorg='.$currentorg;
                if (($scorm->hidenav == 0) && ($sco->previd != 0) && (!isset($sco->previous) || $sco->previous == 0)) {
                    // Print the prev LO button
                    $scostr = '&amp;scoid='.$sco->previd;
                    $url = $CFG->wwwroot.'/mod/scorm/'.($scorm->directview ? 'view.php?directview=1&' : 'player.php?').'id='.$cm->id.$orgstr.$modestr.$scostr;
    ?>
                        <input name="prev" type="button" value="<?php print_string('prev','scorm') ?>" onClick="document.location.href=' <?php echo $url; ?> '"/>
    <?php
                }
                if (($scorm->hidenav == 0) && ($sco->nextid != 0) && (!isset($sco->next) || $sco->next == 0)) {
                    // Print the next LO button
                    $scostr = '&amp;scoid='.$sco->nextid;
                    $url = $CFG->wwwroot.'/mod/scorm/'.($scorm->directview ? 'view.php?directview=1&' : 'player.php?').'id='.$cm->id.$orgstr.$modestr.$scostr;
    ?>
                        <input name="next" type="button" value="<?php print_string('next','scorm') ?>" onClick="document.location.href=' <?php echo $url; ?> '"/>
    <?php
                }
    ?>
                    </form>
                </div> <!-- tochead -->
    <?php
            }
    ?>
                <div id="toctree" class="generalbox">
                <?php echo $result->toc; ?>
                </div> <!-- toctree -->
            </div> <!--  tocbox -->
    <?php
        }
        ?>

            <div style="clear: both;"/> <!--  force the TOC and box up -->
        </div> <!-- SCORM page -->
    </div>
  </div>
</div>
</body>
</html>
    <?php
        die();
    }

    // Skipview or direct play
    if ((has_capability('mod/scorm:skipview', $contextmodule)) && scorm_simple_play($scorm,$USER, $contextmodule)) {
        exit;
    }

    //
    // Print the page header
    //
    $navlinks = array();
    $navigation = build_navigation($navlinks,$cm);
    
    print_header($pagetitle, $course->fullname, $navigation,
                 '', '', true, update_module_button($cm->id, $course->id, $strscorm), navmenu($course, $cm));

    if (has_capability('mod/scorm:viewreport', $context)) {
        
        $trackedusers = scorm_get_count_users($scorm->id, $cm->groupingid);
        if ($trackedusers > 0) {
            echo "<div class=\"reportlink\"><a $CFG->frametarget href=\"report.php?id=$cm->id\"> ".get_string('viewalluserreports','scorm',$trackedusers).'</a></div>';
        } else {
            echo '<div class="reportlink">'.get_string('noreports','scorm').'</div>';
        }
    }

    // Print the main part of the page
    print_heading(format_string($scorm->name));
    print_box(format_text($scorm->summary), 'generalbox', 'intro');
    scorm_view_display($USER, $scorm, 'view.php?id='.$cm->id, $cm);
    print_footer($course);
?>
