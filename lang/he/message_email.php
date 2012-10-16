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
 * Strings for component 'message_email', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   message_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowusermailcharset'] = 'הרשה בחירת קבוצת תווים';
$string['configallowusermailcharset'] = 'אם תאפשר זאת, כל משתמש באתר יוכל לפרט את קבוצת התווים (charset) שלו עבור הדוא"ל.';
$string['confignoreplyaddress'] = 'דוא"לים לפעמים נשלחים כייצוג של המשתמש (למשל הודעות פורום). כתובת הדוא"ל שתציין כאן ישומש ככתובת "מוען" במקרים כאלה כאשר המקבלים לא יוכלו להשיב ישירות למשתמש ששלח (למשל כאשר המשתמש בוחר לשמור על כתובת הדוא"ל שלו כפרטית).';
$string['configsitemailcharset'] = 'כל כתובות הדוא"ל שיחוללו באתר שלך ישלחו בקבוצת התווים (charset) אשר מצויינת כאן. בכל מקרה כל משתמש בודד יוכל להתאים זאת אם ההגדרה הבאה מאופשרת.';
$string['configsmtphosts'] = 'תן את השם המלא של שרת או שרתי ה SMTP המקומיים אשר Moodle יבחר כדי לשלוח דוא"ל (למשל: \'mail.a.com;mail.b.com\' ). אם תשאיר כאן חלל ריק, Moodle ישתמש בשיטת ברירת המחדל לשליחת דוא"ל של PHP.';
$string['configsmtpmaxbulk'] = 'המספר המירבי של הודעות אשר נשלחות בכל מושב SMTP. הודעות מקובצות יכול להאיץ את שליחת ההודעות. ערך הקטן מ-2 מאלץ יצירת מושב SMTP חדש עבור כל דוא"ל.';
$string['configsmtpuser'] = 'אם ציינת למעלה שרת SMTP, ושרת זה מצריך אימות, אז הקש את שם המשתמש והסיסמה כאן.';
$string['email'] = 'שליחת הודעת דוא"ל ל';
$string['mailnewline'] = 'תווי "Newline" בדוא"ל';
$string['noreplyaddress'] = 'חסרה כתובת חזרה';
$string['pluginname'] = 'דוא"ל';
$string['sitemailcharset'] = 'קבוצת תווים';
$string['smtphosts'] = 'שרתי SMTP';
$string['smtpmaxbulk'] = 'גבול מושב ה-SMTP';
$string['smtppass'] = 'סיסמת SMTP';
$string['smtpuser'] = 'שם משתמש SMTP';
