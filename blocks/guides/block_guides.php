<?PHP //$Id$

require_once($CFG->dirroot . '/blocks/moodleblock.class.php');

class block_guides extends block_list {
    function init() {
        $this->title = get_string('guides','block/guides');
        $this->version = 2010073000;
    }

    function has_config() {
        return false;
    }

    function get_content() {
        global $THEME, $CFG, $USER;

        if($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $context = get_context_instance(CONTEXT_SYSTEM);
        if(!has_capability('block/guides:viewownguide', $context)) {
            return $this->content;
        }

        $icon  = "<img src=\"$CFG->pixpath/i/course.gif\"".
                 " class=\"icon\" alt=\"".get_string("coursecategory")."\" />";
        $inprogresscontent = '';
        require_once($CFG->dirroot . '/guides/lib.php');
        $gissql = 'SELECT g.id, gi.currentstep, gi.guide, gi.id as giid, g.steps, g.name, g.description ' .
                    'FROM ' . $CFG->prefix . 'block_guides_guide g' .
                    ' INNER JOIN ' . $CFG->prefix . 'block_guides_guide_instance gi ON gi.guide = g.id ' .
                    'WHERE gi.deleted = 0 AND gi.userid = ' . $USER->id . ' ' .
                    'ORDER by g.id asc';
        $guideinstances = get_records_sql($gissql);
        if (empty($guideinstances)) {
            $guideinstances = array();
        }
        if ($guideinstances) {
            foreach ($guideinstances as $guideid => $guideinstance) {
                $inprogresscontent = '';
                $efforttotal = 0;
                $effortdone = 0;
                measure_gi_progress($guideinstance, array(), $efforttotal, $effortdone);
                $percentvalue = $effortdone / $efforttotal * 100;
                $pixelvalue = $effortdone / $efforttotal * 121;
                $pixeloffset = round($pixelvalue - 120);
                $percent = round($percentvalue);
                $guideinstances[$guideid]->progress = $percent;
                $inprogresscontent .= '<form action="' . $CFG->wwwroot . '/guides/delete.php?gi=' . $guideinstance->giid . '" method="post">';
                $inprogresscontent .= '<a href="' . $CFG->wwwroot . '/guides/view.php?gi=' . $guideinstance->giid . '">' .
                        $guideinstance->name . '</a>';
                $inprogresscontent .= ' <input type="hidden" name="gi" value="' . $guideinstance->giid . '" />';
                $inprogresscontent .= '<input type="image" class="iconsmall" src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" alt="delete guide progress" />';
                $inprogresscontent .= '<img src="' . $CFG->wwwroot . '/guides/percentImage.png" alt="' . $percent . '%" style="background: white url(' . $CFG->wwwroot . '/guides/percentImage_back.png) top left no-repeat;padding: 0;margin: 5px 0 0 0;background-position: ' . $pixeloffset . 'px 0pt;" /> ';
                $inprogresscontent .= " $percent %";
                $inprogresscontent .= '</form>';
                $this->content->items[] = $inprogresscontent;
            }
            $this->content->footer = '<a href="' . $CFG->wwwroot . '/guides/index.php">More detail</a>';
        } else {
            $this->content->footer = '<a href="' . $CFG->wwwroot . '/guides/index.php">View all guides</a>';
        }
        return $this->content;
    }
}

?>
