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
 * Strings for component 'enrol_manual', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_manual
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['alterstatus'] = 'שינוי מצב';
$string['altertimeend'] = 'שינוי זמן הסיום';
$string['altertimestart'] = 'שינוי זמן ההתחלה';
$string['assignrole'] = 'הקצאת תפקיד';
$string['confirmbulkdeleteenrolment'] = 'האם הינך בטוח כי ברצונך למחוק את הרשמות משתמשים אלו.';
$string['defaultperiod'] = 'תקופת רישום כברירת מחדל';
$string['defaultperiod_desc'] = 'ברירת מחדל של הגדרת אורך תקופת הרישום של ברירת המחדל (בשניות). אם מוגדר ערך 0 (אפס), משך זמן התקופה יהיה בלתי מוגבל כברירת מחדל.';
$string['defaultperiod_help'] = 'ברירת מחדל של הגדרת אורך תקופת הרישום של ברירת המחדל תקף, מתחיל ברגע שהמשתמש רשום. אם ההגדרה כבויה, משך הזמן של ההרשמה יהיה בלתי מוגבל כברירת מחדל.';
$string['deleteselectedusers'] = 'מחק את ההרשמות של המשתמש שנבחרו';
$string['editenrolment'] = 'עריכת רישום';
$string['editselectedusers'] = 'עריכת הרשמות משתמשים שנבחרו';
$string['enrolledincourserole'] = 'נרשם לקורס "{$a->course}" בתפקיד "{$a->role}"';
$string['enrolusers'] = 'רישום משתמשים';
$string['manual:config'] = 'הגדרת מופעי רישום ידני';
$string['manual:enrol'] = 'רישום משתמשים';
$string['manual:manage'] = 'ניהול הרשמות משתמש';
$string['manual:unenrol'] = 'הסרת רישום משתמשים מהקורס';
$string['manual:unenrolself'] = 'הסרה עצמית מהקורס';
$string['pluginname'] = 'רישומים ידניים';
$string['pluginname_desc'] = 'תוסף הרישומים העצמיים מאפשר למשתמשים להירשם באופן ידני
דרך קישור בהגדרות הניהול של הקורס, על-ידי משתמש עם הרשאות מתאימות כמו מורה. התוסף אמור להיות מאופשר מכיוון שתוספי רישום אחרים  כמו רישום עצמי דורשים זאת.';
$string['status'] = 'אפשר רישומים ידניים';
$string['status_desc'] = 'אפשר גישת קורס של משתמשים רשומים פנימיים.';
$string['status_help'] = 'הגדרה זו קובעת האם משתמשים יכולים להירשום באופן ידני, דרך קישור בהגדרות הניהול של הקורס, על-ידי משתמש עם הרשאות מתאימות כמו מורה.';
$string['statusdisabled'] = 'לא תאפשר';
$string['statusenabled'] = 'מאופשר';
$string['unenrol'] = 'הסרת הרשמה למשתמש';
$string['unenrolselectedusers'] = 'הסרת הרשמה למשתמשים שנבחרו';
$string['unenrolselfconfirm'] = 'האם אתה בטוח כי ברצונך לבטל את ההרשמה שלך מהקורס "{$a}"?';
$string['unenroluser'] = 'האם ברצונך להיות מוסר מרישום
"{$a->user}"
מקורס "{$a->course}"?';
$string['unenrolusers'] = 'משתמשים לא רשומים';
$string['wscannotenrol'] = 'מופע התוסף לא יכול לרשום משתמש ב-ID שלהקורס =
{$a->courseid}';
$string['wsnoinstance'] = 'מופע תוסף רישום ידני לא קיים או שאינו מאופשר וכבוי לקורס
(id = {$a->courseid})';
$string['wsusercannotassign'] = 'אין לך הרשאות להקצאת תפקיד זה
({$a->roleid})
למשתמש
({$a->userid})
בקורס ({$a->courseid}).';
