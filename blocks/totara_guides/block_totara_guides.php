<?PHP //$Id$

require_once($CFG->dirroot . '/blocks/moodleblock.class.php');

class block_totara_guides extends block_list {
    function init() {
        $this->title = get_string('pluginname', 'block_totara_guides');
        $this->version = 2010073000;
    }

    function has_config() {
        return false;
    }

    function get_content() {
        global $THEME, $CFG, $USER, $DB, $OUTPUT;

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
        $icon  = $OUTPUT->pix_icon('i/course.gif', get_string("coursecategory"), null, array('class' => 'icon'));
        $inprogresscontent = '';
        require_once($CFG->dirroot . '/guides/lib.php');
        $gissql = '
            SELECT g.id, gi.currentstep, gi.guide, gi.id as giid, g.steps, g.name, g.description
              FROM {block_guides_guide} g
             INNER JOIN {block_guides_guide_instance} gi ON gi.guide = g.id
             WHERE gi.deleted = 0 AND gi.userid = ?
             ORDER by g.id asc
        ';
        $guideinstances = $DB->get_records_sql($gissql, array($USER->id));
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
                $inprogresscontent .= html_writer::start_tag('form', array('action' => new moodle_url('/guides/delete.php', array('gi' => $guideinstance->giid)),  'method' => 'post'));
                $url = new moodle_url('/guides/view.php', array('gi' => $guideinstance->giid));
                $inprogresscontent .= html_writer::link($url, $guideinstance->name);
                $inprogresscontent .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "gi", 'value' => $guideinstance->giid));
                $inprogresscontent .= html_writer::empty_tag('input', array('type' => 'image', 'class' => "iconsmall", 'alt' => get_string('deleteguideprogress', 'block_totara_guides'), 'src' => $OUTPUT->pix_url('/t/delete.gif', 'theme')));
                $inprogresscontent .= $OUTPUT->pix_icon('/percentImage', $percent . '%', 'block_totara_guides', array('class' => 'icon percentImage', 'style' => "background-position: ' . $pixeloffset . 'px 0pt;"));
                $inprogresscontent .= " $percent %";
                $inprogresscontent .= html_writer::end_tag('form');
                $this->content->items[] = $inprogresscontent;
            }
            $this->content->footer = html_writer::link(new moodle_url('/guides/index.php'), get_string('moredetail', 'block_totara_guides'));
        } else {
            $this->content->footer = html_writer::link(new moodle_url('/guides/index.php'), get_string('viewallguides', 'block_totara_guides'));
        }
        return $this->content;
    }
}

?>
