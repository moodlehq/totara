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
 * Strings for component 'auth_shibboleth', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_shibboleth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_shib_auth_method'] = 'שם שיטת האימות';
$string['auth_shib_auth_method_description'] = 'ספק שם לשיטת אימות השיבולת אשר מוכרת למשתמשים שלך.
אפשר לספק את שם פדרציית השיבולת שלך
לדוגמא: <tt>SWITCHaai Login</tt> או <tt>InCommon Login</tt> או דומה.';
$string['auth_shib_changepasswordurl'] = 'תובת URL לשינוי סיסמה';
$string['auth_shib_convert_data'] = 'התאמת נתוני API';
$string['auth_shib_convert_data_description'] = 'ניתן להשתמש ב-API זה בכדי להתאים את הנתונים שסופקו על ידי שיבולת. קרא את: <a href="../auth/shibboleth/README.txt" target="_blank">README</a> להוראות נוספות.';
$string['auth_shib_convert_data_warning'] = 'הקובץ אינו קיים, או שאינו קריא על ידי תהליך שרת הרשת!';
$string['auth_shib_idp_list'] = 'זהות הספקים';
$string['auth_shib_idp_list_description'] = 'ספק רשימה של
Identity Provider entityIDs
בכדי לתת למשתמש אפשרות לבחור מעמוד ההתחברות. .<br />
לכל שורה חייב להיות הפרדת משתנים comma-separated עבור  entityID של ה-IdP (ראה קובץ ה-metadata של השיבולת) ושם של ה-IdP כמו שהוא אמור להופיע בתפריט הנפתח. <br /> כאפשרות שלישית תוכל להוסיף את מיקום יוזם  מושב (session) של השיבולת
אשר ישתמש במקרה שהתקנת ה-Moodle שלך היא חלק מהגדרת מספר פדרציות.';
$string['auth_shib_instructions'] = 'השתמשו <a href="{$a}">התחברות שיבולת</a> כדי להתחבר דרך שיבולת, אם המוסד שלכם תומך בזה. <br />
אחרת השתמשו בטופס ההתחברות הרגיל שמוצג פה.';
$string['auth_shib_instructions_help'] = 'כאן עליכם לספק למשתמשים שלכם הוראות הפעלה שהתאמתם אישית כדי להסביר את שיבולת. הוראות אלה יופיעו בעמוד ההתחברות, בקטע ההוראות. על ההוראות להכיל קישור ל"**{$a}**" עליו ילחצו המשתמשים כשהם ירצו להתחבר.';
$string['auth_shib_integrated_wayf'] = 'שירות Moodle WAYF';
$string['auth_shib_integrated_wayf_description'] = 'אם תסמן כאן , Moodle ישתמש בשירות ה WAYF שלו במקום זה שמוגדר מהשיבולת.
Moodle יציג בתפריט הנפתח בעמוד התחברות אלטרנטיבית זו  שהמשתמש הצטרך לבחור את זהות הספק שלו.';
$string['auth_shib_logout_return_url'] = 'כתובת יציאת URL אלטרנטיבית לחזרה';
$string['auth_shib_logout_return_url_description'] = 'ספק את כתובת ה-URL אשר משתמשי שיבולת ינותבו חזרה לאחר יציאה מהמערכת.
<br />
אם תשאיר ריק, השמתמשים ינותבו חזרה למיקום אשר Moodle יחליט לנתב';
$string['auth_shib_logout_url'] = 'Shibboleth Service Provider logout handler URL';
$string['auth_shib_logout_url_description'] = 'ספק את כתובת ה-URL עבור
Shibboleth Service Provider logout handler. בדרך-כלל זה
<tt>/Shibboleth.sso/Logout</tt>';
$string['auth_shib_no_organizations_warning'] = 'אם תרצה להשתמש בשרות WAYF משולב, תצטרך לספק רשימת ספקי זהוי entityIDs המופרדים בפסיק, שמותיהם ובתור אפשרות מושב התחלה.';
$string['auth_shib_only'] = 'שיבולת בלבד';
$string['auth_shib_only_description'] = 'ביחרו באפשרות זו אם אתם מעוניינים לאכוף אימות של שיבולת.';
$string['auth_shib_username_description'] = 'שם משתנה סביבת שיבולת בשרת רשת בו שישמש כשם משתמש במוודל.';
$string['auth_shibboleth_contact_administrator'] = 'במקרה ואינך שותף עם הארגונים שניתנו והינך זקוק לגישה לקורס בשרות זה, אנא צור קשר עם';
$string['auth_shibboleth_errormsg'] = 'אנא בחר את הארגון שאתה חבר בו!';
$string['auth_shibboleth_login'] = 'התחברות דרך שיבולת';
$string['auth_shibboleth_login_long'] = 'התחברות ל-Moodle דרך שיבולת';
$string['auth_shibboleth_manual_login'] = 'התחברות ידנית';
$string['auth_shibboleth_select_member'] = 'אני חבר ב...';
$string['auth_shibboleth_select_organization'] = 'לאימות דרך שיבולת אנא בחר את הארגון לו אתה שייך מתפריט הנפתח.';
$string['auth_shibbolethdescription'] = 'באמצעות שיטה זו משתמשים נוצרים ומאומתים על ידי שימוש ב<a ref="http://shibboleth.internet2.edu/" target="_blank">שיבולת</a>.<br>קיראו את קובץ ה<a href="../auth/shibboleth/README.txt" target="_blank">README</a> של שיבולת, שמסביר כיצד עליכם להגדיר את המוודל שלכם עם שיבולת.';
$string['pluginname'] = 'שיבולת';
$string['shib_no_attributes_error'] = 'נראה כי אתה מאומת באמצעות שיבולת, אבל מוודל לא קיבל כל תכונות משתמש שהן. אנא וודא שמספק הזהות שלך משחרר את התכונות הדרושות ({$a}) למספק השרות שמוודל מריץ או שידע את מנהל הרשת של שרת זה.';
$string['shib_not_all_attributes_error'] = 'למוודל דרושות תכונות מסויימות של שיבולת, שבמקרה שלך, לא נמצאות. התכונות הן: {$a}<br />אנא צור קשר על מנהל הרשת של השרת או עם ספק הזהות שלך.';
$string['shib_not_set_up_error'] = 'לא נראה כי אימות שיבולת מוגדר נכונה זאת מפני ששם משתני סביבת שיבולת לא נוכחים בעמוד זה. אנא התייעץ ב-<a href="README.txt">README</a> על מנת לקבל הוראות נוספות על איך יש להגדיר את האימות דרך שיבולת, או צור קשר עם מנהל הרשת של התקנת מוודל זו.';
