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
 * Strings for component 'qtype_numerical', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_numerical
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['acceptederror'] = 'התקבלה שגיאה';
$string['addmoreanswerblanks'] = 'מסיחים עבור {no} תשובות נוספות';
$string['addmoreunitblanks'] = 'מסיחים עבור {no} יחידות נוספות';
$string['answermustbenumberorstar'] = 'חובה שהתשובה תהיה מספר,לדוגמה -1.234 or 3e8, or \'*\'.';
$string['answerno'] = 'תשובה {$a}';
$string['decfractionofquestiongrade'] = 'כשבר עשרוני (0-1) של ציון השאלה';
$string['decfractionofresponsegrade'] = 'כשבר עשרוני (0-1) של ציון המענה';
$string['decimalformat'] = 'דצימלי';
$string['editableunittext'] = 'פריט קלט של טקסט';
$string['errornomultiplier'] = 'עלייך לפרט אמת-מידה עבור יחידה זו.';
$string['errorrepeatedunit'] = 'אינך יכול שיהיו לך שתי יחידות בעלות אותו השם.';
$string['geometric'] = 'גאומטרי';
$string['invalidnumber'] = 'עליך להכניס מספר חוקי';
$string['invalidnumbernounit'] = 'עליך להכניס מספר חוקי. אין להכליל יחידה במענה שלך';
$string['invalidnumericanswer'] = 'אחת מתשובותיך  שהכנסת היה מספר לא חוקי.';
$string['invalidnumerictolerance'] = 'אחד ממרווחי הסבילות שהכנסת לא היה מספר תקף';
$string['leftexample'] = 'בצד שמאל לדוגמה: כ- $1.00  או £1.00';
$string['manynumerical'] = 'יחידות הן בחירה. אם יחידה מוזנת, היא משומשת להמרת המענה ליחידה 1 לפני מתן הציון';
$string['multiplier'] = 'אמת-מידה';
$string['nominal'] = 'נומינלי';
$string['noneditableunittext'] = 'יחידה לא ברת עריכה של יחידה מס. 1';
$string['nonvalidcharactersinnumber'] = 'אין תווים תקפים במספר';
$string['notenoughanswers'] = 'חובה עלייך להקליד לפחות תשובה אחת.';
$string['nounitdisplay'] = 'אין ציון יחידה';
$string['numericalmultiplier'] = 'אמת-מידה';
$string['numericalmultiplier_help'] = 'אמת-המידה הוא הגורם שבו תוכפל התשובה המספרית הנכונה.
ליחידה הראשונה (יחידה 1) יש אמת-מידה שערך ברירת המחדל שלו היא 1. לכן אם התשובה המבפרית הנכונה היא 5500 ותגדיר את W כיחידה 1 שיש לב מכפיל שבררת המחדל שלו היא 1, התשובה תהיה 5500W.
אם תוסיף לזאת יחידה kW עם אמת-מידה 0.001, זה יוסיף תשובה נכונה של 5.5kW. כלומר התשובות 5500W ו-5.5kW תהינה נכונות.
יש לשים לב כי גם השגיאה המקובל עדיין מוכפלת, כך ששגיאה מותרת של 100W תהיה שגיאה של 0.1kW.';
$string['oneunitshown'] = 'ינתן ציון לתשובה מספרית בלבד, יחידה 1 תוצג';
$string['onlynumerical'] = 'אין שימוש ביחידות. רק הערך המספרי ניתן כציון.';
$string['pleaseenterananswer'] = 'אנא הכנס תשובה.';
$string['pleaseenteranswerwithoutthousandssep'] = 'אנא הכנס תשובה ללא שימוש במפריד האלף ({$a}).';
$string['pluginname'] = 'מספרי';
$string['pluginname_help'] = 'מנקודת המבט של הסטודנט, שאלה מספרית נראית בדיוק כמו שאלה מסוג תשובה-קצרה. ההבדל נעוץ בכך שלתשובות המספריות מותרת שגיאה בגודל מוסכם. דבר זה מאפשר לתחום של שאלות להיות מוערכות כאילו היו שאלה אחת. למשל: אם התשובה היא 10 והשגיאה המוסכמת היא 2, אזי כל ערך בין 8 ו-12 יתקבל כנכון.';
$string['pluginnameadding'] = 'הוספת שאלה מספרית';
$string['pluginnameediting'] = 'עריכת שאלה מספרית';
$string['pluginnamesummary'] = 'הרשה תשובה מספרית, אולי עם יחידות, המדורגת על ידי השוואה למבנים שונים של תשובות, אולי עם
מרווח סבילות.';
$string['relative'] = 'יחסי';
$string['rightexample'] = 'בצד ימין , לדוגמה כ- 1.00cm או  1.00km';
$string['selectunit'] = 'בחר יחידה אחת';
$string['selectunits'] = 'בחר יחידות';
$string['studentunitanswer'] = 'יחידות תשובה מוצגת כ-';
$string['tolerancetype'] = 'סוג מרווח סבילות';
$string['unit'] = 'יחידה';
$string['unitappliedpenalty'] = 'הציונים כוללים קנס בשיעור של {$a} לכל יחידה גרועה.';
$string['unitchoice'] = 'בחירה של רב-ברירה';
$string['unitedit'] = 'סוף יחידה';
$string['unitgraded'] = 'יש לספק יחידה, ולאחר מכן ינתן ציון.';
$string['unithandling'] = 'יחידה תטופל';
$string['unithdr'] = 'משתנה {$a}';
$string['unitincorrect'] = 'לא ניתנה היחידה הנכונה.';
$string['unitmandatory'] = 'הכרחי';
$string['unitmandatory_help'] = '* ינתן ציון לתגובה על-ידי שימוש בכתיבת היחידה
* קנס היחידה יהיה בתוקף אם שדה היחידה יהיה ריק';
$string['unitnotselected'] = 'לא נבחרה אף יחידה';
$string['unitonerequired'] = 'יש לבחור לפחות יחידה אחת';
$string['unitoptional'] = 'יחידה אופציונלית';
$string['unitoptional_help'] = '* אם שדה היחידה לא ריק, התגובה תינתן כציון בשימוש ביחידה זו.
* אם היחידה כתובה בצורה לא תקינה או שאינה ידועה, התגובה תחשב כלא תקפה';
$string['unitpenalty'] = 'הקנס ליחידה';
$string['unitpenalty_help'] = 'הקנס מיושם כאשר
* כששם יחידה שאיננו מוגדר מוכנס לאלמנט תשובת היחידה או
*כאשר שם היחידה מוכנס לאלמנט תשובת המספר';
$string['unitposition'] = 'מיקום היחידה';
$string['unitselect'] = 'תפריט אפשרויות';
$string['validnumberformats'] = 'מבני מספרים תקפים';
$string['validnumberformats_help'] = '* regular numbers 13500.67 : 13 500.67 : 13500,67: 13 500,67
* if you use , as thousand separator \*always\* put the decimal . as in 13,500.67 : 13,500.
* for exponent form, say 1.350067 * 10<sup>4</sup>, use 1.350067 E4 : 1.350067 E04';
$string['validnumbers'] = '13500.67, 13 500.67, 13,500.67, 13500,67, 13 500,67, 1.350067 E4 or 1.350067 E04';
