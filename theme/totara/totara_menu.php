<div id="header-search">
<form id="coursesearch" action="<?php echo $CFG->wwwroot ?>/course/search.php" method="get">
  <fieldset class="coursesearchbox invisiblefieldset">
    <input type="text" id="coursesearchbox" size="30" name="search" value="" />
    <input id="coursesubmit" type="submit" value="Go" />
  </fieldset>
</form>
</div>

<ul>
    <li id="menu1" class="first">
        <div><a href="<?php echo $CFG->wwwroot.'/index.php' ?>">Home</a>
	        <ul>
                <?php
                $text ='<li class="first"><a href="'.$CFG->wwwroot . '/user/view.php?id=' . $USER->id . '">' . get_string('myprofile', 'local') . '</a></li>';
                echo $text;
                ?>
            </ul>
        </div>
    </li>


    <li id="menu2">
        <div><a href="<?php echo $CFG->wwwroot.'/idp/index.php' ?>"><?php echo get_string('mylearning', 'local') ?></a>
            <ul>
            <?php
                 $text ='<li><a href="'.$CFG->wwwroot.'/idp/dashboard.php">'.get_string('dashboard', 'local_dashboard').'</a></li>';
                 $text .='<li><a href="'.$CFG->wwwroot.'/idp/index.php">'.get_string('mydevelopmentplans', 'local').'</a></li>';
                 $text .='<li><a href="'.$CFG->wwwroot.'/my/bookings.php">'.get_string('mybookings', 'local').'</a></li>';
                 $text .='<li class="last"><a href="'.$CFG->wwwroot.'/my/records.php">'.get_string('myrecordoflearning', 'local').'</a></li>';
                 echo $text;
            ?>
            </ul>
        </div>
    </li>


    <?php if($staff = totara_get_staff()) { ?>
    <li id="menu3">
        <div>
            <a href="<?php echo $CFG->wwwroot.'/my/team.php' ?>"><?php echo get_string('myteam', 'local') ?></a>
			<ul>
	        </ul>
        </div>
    </li>
    <?php } ?>


    <li id="menu4">
        <?php if($staff) {
            echo '<div>';
        }
        else {
            echo '<div class=noteam>';
        } ?>
            <a href="<?php echo $CFG->wwwroot.'/my/reports.php' ?>"><?php echo get_string('myreports', 'local') ?></a>
            <ul>
            </ul>
        </div>
    </li>


    <li id="menu5">
        <?php if($staff) {
            echo '<div>';
        }
        else {
            echo '<div class=noteam>';
        } ?>
        <a href="<?php echo $CFG->wwwroot.'/course/find.php' ?>"><?php echo get_string('findcourses', 'local') ?></a>
		    <ul>
            <?php
                 $text ='<li class="first"><a href="'.$CFG->wwwroot.'/course/find.php">'.get_string('searchcourses', 'local').'</a></li>';
                 $text .='<li class="last"><a href="'.$CFG->wwwroot.'/course/index.php">'.get_string('browsecategories', 'local').'</a></li>';
                 echo $text;
            ?>
           </ul>
        </div>
    </li>


    <li id="menu6" class="last">
        <?php if($staff) {
            echo '<div>';
        }
        else {
            echo '<div class=noteam>';
        } ?>
            <a href="<?php echo $CFG->wwwroot.'/blocks/facetoface/calendar.php' ?>">Calendar</a>
            <ul>
            </ul>
        </div>
    </li>
</ul>
