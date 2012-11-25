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
 * Strings for component 'quiz_statistics', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   quiz_statistics
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actualresponse'] = 'תגובות ממשיות';
$string['allattempts'] = 'כל נסיונות המענה';
$string['allattemptsavg'] = 'ציון ממוצע של כל נסיונות המענה';
$string['allattemptscount'] = 'המספר הכולל של ניסיונות המענה';
$string['analysisofresponses'] = 'ניתוח התשובות';
$string['analysisofresponsesfor'] = 'ניתול התשובות בעבור {$a}.';
$string['attempts'] = 'נסיונות מענה';
$string['attemptsall'] = 'כל נסיונות המענה';
$string['attemptsfirst'] = 'נסיון ראשון';
$string['backtoquizreport'] = 'בחזרה לדף הראשי של הדוח הסטטיסטי.';
$string['calculatefrom'] = 'חשב';
$string['cic'] = 'מקדם היציבות הפנימית (עבור {$a})';
$string['completestatsfilename'] = 'completestats';
$string['count'] = 'ספירה';
$string['coursename'] = 'שם הקורס';
$string['detailedanalysis'] = 'ניתוח יותר מפורט של התשובות לשאלה זאת';
$string['discrimination_index'] = 'מקדם ההבחנה';
$string['discriminative_efficiency'] = 'יעילות ההבחנה';
$string['downloadeverything'] = 'הורד את הדוח המלא כ-';
$string['duration'] = 'פתח עבור';
$string['effective_weight'] = 'משקל יעיל';
$string['errordeleting'] = 'שגיאה במחיקת {$a} רשומות ישנות';
$string['erroritemappearsmorethanoncewithdifferentweight'] = 'שאלה ({$a}) מופיעה יותר מפעם אחת עם משקלות שונים במקומות שונים של המבחן. מצב זה לא נתמך בדוח הסטטיסטי ויכול לגרום לכך שהתשובות הסטטיסטיות לשאלה אינן אמינות.';
$string['errormedian'] = 'שגיאה בשליפת החציון';
$string['errorpowerquestions'] = 'שגיאה בשליפת הנתונים לחישוב השונות לציוניי השאלה';
$string['errorpowers'] = 'שגיאה בשליפת הנתונים לחישוב השונות לציוניי הבוחן';
$string['errorrandom'] = 'שגיאה בעת קבלת נתונים';
$string['errorratio'] = 'יחס השגיאה עבור ({$a';
$string['errorstatisticsquestions'] = 'שגיאה בשליפת הנתונים לחישוב הנתונים הסטטיסטים של ציוניי השאלה.';
$string['facility'] = 'אינדקס הביצוע';
$string['firstattempts'] = 'נסיונות מענה ראשונים';
$string['firstattemptsavg'] = 'ציון ממוצע של נסיונות המענה הראשונים';
$string['firstattemptscount'] = 'מספר נסיונות המענה הראשונים';
$string['frequency'] = 'תדירות';
$string['intended_weight'] = 'משקל מיועד';
$string['kurtosis'] = 'התפלגות התוצאה של הגבנוניות (עבור{$a})';
$string['lastcalculated'] = 'חושב לאחרונה {$a->lastcalculated} ומאז היו {$a->count}  נסיונות';
$string['median'] = 'ציון החציון עבור ({$a})';
$string['modelresponse'] = 'מודל תגובה';
$string['negcovar'] = 'שונות משותפת שלילית של הציון עם ציון הנביון הכוללני';
$string['negcovar_help'] = 'הציון לשאלה זאת לקבוצת הנסיונות בבוחן משתנה בצורה הפוכה לציון הכוללני של הנסיונות. פרוש הדבר הוא כי ציון הנסיונות הכוללני נוטה להיות מתחת לממוצע כאשר הציון לשאלה זאת הוא מעל הממוצע, וכן קיים המצב ההפוך.
הנוסחה שלנו למשקל היעיל של השאלה לא ניתן לחישוב במקרה זה. החישובים למשקל היעיל של השאלה עבור שאלות אחרות בבוחן זה הם המשקל היעיל של שאלות אלו אם השאלות המודגשות עם השונות המשותפת השלילית מקבלות ציון מירבי של אפס.
אם תערוך בוחן ותעניק לשאלות עם השונות המשותפת השלילית ציון מירבי של אפס אזי המשקל היעיל של שאלות אלו יהיה אפס ווהמשקל היעיל האמיתי של השאלות האחרות יהיה כמחושב עתה.';
$string['nostudentsingroup'] = 'אין עדייו סטודנטים בקבוצה זאת';
$string['optiongrade'] = 'אשראי חלקי';
$string['pluginname'] = 'סטטיסטיקות';
$string['position'] = 'מצב';
$string['positions'] = 'מצבים';
$string['questioninformation'] = 'מידע על השאלה';
$string['questionname'] = 'שם השאלה';
$string['questionnumber'] = 'Q#';
$string['questionstatistics'] = 'תוצאות סטטיסטיות לשאלה';
$string['questionstatsfilename'] = 'questionstats';
$string['questiontype'] = 'סוג השאלה';
$string['quizinformation'] = 'מידע על הבוחן';
$string['quizname'] = 'שם הבוחן';
$string['quizoverallstatistics'] = 'תוצאות סטטיסטיות כוללבניות לבוחן';
$string['quizstructureanalysis'] = 'ניתוח מבנה הבוחן';
$string['random_guess_score'] = 'תוצאת הניחוש האקראי';
$string['recalculatenow'] = 'חשב מחדש עתה';
$string['response'] = 'תשובה (תגובה)';
$string['skewness'] = 'תוצאת צידוד ההתפלגות עבור ({$a})';
$string['standarddeviation'] = 'סטיית תקן בעבור ({$a})';
$string['standarddeviationq'] = 'סטיית תקן';
$string['standarderror'] = 'שגיאת התקן עבור ({$a})';
$string['statistics'] = 'תוצאות סטטיסטיות';
$string['statistics:componentname'] = 'דוח תוצאות סטטיסטיות של הבוחן';
$string['statistics:view'] = 'צפה בדוחות הסטטיסטים';
$string['statisticsreport'] = 'דוח סטטיסטי';
$string['statisticsreportgraph'] = 'תוצאות סטטיסטיות למיקומי השאלות';
$string['statsfor'] = 'תוצאות סטטיסטיות של בוחן ({$a})';
