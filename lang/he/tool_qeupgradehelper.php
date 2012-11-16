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
 * Strings for component 'tool_qeupgradehelper', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_qeupgradehelper
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'פעולה';
$string['alreadydone'] = 'הכל כבר הומר';
$string['areyousure'] = 'האם אתה בטוח?';
$string['areyousuremessage'] = 'האם ברצונך להמשיך עם השדרוג של כל
{$a->numtoconvert}
נסיונות המענה של הבוחן
\'{$a->name}\' בקורס
{$a->shortname}?';
$string['areyousureresetmessage'] = 'לבוחן \'{$a->name}\' בקורס
{$a->shortname}
קיימים
{$a->totalattempts}
נסיונות מענה, שכל
{$a->convertedattempts} שודרג מהגרסה הישנה.
ניתן לאפס את נסיונות המענה - {$a->resettableattempts} .
האם ברצונך להמשיך עם זה?';
$string['attemptstoconvert'] = 'נסיונות מצריכים המרה';
$string['backtoindex'] = 'בחזרה לעמוד הראשי';
$string['conversioncomplete'] = 'המרה הסתיימה';
$string['convertattempts'] = 'המרת נסיונות';
$string['convertedattempts'] = 'נסיונות שהומרו';
$string['convertquiz'] = 'המרת נסיונות...';
$string['cronenabled'] = 'Cron מאופשר';
$string['cronprocesingtime'] = 'תהליך הזמן שרץ כל cron';
$string['cronsetup'] = 'הגדרות cron';
$string['cronsetup_desc'] = 'ניתן להגדיר את ה-cron  בכדי להשלים את השדרוג של נתוני נסיון מענה הבוחן האוטומטי.';
$string['cronstarthour'] = 'שעת התחלה';
$string['cronstophour'] = 'שעת סיום';
$string['extracttestcase'] = 'חילוץ מקרה נסיון';
$string['extracttestcase_desc'] = 'השתמש בנתוני דגמה ממסד הנתונים בכדי לעזור ליצור יחידות נסיון שיוכלו לשמש לנסיון השדרוג.';
$string['gotoindex'] = 'בחזרה לרשימת הבחנים שניתן לשדרג';
$string['gotoquizreport'] = 'גש לדוחות עבור בוחן זה, בכדי לבדוק את השדרוג';
$string['gotoresetlink'] = 'גש לרשימת הבחנים שניתן לאפס אותם';
$string['includedintheupgrade'] = 'האם לכלול בשדרוג?';
$string['invalidquizid'] = 'מספר id של הבוחן שגוי. כנראה שהבוחן לא קיים או שאין בו נסיונות מענה להמרה.';
$string['listpreupgrade'] = 'רשימת בחנים ונסיונות מענה';
$string['listpreupgrade_desc'] = 'הדבר יציג דוח של כל הבחנים במערכת ואת כמות  נסיונות המענה . הדבר יתן לך פרספקטיבה של היקף השדרוג שאתה עומד לעשות.';
$string['listpreupgradeintro'] = 'זהו מספר נסיונות המענה של הבוחן שיש להמשיך בתהליך כאשר משדרגים את האתר. כמה עשרות אלפים יעברו ללא דאגה, מעלה מספרים אלו יתכן והשדרוג יקח הרבה זמן מהצפוי.';
$string['listtodo'] = 'רשימת הבחנים שעדיין יש לשדרג';
$string['listtodo_desc'] = 'הדבר יציג דוח של כל הבחנים במערכת (אם קיימים) שכמה נסיונות מענה עדיין צריכים להיות משודרגים למנוע השאלות החדש.';
$string['listtodointro'] = 'אלו כל הבחנים עם הנתונים של נסיונות המענה שעדיין מצריכים המרה. ניתן להמיר אותם על-ידי לחיצה על הקישור.';
$string['listupgraded'] = 'ברשימה בחנים ששודרגו וניתן לאפס אותם';
$string['listupgraded_desc'] = 'הדבר יציג דוח של כל הבחנים במערכת שנסיון המענה שלהם כבר שודרג, כארש הנתונים הישנים מוצגים כך שהשדרוג יכול להיות מאופס ולתבסס.';
$string['listupgradedintro'] = 'אלו כל הבחנים שלהם נסיונות מענה משודרגים, כאשר הנתונים של נסיונות המענה הישנים גם שם, כך שניתן לאפס אותם , והשדרוג יעשה מחדש.';
$string['noquizattempts'] = 'אין באתר שלך אף נסיונות מענה לבוחן!';
$string['nothingupgradedyet'] = 'אין נסיונות מענה משודרגים שניתן לאפס';
$string['notupgradedsiterequired'] = 'תסריט זה יכול לעבוד לפני שאתר זה שודרג';
$string['numberofattempts'] = 'מספר נסיונות מענה הבוחן';
$string['oldsitedetected'] = 'אתר זה נראה כאתר שעדיין לא שודרג בכדי  לכלול בתוכו  את מנגנון מנוע השאלות החדש.';
$string['outof'] = '{$a->some} מתוך {$a->total}';
$string['pluginname'] = 'עזרה בנוגע לשדרוג מנגנון מנוע השאלות';
$string['pretendupgrade'] = 'בצע נסיונות ריצה של נסיונות מענה  של השדרוג';
$string['pretendupgrade_desc'] = 'שדרוג זה מבצע שלושה דברים:
טעינת הנתונים הקיימים ממסד הנתונים;
מעביר אותם;
וכותב את מידע הנתונים המועבר למסד הנתונים ;
התסריט הזה יבחן את שני החלקים הראשונים של התהליך.';
$string['questionsessions'] = 'Question sessions';
$string['quizid'] = 'מספר זיהוי Quiz id';
$string['quizupgrade'] = 'מצב השדרוג של הבוחן';
$string['quizzesthatcanbereset'] = 'הבחנים הבאים המירו את נסיונות המענה שתוכל לאפס.';
$string['quizzestobeupgraded'] = 'כל הבחנים עם נסיונות המענה';
$string['quizzeswithunconverted'] = 'לבחנים הבאים  ישנם נסיונות מענה שיש להמיר אותם.';
$string['resetcomplete'] = 'איפוס הסתיים';
$string['resetquiz'] = 'אפס את נסיונות המענה...';
$string['resettingquizattempts'] = 'איפוס נסיונות מענה הבוחן';
$string['resettingquizattemptsprogress'] = 'איפוס נסיון מענה {$a->done} / {$a->outof}';
$string['upgradedsitedetected'] = 'הדבר נראה כאתר ששודרג כדי לכלול את מנוע שאלה חדש.';
$string['upgradedsiterequired'] = 'תסריט זה יכול לעבוד רק לאחר שהאתר שודרג.';
$string['upgradingquizattempts'] = 'משדרג את נסיונות המענה של הבוחן
\'{$a->name}\' בקורס {$a->shortname}';
$string['veryoldattemtps'] = 'יש לאתר שלך {$a} נסיונות מענה לבוחן שמעולם לא עודכנו עד סופן במהלך שדרוג
Moodle 1.4 לגרסת Moodle 1.5.
נסיונות אלו יתבטאו לפני השדרגו הראשי. עליך להקדיש זמן מסויים לדרישה זו.';
