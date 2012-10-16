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
 * Strings for component 'auth_email', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_emaildescription'] = 'אימות דואר אלקטרוני הוא שיטת האימות המשמשת כברירת מחדל. כאשר המשתמש נרשם, ובוחר שם משתמש וסיסמה משלו, לכתובת הדואר האלקטרוני שלו נשלחת הודעת אישור. דואר אלקטרוני זה מכיל קישור מאובטח לעמוד בו המשתמש יכול לאשר את החשבון שלו. התחברויות עתידיות רק בודקות את שם המשתמש והסיסמה כנגד הערכים השמורים בבסיס הנתונים של Moodle.';
$string['auth_emailnoemail'] = 'נכשל ניסיון לשלוח לך הודעת דואר אלקטרוני!';
$string['auth_emailrecaptcha'] = 'מוסיף אישור וידאושמע עבור מנגנון לרישום עמוד למשתמשי רישום עצמי בדוא"ל. הדבר מגן על האתר שלך מפני שליחת דוא"ל זבל ותורם לסיבה כדאית. ראה  http://recaptcha.net/learnmore.html
לפרטים נוספים.
<br /><em>PHP cURL extension is required.</em>';
$string['auth_emailrecaptcha_key'] = 'אפשר מנגנון reCAPTCHA';
$string['auth_emailsettings'] = 'הגדרות';
$string['pluginname'] = 'אימות על בסיס דואר אלקטרוני';
