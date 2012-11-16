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
 * Strings for component 'enrol_mnet', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['error_multiplehost'] = 'מופעים מסויימים של תוסף רישום MNET כבר קיימיםעבור מארח זה. רק מופע אחד עבור מאחר ואו מופע אחד לכל המארחים מאופשר.';
$string['instancename'] = 'שם שיטת הרישום';
$string['instancename_help'] = 'ניתן לשנות את השם של מופע שיטת רישום MNET זה באופן ידני.
אם נשאיר את שדה זה ריק, ערך ברירת המחדל של מופע זה יבוא לידי שימוש אשר יכיל את שם מחשב המארח המרוחק ואת התפקיד שמוקצה למשתמשים שלו.';
$string['mnet_enrol_description'] = 'פרסם את השירות הזה על מנת לאפשר למנהלים ב- {$a} לרשום את הסטודנטים שלהם
לקורסים שיצרת על השרת שלך. <br/><ul><li><em>תלות</em>:בנוסף, חובה עליך
<strong>לפרסם </strong> את השירות SSO (מספק השירות) ל {$a}.

</li><li><em>תלות</em>:
בנוסף, חובה עליך <strong>להירשם</strong> לשירות ה-SSO (מספק הזהות) על {$a}.</li></ul><br/>הירשם לשירות זה כדי שתוכל לרשום את הסטודנטים שלך לקורסים שנמצאים ב-{$a}
.<br/><ul><li><em>תלות</em>:
בנוסף, חובה עליך <strong>להירשם</strong> לשירות SSO (מספק השירות) ב-{$a}.</li><li><em>תלות</em>:

בנוסף, חובה עליך <strong>לפרסם</strong> את שירות ה-SSO (מספק הזהות) ל-{$a}.</li></ul><br/>';
$string['mnet_enrol_name'] = 'הרשמה מרושתת למוודל';
$string['pluginname'] = 'הרשמות MNET מרוחק';
$string['pluginname_desc'] = 'אפשר מארחי MNET מרוחקים להרשום את המשתמשים שלהם לקורסים שלנו';
$string['remotesubscriber'] = 'מארח מרוחק';
$string['remotesubscriber_help'] = 'בחרו בכל השרתים המארחים בכדי לפתוח קורס לכול שרתי ה- MNet אשר אנו מציעים לשרות הרשמה מרוחקת. או בחרו בשרת מרוחק בודד בכדי לאפשר זמינות קורס זה למשתמשים בלבד.';
$string['remotesubscribersall'] = 'כל המארחים';
$string['roleforremoteusers'] = 'תפקיד למשתמשים שלהם';
$string['roleforremoteusers_help'] = 'איזה תפקיד המשתמשים המרוחקים מהמארחים שנבחרו יתקבלו';
