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
 * Strings for component 'tool_unittest', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_unittest
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addconfigprefix'] = 'הוסף תחילית לקובץ ההגדרות (config)';
$string['all'] = 'הכל';
$string['codecoverageanalysis'] = 'ביצוע ניתוח כיסוי לקוד';
$string['codecoveragecompletereport'] = '(הצגת דוח השלמת כיסוי הקוד)';
$string['codecoveragedisabled'] = 'לא ניתן לאפשר כיסוי קוד בשרת זה (חסרה הרחבת xdebug )';
$string['codecoveragelatestdetails'] = 'בתאריך {$a->date}, עם קובצ(ים)  {$a->files} אשר כוסו {$a->percentage}';
$string['codecoveragelatestreport'] = 'הצגת דוח השלמת כיסוי הקוד האחרונה';
$string['confignonwritable'] = 'קובץ ה config.php. לא ניתן לכתיבה על-ידי השרת שלך. נא שנה את ההרשאות של הקובץ או ערוך אותו עם הרשאות  חשבון משתמש מתאימות והוסף את השורה הבאה לפני תג ה-PHP הסוגר:

$CFG->unittestprefix = \'tst_\' // Change tst_ to a prefix of your choice, different from $CFG->prefix';
$string['coveredlines'] = 'קווים מכוסים';
$string['coveredpercentage'] = 'סך-כל כיסוי הקוד';
$string['dbtest'] = 'ניסיונות פונקציונליות במסד הנתונים';
$string['deletingnoninsertedrecord'] = 'נסיון למחוק רשומה אשר הוכנסה על-ידי מבחני יחידה אלו (id {$a->id} בטבלה  {$a->table}';
$string['deletingnoninsertedrecords'] = 'נסיון למחוק רשומות אשר לא היו מעניינות מבחני יחידה אלו
(מטבלאה אלו{$a->table} )';
$string['droptesttables'] = 'השמטת טבלאות מבחנים';
$string['exception'] = 'הודעת שגיאה חריגה';
$string['executablelines'] = 'שורות הרצה';
$string['fail'] = 'נכשל';
$string['ignorefile'] = 'התעלם מהמבחנים בקובץ';
$string['ignorethisfile'] = 'הרץ מחדש את המבחנים תוך כדי התעלמות מקובץ מבחנים זה.';
$string['installtesttables'] = 'התקנת טבלאות מבחן';
$string['moodleunittests'] = 'מבחני יחידת Moodle: {$a}';
$string['notice'] = 'הודעה';
$string['onlytest'] = 'הרץ מבחנים רק ב-';
$string['othertestpages'] = 'עמודי נסיון נוספים';
$string['pass'] = 'עובר';
$string['pathdoesnotexist'] = 'נתיב  \'{$a}\'  אינו קיים.';
$string['pluginname'] = 'בדיקות יחידה';
$string['prefix'] = 'יחידת תחילית טבלאות מבחן';
$string['prefixnotset'] = 'תחילית טבלת מסד הנתונים של מבחן היחידה לא מוגדרת. מלא ושלח את טופס זה בכדי להוסיף את הפרטים לקובץ ה  config.php.';
$string['reinstalltesttables'] = 'התקן מחדש טבלאות מבחן';
$string['retest'] = 'הרץ מחדש את המבחנים.';
$string['retestonlythisfile'] = 'הרץ מחדש רק את קובץ מבחנים זה.';
$string['runall'] = 'הרץ את המבחנים מכל קבצי המבחנים.';
$string['runat'] = 'הרץ ב- {$a}.';
$string['runonlyfile'] = 'הרץ את המבחנים בקובץ זה בלבד.';
$string['runonlyfolder'] = 'הרץ את המבחנים בתיקייה זו בלבד.';
$string['runtests'] = 'הרץ מבחנים';
$string['rununittests'] = 'הרץ את מבחני היחידה.';
$string['showpasses'] = 'הצג את הציונים העוברים בנוסף לציונים הנכשלים.';
$string['showsearch'] = 'הראה את החיפוש עבור קבצי המבחנים.';
$string['skip'] = 'דלג';
$string['stacktrace'] = 'מחסנית מעקב';
$string['summary'] = '{$a->run}/{$a->total} מקרי מבחן הושלמו: <strong>{$a->passes}</strong> עובר, <strong>{$a->fails}</strong> נכשל ו<strong>{$a->exceptions}</strong> יוצאים מן הכלל.';
$string['tablesnotsetup'] = 'טבלאות מבחן יחידה לא נבנו עדיין. האם תרצה לבנות אותם?';
$string['testdboperations'] = 'בחן פעולות מסד נתונים';
$string['testtablescsvfileunwritable'] = 'טבלאות המבחן מקובץ ה-CSV לא ניתנות לכתיבה ({$a->filename})';
$string['testtablesneedupgrade'] = 'יש צורך לשדרג את טבלאות מסד הנתונים של המבחן. האם תרצה להמשיך בתהליך זה של שדרוג?';
$string['testtablesok'] = 'תבלאות מסד הנתונים של המבחן הותקנו בהצלחה.';
$string['thorough'] = 'הרץ מבחן יסודי (יכול להיות איטי).';
$string['timetakes'] = 'הזמן שלקח : {$a}';
$string['totallines'] = 'סך-כל שורות';
$string['uncaughtexception'] = 'שגיאה חריגה שלא נתפסה [{$a->getMessage()}] ב- [{$a->getFile()}:{$a->getLine()}] מבחנים הופסקו.';
$string['uncoveredlines'] = 'שורות חשופות';
$string['unittest:execute'] = 'בצע נסיונות יחידה';
$string['unittestprefixsetting'] = 'תחילית מבחן יחידה: <strong>{$a->unittestprefix}</strong>
(נא לעדכן את קובץ  config.php בכדי לשנות זאת)';
$string['unittests'] = 'מבחני יחידה';
$string['updatingnoninsertedrecord'] = 'נסיון לעדכן רשומה אשר לא הוכנסה על-ידי מבחני יחידה אלו
(מספר זהות  {$a->id} בטבלה {$a->table}).';
$string['version'] = 'השתמש בגירסת <a href="http://sourceforge.net/projects/simpletest/">SimpleTest</a> {$a}.';
