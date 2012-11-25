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
 * Strings for component 'enrol_ldap', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['autocreate'] = 'ניתן ליצור קורסים באופן אוטומטי אם יש הרשמות לקורס שעדיין לא קיים במוודל.';
$string['autocreate_key'] = 'יצירה אוטומטית';
$string['autocreation_settings'] = 'הגדרות יצירה אוטומטית של קורסים';
$string['bind_dn'] = 'אם ברצונכם להשתמש במשתמש-קשור בשביל לחפש אחר משתמשים,
ציינו זאת כאן. משהו כמו:
\'cn=ldapuser,ou=public,o=org\'';
$string['bind_pw'] = 'סיסמה עבור משתמש-קשור';
$string['bind_pw_key'] = 'סיסמה';
$string['category'] = 'הקטגוריה לקורסים שנוצרו באופן אוטומטי';
$string['category_key'] = 'קטגוריה';
$string['contexts'] = 'הקשרי LDAP';
$string['couldnotfinduser'] = 'לא ניתן למצוא את משתמש \'{$a}\', מדלג.';
$string['course_fullname'] = 'לבחירתכם: שדה LDAP ממנו ניתן להשיג את השם המלא.';
$string['course_fullname_key'] = 'שם מלא';
$string['course_idnumber'] = 'מפה לזיהוי הייחודי ב-LDAP, לרוב:
<em>cn</em> או <em>uid</em>.
מומלץ לנעול את הערך במידה ואתם משתמשים ביצירה אוטומטית של קורסים.';
$string['course_idnumber_key'] = 'מספר זיהוי ID';
$string['course_search_sub'] = 'חיפוש חברויות קבוצה מתוך תתי-הקשר';
$string['course_search_sub_key'] = 'חיפוש תתי הקשר';
$string['course_settings'] = 'הגדרות הרשמה לקורס';
$string['course_shortname'] = 'ניתן לבחירה: שדה LDAP ממנו ניתן להשיג את השם הקצר.';
$string['course_shortname_key'] = 'שם מקוצר';
$string['course_summary'] = 'ניתן לבחירה: שדה LDAP ממנו ניתן להשיג את הסיכום.';
$string['course_summary_key'] = 'Summary';
$string['editlock'] = 'נעל ערך';
$string['enrolname'] = 'LDAP';
$string['extcourseidinvalid'] = 'מספר ה-ID של הקורס לא תקין.';
$string['failed'] = 'נכשל';
$string['general_options'] = 'אפשרויות כלליות';
$string['group_memberofattribute_key'] = '\'Member of\' attribute';
$string['host_url'] = 'ציין את המחשב המארח של LDAP בצורת כתובת URL כמו:
\'ldap://ldap.myorg.com/\'
או \'ldaps://ldap.myorg.com/\'';
$string['host_url_key'] = 'כתובת URL של המארח';
$string['idnumber_attribute_key'] = 'ID number attribute';
$string['ldap:manage'] = 'ניהול LDAP enrol instances';
$string['ldap_encoding_key'] = 'קידוד LDAP';
$string['memberattribute'] = 'תכונת החבר של LDAP';
$string['objectclass'] = 'objectClass בו משתמשים כדי לחפש בקורסים. לרוב:
\'posixGroup\'';
$string['pluginname'] = 'רישומי  LDAP';
$string['pluginname_desc'] = '<p>כדי לשלוט בהירשמויות שלכם אתם יכולים להשתמש בשרת LDAP.
אנו מניחים כי עץ ה-LDAP שלכם מכיל קבוצות שממפות אל עבר הקורסים, ושכל אחתד מהקבוצותקורסים הללו יהיו בעלי רשומות חברות שימפו לסטודנטים.</p>
<p>אנו יוצאים מנקודת הנחה שהקורסים ב- LDAP מוגדרים כקבוצות כשלכל קבוצה יש שדות חברות מרובים (<em>member</em> או<em>memberUid</em>) שמכילים זיהוי הייחודי למשתמש.</p>
<p>בכדי להשתמש בהרשמת LDAP, <strong>חובה</strong> על המשתמשים שלכם  להיות בעלי שדה מספר זיהוי תקף.
על מנת שהמשתמש יהיה רשום לקורס חובה שלקבוצות ה-LDAP יהיה את מספר הזיהוי שמופיע בשדות החבר. על פי רוב הדבר יעבוד ללא כל בעיה במידה ואתם כבר משתמשים באימות LDAP .</p>
<p>ההרשמות יעודכנו כאשר המשתמש יתחבר למערכת. בנוסף אתם יכולים להריץ קובץ אצווה כדי לשמור על ההרשמות מסונכרנות.
הסתכלו ב-
<em>enrol/ldap/enrol_ldap_sync.php</em>.</p>
<p>בנוסף ניתן להגדיר את התקן תקע זה  ליצור קורסים אוטומטית כאשר קבוצות חדשות מופיעות ב- LDAP.</p>';
$string['pluginnotenabled'] = 'תוסף לא זמין!';
$string['roles'] = 'מיפוי תפקידים';
$string['server_settings'] = 'הגדרות שרת LDAP';
$string['template'] = 'לבחירתכם: קורסים שנוצרו באופן אוטומטי יכולים להעתיק את ההגדרות שלהם מקורס-תבנית.';
$string['template_key'] = 'תבנית';
$string['updatelocal'] = 'עדכן נתונים מקומיים';
$string['user_attribute_key'] = 'ID number attribute';
$string['user_contexts_key'] = 'Contexts';
$string['user_search_sub'] = 'אם חברות הקבוצה מכילה שמות מכובדים, ציין אם החיפוש של המשתמשים שהסתיים  גם בתתי-ההקשר';
$string['user_search_sub_key'] = 'חיפוש בתתי-הקשר';
$string['user_type_key'] = 'סוג משתמש';
$string['version'] = 'גירסת הפרוטוקול של LDAP בה משתמש השרת שלך.';
$string['version_key'] = 'גרסה';
