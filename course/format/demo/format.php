<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Chris Wharton <chrisw@catalyst.net.nz>
 * @package totara
 * @subpackage totara_course_format
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/filelib.php');
require_once($CFG->libdir.'/completionlib.php');

$topic = optional_param('topic', -1, PARAM_INT);

if ($topic != -1) {
    $displaysection = course_set_display($course->id, $topic);
} else {
    $displaysection = course_get_display($course->id);
}

$streditsummary  = get_string('editsummary');
$stradd          = get_string('add');
$stractivities   = get_string('activities');
$strshowalltopics= get_string('showalltopics');
$strtopic        = get_string('topic');
$strgroups       = get_string('groups');
$strgroupmy      = get_string('groupmy');
$editing         = $PAGE->user_is_editing();

if ($editing) {
    $textlib = textlib_get_instance();
    $strstudents = $textlib->strtolower(get_string('students', 'moodle'), 'UTF-8');
    $strtopichide = get_string('topichide', '', $strstudents);
    $strtopicshow = get_string('topicshow', '', $strstudents);
    $strmarkthistopic = get_string('markthistopic');
    $strmarkedthistopic = get_string('markedthistopic');
    $strmoveup = get_string('moveup');
    $strmovedown = get_string('movedown');
}

$context = context_course::instance($course->id);

if (($marker >=0) && has_capability('moodle/course:setcurrentsection', $context) && confirm_sesskey()) {
    $course->marker = $marker;
    $DB->set_field("course", "marker", $marker, "id", $course->id);
}

//Print the Your progress icon if the track completion is enabled
$completioninfo = new completion_info($course);
echo $completioninfo->display_help_icon();

$OUTPUT->container_start();
$OUTPUT->skip_link_target();
echo html_writer::start_tag('ul', array('class' => 'demo'));
/// If currently moving a file then show the current clipboard
if (ismoving($course->id)) {
    $stractivityclipboard = strip_tags(get_string('activityclipboard', '', $USER->activitycopyname));
    $strcancel = get_string('cancel') . ')';
    $link = $stractivityclipboard.'&nbsp;&nbsp;(' . $OUTPUT->action_link(new moodle_url('mod.php', array('cancelcopy' => 'true', 'sesskey' => sesskey())), $strcancel);
    echo html_writer::tag("li", $link, array('class' => 'clipboard'));
}

    /// Print Section 0 with general activities

    $section = 0;
    $thissection = $sections[$section];
    unset($sections[0]);

    if ($thissection->visible or $PAGE->user_is_editing()) {
        // Note, 'right side' is BEFORE content.
        echo html_writer::start_tag('li', array ('id' => "section-0", 'class' => "section main clearfix"));
        echo $OUTPUT->container('&nbsp;', 'left side');
        echo $OUTPUT->container('&nbsp;', 'right side');
        echo $OUTPUT->container_start('content');

        if (!empty($thissection->name)) {
            echo $OUTPUT->heading(format_string($thissection->name, true, array('context' => $context)), 1, 'sectionname');
        } else {
            echo $OUTPUT->heading(format_string(get_string('topicoutline'), true, array('context' => $context)), 1, 'sectionname');
        }

        echo $OUTPUT->container_start('summary');

        $coursecontext = context_course::instance($course->id);
        $summarytext = file_rewrite_pluginfile_urls($thissection->summary, 'pluginfile.php', $coursecontext->id, 'course', 'section', $thissection->id);
        $summaryformatoptions = new stdClass();
        $summaryformatoptions->noclean = true;
        $summaryformatoptions->overflowdiv = true;
        echo format_text($summarytext, $thissection->summaryformat, $summaryformatoptions);

        if ($PAGE->user_is_editing() && has_capability('moodle/course:update', context_course::instance($course->id))) {
            echo html_writer::tag('p', $OUTPUT->action_icon(new moodle_url('editsection.php', array('id' => $thissection->id)), new pix_icon('t/edit', $streditsummary)));
        }
        echo $OUTPUT->container_end();

        print_section($course, $thissection, $mods, $modnamesused);

        if ($PAGE->user_is_editing()) {
            print_section_add_menus($course, $section, $modnames);
        }

        echo $OUTPUT->container_end();
        echo html_writer::end_tag("li");
    }


