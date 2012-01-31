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
 * Add oauth administration menu settings
 * @package   localoauth
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/// Add oauth administration pages to the Moodle administration menu
$ADMIN->add('authsettings', new admin_category('local_oauth', get_string('oauth', 'local_oauth')));
$ADMIN->add('local_oauth', new admin_externalpage('oauthsettings', get_string('settings', 'local_oauth'),
        $CFG->wwwroot."/local/oauth/admin/settings.php",
        'moodle/site:config'));
$ADMIN->add('local_oauth', new admin_externalpage('oauthregistrations', get_string('registrations', 'local_oauth'),
        $CFG->wwwroot."/local/oauth/admin/registrations.php",
        'moodle/site:config'));
$ADMIN->add('local_oauth', new admin_externalpage('oauthfusiontables', get_string('fusiontables', 'local_oauth'),
        "http://tables.googlelabs.com",
        'moodle/site:config'));

