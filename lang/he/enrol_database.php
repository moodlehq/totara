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
 * Strings for component 'enrol_database', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_database
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['dbencoding'] = 'קידוד מסד הנתונים';
$string['dbhost'] = 'מספר או שם ה-IP של השרת';
$string['dbhost_desc'] = 'סוג כתובת IP של שרת מסד הנתונים
או שם המארח';
$string['dbname'] = 'שם בסיס הנתונים';
$string['dbpass'] = 'הסיסמא של השרת';
$string['dbsetupsql'] = 'פקודת הגדרת מסד הנתונים';
$string['dbsybasequoting'] = 'השתמש בציטוטי sybase';
$string['dbtype'] = 'סוג בסיס הנתונים';
$string['dbtype_desc'] = 'שם התקן ADOdb של מסד הנתונים,
סוג מנוע מסד הנתונים החיצוני.';
$string['dbuser'] = 'משתמש השרת';
$string['debugdb'] = 'ניפוי שגיאות ADOdb';
$string['debugdb_desc'] = 'ניפוי שגיאות של חיבור ADOdb למסד נתונים חיצוני - שימושי כאשר מקבלים דף ריק בהתחברות. לא מתאים לאתרם אופרטיביים';
$string['defaultcategory'] = 'קטגוריית קורס חדשה כברירת מחדל';
$string['defaultcategory_desc'] = 'ברירת המחדל של קטגוריה ליצירת קורסים אוטומטית. שימושי כאשר לא צויין כל ID של קטגוריה חדשה או לא נמצא כזה מזהה.';
$string['defaultrole'] = 'תפקיד ברירת מחדל';
$string['defaultrole_desc'] = 'התפקיד שיוקצה כברירת מחדל אם לא צויין כל תפקיד  בטבלה חיצונית';
$string['ignorehiddencourses'] = 'התעלם מקורסים נסתרים';
$string['ignorehiddencourses_desc'] = 'אם מאופשר, משתמשים לא ירשמו לקורסים אשר מוגדרים להיות נסתרים לסטודנטים';
$string['localcoursefield'] = 'שם השדה בטבלת הקורס בו אנו משתמשים כדי להתאים רשומות בבסיס הנתונים החיצוני (כלומר מספר זיהוי).';
$string['localrolefield'] = 'שם השדה בטבלת התפקידים בו אנו משתמשים כדי להתאים רשומות בבסיס הנתונים החיצוני (כלומר שם קצר).';
$string['localuserfield'] = 'שם השדה בטבלת המשתמשים בו אנו משתמשים כדי להתאים רשומות בבסיס הנתונים החיצוני (כלומר מספר זיהוי).';
$string['newcoursecategory'] = 'שדה זיהוי ID קטגוריית קורס חדשה';
$string['newcoursefullname'] = 'שדה שם מלא של קורס חדש';
$string['newcourseidnumber'] = 'שדה מספר זיהוי ID של קורס חדש';
$string['newcourseshortname'] = 'שדה שם קצר לקורס חדש';
$string['newcoursetable'] = 'טבלת קורסים חדשים מרוחקים';
$string['newcoursetable_desc'] = 'ציין את שם הטבלה המכילה רשימת קורסים אשר אמורים להיווצר באופן אוטומטי. אם תשאיר ריק, לא יווצרו קורסים.';
$string['pluginname'] = 'מסד נתונים חיצוני';
$string['pluginname_desc'] = 'תוכל להשתמש במסד נתונים חיצוני ( כמעט כל סוג) לשלוט על הרשמות שלך. יש הנחה כי מסד הנתונים החיצוני שלך מכיל לפחות את השדות : id  של קורס, id של משתמש.
אם מושווים אל מול שדות שתבחר בקורס המקומי ובטבלאות המשתמש.';
$string['remotecoursefield'] = 'שם השדה בטבלה החיצונית בו אנו משתמשים כדי להתאים רשומות בטבלת הקורס';
$string['remotecoursefield_desc'] = 'שם השדה בטבלה המרוחקת שאנו משתמשים להתאמת ערכים בטבלת הקורס.';
$string['remoteenroltable'] = 'טבלת רישום משתמש מרוחק';
$string['remoteenroltable_desc'] = 'ציין את שם הטבלה שמכילה רשימת משתמשים רשומים. ריק, משמע כי אין סנכרון משתמשים רשומים';
$string['remoterolefield'] = 'שם השדה בטבלה החיצונית בו אנו משתמשים כדי להתאים רשומות בטבלת התפקידים';
$string['remoterolefield_desc'] = 'שם השדה בטבלה המרוחקת שאנו משתמשים להתאימה לערכים בטבלת ההרשאות';
$string['remoteuserfield'] = 'שם השדה בטבלה החיצונית בו אנו משתמשים כדי להתאים רשומות בטבלת המשתמשים';
$string['remoteuserfield_desc'] = 'שם השדה בטבלה המרוחקת שאנו משתמשים להתאימה לערכים בטבלת המשתמשים';
$string['settingsheaderdb'] = 'חיבור מסד נתונים חיצוני';
$string['settingsheaderlocal'] = 'מיפוי שדה מקומי';
$string['settingsheadernewcourses'] = 'יצירת קורסים חדשים';
$string['settingsheaderremote'] = 'סנכרון רישום מרוחק';
$string['templatecourse'] = 'תבנית קורס חדשה';
$string['templatecourse_desc'] = 'ניתן לבחירה: יצירה אוטומטית של קורסים שיכולים להעתיק את ההגדרות שלהם לקורס תבנית. ציין כאן את השם המוצר (shortname ) של קורס התבנית';
