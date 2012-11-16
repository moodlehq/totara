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
 * Strings for component 'enrol_self', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_self
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['customwelcomemessage'] = 'הודעת "ברוכים הבאים" מותאמת מראש';
$string['defaultrole'] = 'ברירת מחדל של הקצאת התפקיד';
$string['defaultrole_desc'] = 'בחר תפקיד אשר יוקצה למשתמשים בזמן רישום עצמי';
$string['editenrolment'] = 'עריכת רישום';
$string['enrolenddate'] = 'תאריך סיום';
$string['enrolenddate_help'] = 'אם מאופשר, משתמשים יוכלו לרשום את עצמם עד תאריך זה בלבד.';
$string['enrolenddaterror'] = 'תאריך סיום ההרשמה לא יכול להיות מוקדם יותר מתאריך ההתחלה';
$string['enrolme'] = 'רשום אותי';
$string['enrolperiod'] = 'תקופת רישום';
$string['enrolperiod_desc'] = 'אורך תקופת הרישום כברירת מחדל (בשניות), אם מסומן ערך 0 (אפס) , תקופת הרישום תיהיה בלתי מוגבלת כברירת מחדל';
$string['enrolperiod_help'] = 'אורך תקופת זמן הרישום תקפה, מתחיל ברגע שהמשתמש רשום . אם כבוי, משך תקופת הרישום יהיה בלתי מוגבל.';
$string['enrolstartdate'] = 'תאריך התחלה';
$string['enrolstartdate_help'] = 'אם מאופשר, משתמשים יוכלו לרשום עצמם מתאריך זה והלאה בלבד.';
$string['groupkey'] = 'השתמש במפתחות הרשמה של הקבוצה';
$string['groupkey_desc'] = 'השתמש במפתחות הרשמה של הקבוצה כברירת מחדל';
$string['groupkey_help'] = 'בנוסף לחסימת הגישה לקורס רק עבור אלו היודעים מהו המפתח, שימוש במפתח הרשמה של קבוצה משמע, המשתמשים הירשמו אוטומטית לקורס ולקבוצה בעת הקשת מפתח הרשמה זה.
בכדי להשתמש במפתח הרשמה של קבוצה, מפתח ההרשמה מוכרח להיות מצויין בהגדרות הקורס בנוסף להגדרות הקבוצה.';
$string['longtimenosee'] = 'הסר מהרישום אלו שאינם פעילים לאחר';
$string['longtimenosee_help'] = 'אם המשתמשים לא נגשו לקורס במשך זמן רב, הם יוסרו מהרישום של הקורס באופן אוטומטי. משתנה זה מציין את תקופת הזמן הזו.';
$string['maxenrolled'] = 'מספר מירבי של משתמשים רשומים.';
$string['maxenrolled_help'] = 'ציין את המספר המירבי של משתמשים אשר מורשים להירשם באופן עצמאי. משמעות הערך 0 היא ללא גבול.';
$string['maxenrolledreached'] = 'המספר מירבי של משתמשים אשר מורשים להירשם באופן עצמאי  הגיע לסוף מכסתו.';
$string['nopassword'] = 'כלל לא נדרש מפתח הרשמה';
$string['password'] = 'מפתח הרשמה';
$string['password_help'] = 'מפתח הרשמה מאפשר לגשת לקורס רק לאלו היודעים אותו. אם השדה כאן ריק, כל משתמש יוכל להרשם לקורס.
אם מפתח מוזן כאן, כל משתמש אשר ינסה להיכנס לקורס יצטרך לספק את מפתח זה בכדי להירשם ולהיכנס לקורס. שים לב כי משתמש הצטרך לספק באופן חד פעמי את המפתח, לאחר מכן יוכל להיכנס לקורס ללא מפתח , כמו כן הוא כבר יהיה רשום אליו..';
$string['passwordinvalid'] = 'מפתח ההרשמה שהזנת שגוי, אנא נסה שוב.';
$string['passwordinvalidhint'] = 'מפתח ההרשמה ההוא היה שגוי, אנא נסה שנית<br /> (הנה רמז - הוא מתחיל ב\'{$a}\')';
$string['pluginname'] = 'רישום עצמי';
$string['pluginname_desc'] = 'תוסף הרישום העצמי מאפשר למשתמשים לבחור אילו קורסים יוכלו להיות מוגנים על-ידי מפתח הרשמה. הרישום נעשה מבפנים דרך התוסף הרישום הידני אשר מוכרח להיות מאופשר באותו קורס.';
$string['requirepassword'] = 'נדרש מפתח הרשמה';
$string['requirepassword_desc'] = 'נדרש מפתח הרשמה לקורסים חדשים ולמנוע הסרת מפתח הרשמה מקורסים קיימים.';
$string['role'] = 'הקצאת תפקיד כברירת מחדל';
$string['self:config'] = 'הגדר מופעי רישום עצמי';
$string['self:manage'] = 'נהל משתמשים רשומים';
$string['self:unenrol'] = 'הסרת רישום משתמשים מקורס';
$string['self:unenrolself'] = 'הסר רישום עצמי מהקורס';
$string['sendcoursewelcomemessage'] = 'שלח הודעה "ברוך הבא לקורס"';
$string['sendcoursewelcomemessage_help'] = 'אם מאופשר, המשתמש יקבל הודעת "ברוך הבא" דרך הדוא"ל כאשר הוא נרשם לקורס באופן עצמאי';
$string['showhint'] = 'הצג רמז';
$string['showhint_desc'] = 'הצג אות ראשונה של מפתח גישת האורח';
$string['status'] = 'אפשר הרשמות עצמיות';
$string['status_desc'] = 'אפשר למשתמשים להירשם לקורס באופן עצמאי  כברירת מחדל.';
$string['status_help'] = 'הגדרה זו קובעת אם משתמש יכול לרשום עצמם לקורס ( וגם להסיר מהרישום אם יש להם הרשאות מתאימות).';
$string['unenrol'] = 'הסרת רישום משתמש';
$string['unenrolselfconfirm'] = 'האם הינך בטוח כי ברצונך להסיר עצמך מהרישום לקורס  "{$a}"?';
$string['unenroluser'] = 'האם הינך בתוך כי תרצה להסיר עצמך מקורס "{$a->user}" מהקורס "{$a->course}"?';
$string['usepasswordpolicy'] = 'מדיניות סיסמת משתמש';
$string['usepasswordpolicy_desc'] = 'מדיניות סיסמת משתמש רגילה עבור מפתחות הרשמה.';
$string['welcometocourse'] = 'ברוך בואך לקורס {$a}';
$string['welcometocoursetext'] = 'ברוך בואך לקורס {$a->coursename}!

אם לא עשית זאת כבר, עליך לערוך את עמוד הפרופיל שלך בקורס כך שנוכל להכירך טוב יותר:

{$a->profileurl}';
