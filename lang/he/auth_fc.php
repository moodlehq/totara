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
 * Strings for component 'auth_fc', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_fc
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_fcchangepasswordurl'] = 'כתובת URL המשמשת לשינוי סיסמה';
$string['auth_fcconnfail'] = 'החיבור עם Errno נכשל: {$a->no} ומחרוזת שגיאה: {$a->str}';
$string['auth_fccreators'] = 'רשימת קבוצות שחבריהם רשאים ליצור קורסים חדשים. אנא הפרד קבוצות מרובות בעזרת \';\'. יש להגדיר את השמות באופן זהה לאופן שבו הם מוגדרים על שרת FirsClass. המערכת רגישה לאותיות רישיות.';
$string['auth_fccreators_key'] = 'יוצרים';
$string['auth_fcdescription'] = 'שיטה זו משתמשת בשרת FirstClass לבדיקה האם שם משתמש וסיסמה תקפים.';
$string['auth_fcfppport'] = 'יציאת השרת (3333 הוא הנפוץ ביותר)';
$string['auth_fcfppport_key'] = 'יציאה';
$string['auth_fchost'] = 'כתובת שרת FirstClass. עליך להגדיר את כתובת ה-IP או את שם ה-DNS.';
$string['auth_fchost_key'] = 'מחשב מארח:';
$string['auth_fcpasswd'] = 'סיסמה עבור החשבון הנ"ל.';
$string['auth_fcpasswd_key'] = 'סיסמה';
$string['auth_fcuserid'] = 'קוד המשתמש עבור חשבון FirstClass עם הרשאת \'Subadministrator\' מוגדרת.';
$string['auth_fcuserid_key'] = 'מספר זיהוי משתמש';
$string['pluginname'] = 'השתמש בשרת FirstClass';
