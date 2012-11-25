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
 * Strings for component 'auth_mnet', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_mnet_auto_add_remote_users'] = 'כשמוגדרת כ-\'כן\', רשומת משתמש מקומית מוצרת באופן אוטומטי כאשר משתמש חיצוני מתחבר בפעם הראשונה.';
$string['auth_mnet_roamin'] = 'משתמשי המחשב המארח יכולים לשוטט לתוך האתר שלך.';
$string['auth_mnet_roamout'] = 'המשתמשים שלך יכולים לשוטט החוצה לתוך המחשבים המארחים הללו.';
$string['auth_mnet_rpc_negotiation_timeout'] = 'פסק הזמן לאימות על גבי משלוח ה-XMLRPC';
$string['auth_mnetdescription'] = 'משתמשים מאומתים לפי רשת האמון אותה הגדרת בהגדרות רשת המוודל שלך.';
$string['auto_add_remote_users'] = 'הוספה אוטומטית של משתמשים חיצוניים';
$string['pluginname'] = 'אימות רשת ה-Moodle';
$string['rpc_negotiation_timeout'] = 'פסק זמן דו השיח של ה-RPC';
$string['sso_idp_description'] = 'פרסם את השירות הזה כדי לאפשר למשתמשים שלך לשותת באתר המוודל {$a} מבלי שיצטרכו להתחבר שם מחדש. <ul><li><em>תלות</em>: בנוסף, חובה עלייך<strong>להירשם כמנוי</strong> ל-SSO (מספק שירות) service on {$a}.</li></ul><br />הירשם כמנוי לשירות זה כדי לאפשר למשתמשים שעברו אימות מ- {$a}להיכנס לאתר שלך מבלי שיצטרכו להתחבר מחדש. <ul><li><em>תלות</em>: בנוסף, חובה עליך <strong>לפרסם</strong> את שירות ה- SSO (מספק השירות) ל-{$a}.</li></ul><br />';
$string['sso_idp_name'] = 'SSO (מספק זהות)';
$string['sso_mnet_login_refused'] = 'שם משתמש {$a->user} אינו מורשה להתחבר מ-{$a->host}.';
$string['sso_sp_description'] = 'פרסם את השירות הזה כדי לאפשר למשתמשים מ- {$a} שעברו אימות להיכנס לאתר שלך מבלי שיצטרכו להתחבר מחדש. <ul><li><em>תלות</em>: בנוסף, חובה עליך <strong>להירשם</strong> לשירות ה-SSO (מספק זהות) על {$a}.</li></ul><br /> הירשם לשירות הזה כדי לאפשר למשתמשים שלך לשותת באתר המוודל {$a} מבלי שיצטרכו להתחבר שם מחדש. <ul><li><em>תלות</em>: בנוסף, חובה עליך <strong>לפרסם</strong> את שירות ה- SSO (מספק השירות) ל-{$a}.</li></ul><br />';
$string['sso_sp_name'] = 'SSO (מספק שירות)';
