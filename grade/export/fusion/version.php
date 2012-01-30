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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage grade_export_fusion
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version  = 2007092700;       // The current module version (Date: YYYYMMDDXX)
$plugin->requires = 2011120501;       // Requires this Moodle version
$plugin->cron = 0;                    // Period for cron to check this module (secs)
$plugin->component = 'gradeexport_fusion'; // To check on upgrade, that module sits in correct place
