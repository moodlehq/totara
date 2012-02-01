<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage build
 *
 *
 * This script is for use while resetting an install for testing.
 *
 * By clearing moodle data in this script we can do the `rm` as the correct
 * linux user.
 */

/**
 * Only run this command if no config file exists
 * (just for a little bit of added security)
 */
if (file_exists('config.php')) {
    die("ERROR: Do not run this command on a live site\n");
}

/**
 * Please, avert your eyes
 */
exec('rm -Rf ../moodledata/*');
exec('rm -Rf ../moodledata/.htaccess');
