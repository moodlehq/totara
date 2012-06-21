<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Link to CSV course upload
 *
 * @package    tool
 * @subpackage totara_sync
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if (has_capability('tool/totara_sync:manage', $systemcontext)) {
    require_once($CFG->dirroot.'/admin/tool/totara_sync/lib.php');

    $ADMIN->add('root', new admin_category('tool_totara_sync', get_string('pluginname', 'tool_totara_sync')));
    $ADMIN->add('tool_totara_sync', new admin_category('syncelements', get_string('elements', 'tool_totara_sync')));
    $ADMIN->add('tool_totara_sync', new admin_category('syncsources', get_string('sources', 'tool_totara_sync')));
    $ADMIN->add('syncelements', new admin_externalpage('managesyncelements', get_string('manageelements', 'tool_totara_sync'), "$CFG->wwwroot/admin/tool/totara_sync/admin/elements.php", 'tool/totara_sync:manage'));

    if ($elements = totara_sync_get_elements($onlyenabled=true)) {
        foreach ($elements as $e) {
            /// Elements
            $elname = $e->get_name();
            $ADMIN->add('syncelements', new admin_externalpage('syncelement'.$elname,
                            get_string('displayname:'.$elname, 'tool_totara_sync'), "$CFG->wwwroot/admin/tool/totara_sync/admin/elementsettings.php?element={$elname}", 'tool/totara_sync:manage'));

            /// Sources
            if ($sources = $e->get_sources()) {

                $ADMIN->add('syncsources', new admin_category($elname.'sources', get_string('displayname:'.$elname, 'tool_totara_sync')));
                foreach ($sources as $s) {
                    if (!$s->has_config()) {
                        continue;
                    }
                    $sname = $s->get_name();
                    $ADMIN->add($elname.'sources', new admin_externalpage($sname,
                                    get_string('displayname:'.$sname, 'tool_totara_sync'), "$CFG->wwwroot/admin/tool/totara_sync/admin/sourcesettings.php?element={$elname}&source={$sname}", 'tool/totara_sync:manage'));
                }
            }
        }
        $ADMIN->add('syncsources', new admin_externalpage('uploadsyncfiles', get_string('uploadsyncfiles', 'tool_totara_sync'), "$CFG->wwwroot/admin/tool/totara_sync/admin/uploadsourcefiles.php", 'tool/totara_sync:manage'));
        unset($elname);
    }
}
