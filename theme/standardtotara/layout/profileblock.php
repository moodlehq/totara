<div id="profileoptions">
<?php
if (!isloggedin() or isguestuser()) {
    echo '<ul>';
    echo '<li><a class="login link-as-button" href="' . $CFG->wwwroot . '/login/index.php">' . get_string('login') . '</a></li>';
    echo '</ul>';
} else {
    echo '<ul>';
    echo '<li><a href="'.$CFG->wwwroot . '/login/logout.php?sesskey=' . sesskey() . '" class="link-as-button">' . get_string('logout') . '</a></li>';
    echo '</ul>';
}
?>
</div>

<div id="profilename">
<?php

if (empty($CFG->loginhttps)) {
    $wwwroot = $CFG->wwwroot;
} else {
    $wwwroot = str_replace("http://", "https://", $CFG->wwwroot);
}

if (!isloggedin() or isguestuser()) {
    echo '<div>You are not logged in</div>';
} else {
    echo '<div>'.get_string('loggedin','theme_standardtotara').' <a href="'.$CFG->wwwroot.'/user/view.php?id='.$USER->id.'&amp;course='.$COURSE->id.'">'.$USER->firstname.' '.$USER->lastname.'</a></div>';
}
?>
</div>