/// Now all the normal modules by topic
/// Everything below uses "section" terminology - each "section" is a topic.

$section = 1;
$sectionmenu = array();

while ($section <= $course->numsections) {

    if (!empty($sections[$section])) {
        $thissection = $sections[$section];

    } else {
        unset($thissection);
        $thissection->course = $course->id;   // Create a new section structure
        $thissection->section = $section;
        $thissection->name = null;
        $thissection->summary = '';
        $thissection->summaryformat = FORMAT_HTML;
        $thissection->visible = 1;
        if (!$thissection->id = $DB->insert_record('course_sections', $thissection)) {
            totara_set_notification('Error inserting new topic!');
        }
    }

    $showsection = (has_capability('moodle/course:viewhiddensections', $context) or $thissection->visible or !$course->hiddensections);

    if (!empty($displaysection) and $displaysection != $section) {
        if ($showsection) {
            $strsummary = strip_tags(format_string($thissection->summary,true));
            if (strlen($strsummary) < 57) {
                $strsummary = ' - '.$strsummary;
            } else {
                $strsummary = ' - '.substr($strsummary, 0, 60).'...';
            }
            $sectionmenu['topic='.$section] = s($section.$strsummary);
        }
        $section++;
        continue;
    }

    if ($showsection) {

        $currenttopic = ($course->marker == $section);

        $currenttext = '';
        if (!$thissection->visible) {
            $sectionstyle = ' hidden';
        } else if ($currenttopic) {
            $sectionstyle = ' current';
            $currenttext = get_accesshide(get_string('currenttopic','access'));
        } else {
            $sectionstyle = 'format-demo-content';
        }

        echo html_writer::start_tag('li', array ('id' => "section-{$section}", 'class' => "section main {$sectionstyle}"));
        echo $OUTPUT->container('&nbsp;', 'left side');
        echo $OUTPUT->container('&nbsp;', 'right side');
        echo $OUTPUT->container_start('content');

        if (!has_capability('moodle/course:viewhiddensections', $context) and !$thissection->visible) {   // Hidden for students
            echo get_string('notavailable');
        } else {
            echo $OUTPUT->container_start('summary');
            $summaryformatoptions = new stdClass();
            $summaryformatoptions->noclean = true;
            echo format_text($thissection->summary, FORMAT_HTML, $summaryformatoptions);

            if ($PAGE->user_is_editing($course->id) && has_capability('moodle/course:update', context_course::instance($course->id))) {
                echo $OUTPUT->action_icon(new moodle_url('editsection.php', array('id' => $thissection->id)), new pix_icon('t/edit', $streditsummary));
                echo html_writer::empty_tag('br') . html_writer::empty_tag('br');
            }
            $OUTPUT->container_end();

            print_section($course, $thissection, $mods, $modnamesused);

            if ($PAGE->user_is_editing($course->id)) {
                print_section_add_menus($course, $section, $modnames);
            }
        }

        echo $OUTPUT->container_end();
        echo html_writer::end_tag("li");
    }
    unset($sections[$section]);
    $section++;
}

if (!$displaysection and $PAGE->user_is_editing() and has_capability('moodle/course:update', context_course::instance($course->id))) {
    // print stealth sections if present
    $modinfo = get_fast_modinfo($course);
    foreach ($sections as $section=>$thissection) {
        if (empty($modinfo->sections[$section])) {
            continue;
        }

        $content = $OUTPUT->container('', 'left side');
        // Note, 'right side' is BEFORE content.
        $content .=  $OUTPUT->container('', 'right side');
        $content .= $OUTPUT->container(
                $OUTPUT->heading(get_string('orphanedactivities'), 3, 'sectionname') .
                print_section($course, $thissection, $mods, $modnamesused),
                'content'
                );
        echo html_writer::tag("li", $content, array('id' => "section-{$section}", 'class' => 'section main clearfix stealth hidden'));
    }
}
echo html_writer::end_tag('ul');

if (!empty($sectionmenu)) {
    $select = new single_select(new moodle_url('/course/view.php', array('id'=>$course->id)), 'topic', $sectionmenu);
    $select->label = get_string('jumpto');
    $select->class = 'jumpmenu';
    $select->formid = 'sectionmenu';
    echo $OUTPUT->render($select);
}

$OUTPUT->container_end();
echo html_writer::end_tag('td');
