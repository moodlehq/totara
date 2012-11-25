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
 * Strings for component 'portfolio_mahara', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio_mahara
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['enableleap2a'] = 'אפשר תמיכה בתיק העבודות  Leap2a (דרוש Mahara 1.3)';
$string['err_invalidhost'] = 'מארח mnet לא תקף';
$string['err_invalidhost_help'] = 'תוסף זה הוגדר בצורה שגויה להצביע על מארח mnet לא תקף (או שנמחק). תוסף זה תלוי בעמיתים של תקשורת מוודל עם SSO IDP שפורסמו, מינויים ל SSO_SP ותיק העבודות מנוי **ומפורסם.**';
$string['err_networkingoff'] = 'MNET כבויה';
$string['err_networkingoff_help'] = 'MNET לא מופעלת כלל. אנא הפעל אותה לפני שתנסה להגדיר את תצורת תוסף זה. כל המקרים של התוסף הוצבו כנסתרים מצפיה עד שנושא זה יטופל ואז יהיה עליך להגדירם מחדש, באופן ידני, כברי צפיה. לא ניתן להשתמש בהם עד שכל האמור לעיל יבוצע.';
$string['err_nomnetauth'] = 'תוסף אימות mnet מנוטרל';
$string['err_nomnetauth_help'] = 'תוסף אימות mnet מנוטרל, אולם הוא דורש שרטת זה';
$string['err_nomnethosts'] = 'תלוי ב MNET';
$string['err_nomnethosts_help'] = 'תוסף זה תלוי בעמיתים של MNET עם SSO IDP שפורסמו, מינויים ל SSO_SP ותיק העבודות מנוי **ומפורסם** וכן תוסף האימות של mnet. כל המקרים של התוסף הוצבו כנסתרים מצפיה עד שנושא זה יטופל ואז יהיה עליך להגדירם מחדש, באופן ידני, כברי צפיה. לא ניתן להשתמש בהם עד שכל האמור לעיל יבוצע.';
$string['failedtojump'] = 'נכשלה הפעלת התקשורת עם השרת המרוחק';
$string['failedtoping'] = 'נכשלה הפעלת התקשורת עם השרת המרוחק: {$a}';
$string['mnet_nofile'] = 'שגיאה מוזרה - לא נמצא למצוא את עצם "הקובץ בהעברה"';
$string['mnet_nofilecontents'] = 'נמצא עצם "הקובץ בהעברה" אולם לא ניתן לקבל את תוכנו {$a}';
$string['mnet_noid'] = 'לא ניתן למצוא את רשומת ההעברה עבור אסימון זה';
$string['mnet_notoken'] = 'לא ניתן למצוא אסימון התואם את ההעברה';
$string['mnet_wronghost'] = 'המארח המרוחק לא תואם את רשומת העברה לאסימון זה';
$string['mnethost'] = 'מארח MNet';
$string['pf_description'] = 'מאפשר להעביר תכני מוודל למארח זה <br />בצע מינוי <b> ופרסם </b> את השרות בכדי לאפשר למשתמשים מאומתים באתר שלך להעביר תכנים ל-{$a}
<br />
<ul>
<li>
<em>
תלות: </em> חובה עליך גם <strong>לפרסם</strong> את השרות SSO (לזהות את הספק)
ל-{$a}. </li>
<li>
<em>תלות: </em> כמו כן חובה עליך <em>לבצע מינוי</em> ל-SSO (ספק השרות) על {$a}</li><li><em>
<em>תלות:</em> וכן עליך לאפשר את תוסף אימות mnet.
</li></ul>
<br />';
$string['pf_name'] = 'שרותיי תיק העבודות';
$string['pluginname'] = 'תיק העבודות Mahara';
$string['senddisallowed'] = 'כרגע לא ניתן להעביר את הקבצים למערכת "מההרה"';
$string['url'] = 'URL';
