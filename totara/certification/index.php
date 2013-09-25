<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 *
 * @package    totara
 * @subpackage certification
 * @copyright  2013 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/totara/certification/lib.php');
require_once($CFG->libdir. '/coursecatlib.php');

$categoryid = optional_param('categoryid', 0, PARAM_INT); // Category id
$site = get_site();

if ($categoryid) {
    $PAGE->set_category_by_id($categoryid);
    $PAGE->set_url(new moodle_url('/totara/certification/index.php', array('categoryid' => $categoryid)));
    $PAGE->set_pagetype('course-index-category');
    $category = $PAGE->category;
    // Add certification breadcrumbs.
    $PAGE->navbar->add(get_string('certifications', 'totara_certification'), new moodle_url('/totara/certification/index.php'));
    $category_breadcrumbs = prog_get_category_breadcrumbs($categoryid, 'certification');
    foreach ($category_breadcrumbs as $crumb) {
        $PAGE->navbar->add($crumb['name'], $crumb['link']);
    }
} else {
    $categoryid = 0;
    $PAGE->set_url('/totara/certification/index.php');
    $PAGE->set_context(context_system::instance());
}

$PAGE->set_pagelayout('coursecategory');
$certificationrenderer = $PAGE->get_renderer('totara_certification');

if ($CFG->forcelogin) {
    require_login();
}

if ($categoryid && !$category->visible && !has_capability('moodle/category:viewhiddencategories', $PAGE->context)) {
    throw new moodle_exception('unknowncategory');
}

$PAGE->set_totara_menu_selected('findcourses');
$PAGE->set_heading(format_string($site->fullname));
$content = $certificationrenderer->certification_category($categoryid); // TODO

echo $OUTPUT->header();
echo $OUTPUT->skip_link_target();
echo $content;

echo $OUTPUT->footer();
