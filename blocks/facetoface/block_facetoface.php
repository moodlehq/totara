<?php

class block_facetoface extends block_base {
    function init() {
        $this->title = get_string('formaltitle', 'block_facetoface');
        $this->version = 2008050600;
    }

    function get_content() {
        global $CFG;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->footer = '';

        $timenow = time();
        $startyear  = strftime('%Y', $timenow);
        $startmonth = strftime('%m', $timenow);
        $startday   = strftime('%d', $timenow);

        $this->content->text = '';
        $this->content->text .= "<ul>\n";
        $this->content->text .= '<li><a href="'.$CFG->wwwroot.'/blocks/facetoface/mysessions.php">'.get_string('upcomingsessions', 'block_facetoface')."</a></li>\n";
        $this->content->text .= '<li><a href="'.$CFG->wwwroot.'/blocks/facetoface/mysessions.php?startday='.$startday.'&amp;startmonth='.$startmonth.'&amp;startyear='.$startyear.'&amp;endday=1&amp;endmonth=1&amp;endyear=2020">'.get_string('allfuturesessions', 'block_facetoface')."</a></li>\n";
        $this->content->text .= '<li><a href="'.$CFG->wwwroot.'/blocks/facetoface/mysessions.php?startday=1&amp;startmonth=1&amp;startyear=2000&amp;endday=1&amp;endmonth=1&amp;endyear=2020">'.get_string('allsessions', 'block_facetoface')."</a></li>\n";
        $this->content->text .= "</ul>\n";

        return $this->content;
    }
}

?>
