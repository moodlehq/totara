<div id="header-search">
<form id="coursesearch" action="/course/search.php" method="get">
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

 $text ='<li class="first"><a href="'.$CFG->wwwroot.'">Help</a></li>';
 $text .='<li><a href="'.$CFG->wwwroot.'/mod/forum/view.php">News</a></li>';
// $text .='<li><a href="">New courses</a></li>';
 $text .='<li><a href="'.$CFG->wwwroot.'/mod/forum/index.php">Forums</a></li>';
 
 echo $text;
?>

           </ul></div>
 
        <li id="menu2"><div><a href="<?php echo $CFG->wwwroot.'/my/' ?>">My learning</a>
					
        <ul>
        <?php

 $text ='<li class="first"><a href="'.$CFG->wwwroot.'/my/">My learning summary</a></li>';
 $text .='<li><a href="'.$CFG->wwwroot.'/idp/index.php">My development plan</a></li>';
 $text .='<li><a href="'.$CFG->wwwroot.'/my/bookings.php">My bookings</a></li>';
 $text .='<li class="last"><a href="'.$CFG->wwwroot.'/my/records.php">My learning record</a></li>';
 
 echo $text;
?>

           </ul></div>
           
        <li id="menu3"><div><a href="<?php echo $CFG->wwwroot.'/my/team.php' ?>">My team</a>
					
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
        
        <li id="menu4"><div><a href="<?php echo $CFG->wwwroot.'/my/reports.php' ?>">My reports</a>
					
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
           
        <li id="menu5"><div><a href="<?php echo $CFG->wwwroot.'/course/index.php' ?>">Courses</a>
					
        <ul>
        <?php

 $text ='<li class="first"><a href="">Item One</a></li>';
 $text .='<li><a href="">Item Two</a></li>';
 $text .='<li><a href="">Item Three</a></li>';
 $text .='<li><a href="">Item Four</a></li>';
 $text .='<li class="last"><a href="">Item Five</a></li>';
 
//` echo $text;
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
