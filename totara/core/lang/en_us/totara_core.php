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
 * @package totara
 * @subpackage totara_core
 *
 * totara_core specific language strings.
 * these should be called like get_string('key', 'totara_core');
 * Replaces lang/[lang]/local.php from 1.1 series
 */

$string['pluginname'] = 'Totara core';

$string['organisation_typeicon'] = 'Organization type icon';
$string['organisationatcompletion'] = 'Organization at completion';
$string['organisationsarrow'] = 'Organizations >';
$string['datepickerdisplayformat'] = 'mm/dd/y';
$string['datepickerplaceholder'] = 'mm/dd/yy'; //how the datepicker placeholder hint displays the default
$string['datepickerparseformat'] = 'm/d/y'; //how php parses the datepicker dates to a timestamp (in totara_date_parse_from_format)
$string['datepickerregexjs'] = '(0|1)[0-9]/[0-3][0-9]/[0-9]{2}';
$string['datepickerregexphp'] = '/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][0-9]|3[01])\/(\d{2})$/';
?>
