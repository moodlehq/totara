<div id="header-search">
<form id="coursesearch" action="<?php echo $CFG->wwwroot ?>/course/search.php" method="get">
  <fieldset class="coursesearchbox invisiblefieldset">
    <input type="text" id="coursesearchbox" size="30" name="search" value="" />
    <input id="coursesubmit" type="submit" value="Go" />
  </fieldset>
</form>
</div>


<ul>
     
        <li id="menu1" class="first"><div><a href="<?php echo $CFG->wwwroot.'/index.php' ?>">Home</a>
					
        <ul>
        <?php

 $text ='<li class="first"><a href="'.$CFG->wwwroot . '/user/view.php?id=' . $USER->id . '">' . get_string('myprofile', 'local') . '</a></li>';
 
 echo $text;
?>

           </ul></div>
 
        <li id="menu2"><div><a href="<?php echo $CFG->wwwroot.'/my/' ?>"><?php echo get_string('mylearning', 'local') ?></a>
					
        <ul>
        <?php

 $text ='<li><a href="'.$CFG->wwwroot.'/idp/index.php">'.get_string('mydevelopmentplans', 'local').'</a></li>';
 $text .='<li><a href="'.$CFG->wwwroot.'/my/bookings.php">'.get_string('mybookings', 'local').'</a></li>';
 $text .='<li class="last"><a href="'.$CFG->wwwroot.'/my/records.php">'.get_string('myrecordoflearning', 'local').'</a></li>';
 
 echo $text;
?>

           </ul></div>
           
        <li id="menu3"><div><a href="<?php echo $CFG->wwwroot.'/my/team.php' ?>"><?php echo get_string('myteam', 'local') ?></a>
					
        <ul>
        <?php

 $text ='<li class="first"><a href="">Item One</a></li>';
 $text .='<li><a href="">Item Two</a></li>';
 $text .='<li><a href="">Item Three</a></li>';
 $text .='<li><a href="">Item Four</a></li>';
 $text .='<li class="last"><a href="">Item Five</a></li>';
 
?>
	

           </ul></div>
        
        <li id="menu4"><div><a href="<?php echo $CFG->wwwroot.'/my/reports.php' ?>"><?php echo get_string('myreports', 'local') ?></a>
					
        <ul>
        <?php

 $text ='<li class="first"><a href="">Item One</a></li>';
 $text .='<li><a href="">Item Two</a></li>';
 $text .='<li><a href="">Item Three</a></li>';
 $text .='<li><a href="">Item Four</a></li>';
 $text .='<li class="last"><a href="">Item Five</a></li>';
 
// echo $text;
?>
           </ul></div>
           
        <li id="menu5"><div><a href="<?php echo $CFG->wwwroot.'/course/index.php' ?>"><?php echo get_string('findcourses', 'local') ?></a>
					
        <ul>
        <?php

 $text ='<li class="first"><a href="/course/index.php">'.get_string('browsecategories', 'local').'</a></li>';
 $text .='<li><a href="">'.get_string('searchcourses', 'local').'</a></li>';
 
 echo $text;
?> 			

           </ul></div>
           
        <li id="menu6" class="last"><div><a href="<?php echo $CFG->wwwroot.'/blocks/facetoface/calendar.php' ?>">Calendar</a>
					
        <ul>
        <?php

 $text ='<li class="first"><a href="">Item One</a></li>';
 $text .='<li><a href="">Item Two</a></li>';
 $text .='<li><a href="">Item Three</a></li>';
 $text .='<li><a href="">Item Four</a></li>';
 $text .='<li class="last"><a href="">Item Five</a></li>';
 
// echo $text;
?> 			

           </ul></div>
