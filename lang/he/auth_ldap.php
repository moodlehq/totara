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
 * Strings for component 'auth_ldap', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_ldap_ad_create_req'] = 'לא ניתן ליצור את החשבון החדש ב-Active Directory. וודא כי כל הדרישות לשם הפעלה זו נכונות. (חיבור LDAPS, משתמש קשור (bind) עם זכויות מתאימות וכד\'.';
$string['auth_ldap_attrcreators'] = 'רשימת קבוצות קונטקסטים אשר חבריהם רשאים ליצור תכונות. הפרד קבוצות רבות עם הסימן \';\'. בדר"כ יראה למשל כך \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_attrcreators_key'] = 'יוצרי תכונות';
$string['auth_ldap_auth_user_create_key'] = 'צור משתמשים באופן חיצוני';
$string['auth_ldap_bind_dn'] = 'אם ברצונך להשתמש במנגנון bind-user לחיפוש משתמשים, עליך להגדיר זאת כאן. למשל \'cn=ldapuser,ou=public,o=org\'';
$string['auth_ldap_bind_dn_key'] = 'שם מכובד';
$string['auth_ldap_bind_pw'] = 'סיסמה עבור bind-user';
$string['auth_ldap_bind_pw_key'] = 'סיסמה';
$string['auth_ldap_bind_settings'] = 'הגדרות bind';
$string['auth_ldap_changepasswordurl_key'] = 'כתובת URL המשמשת לשינוי סיסמה';
$string['auth_ldap_contexts'] = 'רשימת הקשרים בהם ממוקמים משתמשים. הפרד הקשרים שונים באמצעות \';\'. לדוגמא:\'ou=users,o=org; ou=others,o=org\'';
$string['auth_ldap_contexts_key'] = 'הקשרים';
$string['auth_ldap_create_context'] = 'אם תאפשר יצירת משתמשים עם אימות דואר אלקטרוני,  פרט את ההקשר בו ייווצרו המשתמשים. הקשר זה צריך להיות שונה ממשתמשים אחרים כדי למנוע בעיות אבטחה. אתה לא צריך להוסיף את הקשר זה לldap_context-variable, Moodle ייחפש משתמשים מהקשר זה באופן אוטומטי.';
$string['auth_ldap_create_context_key'] = 'הקשרים עבור משתמשים חדשים';
$string['auth_ldap_create_error'] = 'שגיאה ביצירת משתמש ב-LDAP';
$string['auth_ldap_creators'] = 'רשימת קבוצות או קונטקסטים אשר חבריהם רשאים ליצור קורסים חדשים. הפרד קבוצות מרובות באמצעות \';\'. בדרך כלל משהו כגון \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_creators_key'] = 'יוצרים';
$string['auth_ldap_expiration_desc'] = 'בחר ב\'לא\' כדי למנוע בדיקת סיסמאות שפג תוקפן או כדי למנוע מה-LDAP לקרוא את זמן תפוגת התפוקה ישירות מה-LDAP';
$string['auth_ldap_expiration_key'] = 'תאריך תפוגה';
$string['auth_ldap_expiration_warning_desc'] = 'מספר הימים לפני שנמסרת אזהרת תפוגת סיסמה.';
$string['auth_ldap_expiration_warning_key'] = 'אזהרה על תאריך תפוגה';
$string['auth_ldap_expireattr_desc'] = 'לבחירתכם: עוקף מאפיין LDAP השומר את זמן פג תוקף סיסמה, passwordExpirationTime .';
$string['auth_ldap_expireattr_key'] = 'תכונת תאריך התפוגה';
$string['auth_ldap_graceattr_desc'] = 'לבחירתכם: עוקף מאפיין LDAP gracelogin .';
$string['auth_ldap_gracelogin_key'] = 'תכונת התחברות Grace';
$string['auth_ldap_gracelogins_desc'] = 'אפשר תמיכת gracelogin ב-LDAP. לאחר שפג תוקפה של הסיסמה, המשתמש עדיין יכול להתחבר עד שהמונה ב-gracelogin מתאפס. אפשר את ההגדרה הזו על מנת להציג הודעה של gracelogin שפג תוקף הסיסמה.';
$string['auth_ldap_gracelogins_key'] = 'התחברויות דרך Grace';
$string['auth_ldap_groupecreators'] = 'רשימת קבוצות או קונטקסטים אשר חבריהם רשאים ליצור קבוצות חדשים. הפרד קבוצות מרובות באמצעות \';\'. בדרך כלל משהו כגון \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_groupecreators_key'] = 'יוצרי קבוצות';
$string['auth_ldap_host_url'] = 'פרט מארח LDAP בצורת URL כמו \'ldap://ldap.myorg.com/\' או \'ldaps://ldap.myorg.com/\'';
$string['auth_ldap_host_url_key'] = 'כתובת ה-URL של המחשב המארח';
$string['auth_ldap_ldap_encoding'] = 'ציין את הקידוד בו משתמש שרת ה-LDAP. רוב הסיכויים ש-utf-8, MS AD v2 משתמש בקידוד ברירת מחדל כמו cp1252, cp1250 וכו\'.';
$string['auth_ldap_ldap_encoding_key'] = 'קידוד LDAP';
$string['auth_ldap_login_settings'] = 'הגדרות התחברות';
$string['auth_ldap_memberattribute'] = 'ניתן לבחירה: עוקף את תכונת משתמש-חבר, כאשר המשתמשים הינם חלק מקבוצה. לרוב \'חבר\'.';
$string['auth_ldap_memberattribute_isdn'] = 'לבחירתכם: עוקף את העיסוק בערכי תכונות החבר, 0 או 1.';
$string['auth_ldap_memberattribute_isdn_key'] = 'תכונת החבר משתמשת ב-dn';
$string['auth_ldap_memberattribute_key'] = 'תכונת החבר';
$string['auth_ldap_no_mbstring'] = 'הינך זקוק ל-mbstring בכדי ליצור משתמשים ב-Active Directory.';
$string['auth_ldap_noconnect'] = 'מודול ה-LDAP לא יכול להתחבר לשרת: {$a}';
$string['auth_ldap_noconnect_all'] = 'מודול ה-LDAP לא יכול לאף שרת: {$a}';
$string['auth_ldap_noextension'] = 'אזהרה: לא נראה כי מודול ה-PHP LDAP נוכח. אנא וודא שהוא מותקן ונוכח.';
$string['auth_ldap_objectclass'] = 'לבחירתכם: עוקף את objectClass  שמשמש לתת שםלערוך חיפוש משתמשים ב-LDAP_user_type. לרוב, אין צורך לשנות את הגדרה זו.';
$string['auth_ldap_objectclass_key'] = 'מחלקת Object';
$string['auth_ldap_opt_deref'] = 'קובע כיצד מתייחסים לכינויים בזמן עריכת חיפוש. בחרו באחד מהערכים הבאים:
"לא" (LDAP_DEREF_NEVER) או "כן"
(LDAP_DEREF_ALWAYS).';
$string['auth_ldap_opt_deref_key'] = 'התייחסות לשמות נרדפים';
$string['auth_ldap_passtype'] = 'פרט את ה של סיסמאות חדשות או כאלה ששונו בשרת ה-LDAP.';
$string['auth_ldap_passtype_key'] = 'סיסמה';
$string['auth_ldap_passwdexpire_settings'] = 'הגדרות פג-תוקף סיסמאת LDPA.';
$string['auth_ldap_preventpassindb'] = 'בחרו כן על מנת למנוע מסיסמאות להישמר ב-DB של מוודל.';
$string['auth_ldap_preventpassindb_key'] = 'הסתר סיסמאות';
$string['auth_ldap_search_sub'] = 'שים ערך <> 0 אם אתה רוצה לחפש משתמשים מתת-הקשרים.';
$string['auth_ldap_search_sub_key'] = 'חיפוש בתת-הקשרים';
$string['auth_ldap_server_settings'] = 'הגדרות שרת LDAP';
$string['auth_ldap_unsupportedusertype'] = 'מחבר: ldap user_create() לא תומך בסוג המתשתמש הנבחר:"{$a}" (עדיין...)';
$string['auth_ldap_update_userinfo'] = 'עדכן נתוני משתמש (שם פרטי, שם משפחה כתובת...) מ-LDAP ל-Moodle. הגדר \'מיפוי מידע\' לפי צרכיך.';
$string['auth_ldap_user_attribute'] = 'ניתן לבחירה: עוקף את התכונה שמשמשת לחפש אחרתן שם למשתמשים (name/search users). לרוב \'cn\'.';
$string['auth_ldap_user_attribute_key'] = 'תכונת משתמש';
$string['auth_ldap_user_exists'] = 'שם משתמש ה-LDAP כבר קיים';
$string['auth_ldap_user_settings'] = 'הגדרות חיפוש אחר משתמשים';
$string['auth_ldap_user_type'] = 'בחר כיצד LDAP שומר משתמשים. בנוסף, הגדרה זו קובעת כיצד פגה ההתחברות, grace logins ויצירת משתמשים יעבדו.';
$string['auth_ldap_user_type_key'] = 'סוג משתמש';
$string['auth_ldap_usertypeundefined'] = 'config.user_type לא מוגדר או שפונקציית ldap_expirationtime2unix לא תומכת בסוג הנבחר';
$string['auth_ldap_usertypeundefined2'] = 'config.user_type לא מוגדר או שפונקצייתldap_unixi2expirationtime לא תומכת בסוג הנבחר';
$string['auth_ldap_version'] = 'גרסת פרוטוקול ה-LDPA שהשרת שלך משתמש בה.';
$string['auth_ldap_version_key'] = 'גירסה';
$string['auth_ldapdescription'] = 'שיטה זו מספקת אימות כנגד שרת LDAP חיצוני. אם שם משתמש וסיסמה הם תקפים, Moodle יוצר כניסת משתמש חדשה בבסיס הנתונים. מודול זה יכול לקרוא מאפייני משתמשים מ-LDAP ולמלא מראש שדות רצויים ב-Moodle. בהתחברות עתידית יבדקו רק שם המשתמש והסיסמה.';
$string['auth_ldapextrafields'] = 'שדות אלו הם אופציונליים. אתה יכול לבחור למלא מראש שדות משתמש שתפרט פה עם מידע מה<b>LDAP שדות</b>. <br /> אם תשאיר שדות אלו ריקים אז דבר לא יעבור מ-LDAP ובמקומם ישתמשו בברירות המחדל של Moodle .<br />
</p><p>
בכל מקרה, המשתמש יוכל לערוך את כל השדות הללו לאחר התחברות.</p>';
$string['auth_ldapnotinstalled'] = 'לא ניתן להשתמש באימות LDAP. מודול ה-PHP LDAP איננו מותקן.';
$string['auth_ntlmsso'] = 'NTLM SSO';
$string['auth_ntlmsso_enabled'] = 'סמן "כן" לאפשר נסיון Single Sign On עם תוחם ה-NTLM. <strong>זכור:</strong>
הדבר דורש הגדרות נוספות בצד השרת, ראה פרטים נוספים כאן:
<a href="http://docs.moodle.org/en/NTLM_authentication">http://docs.moodle.org/en/NTLM_authentication</a>';
$string['auth_ntlmsso_enabled_key'] = 'אפשר';
$string['auth_ntlmsso_ie_fastpath'] = 'הגדר "כן" לאפשר את הנתיב המהיר של
NTLM SSO
(צעדים מסויימים של   bypasses פועלים רק אם הלקוחות של הדפדפן הם של MS Internet Explorer ).';
$string['auth_ntlmsso_ie_fastpath_key'] = 'נתיב מהיר MS IE?';
$string['auth_ntlmsso_subnet'] = 'אם מאופשר, הדבר ינסה SSO עם לקוחות ב-subnet הבא. תבנית: xxx.xxx.xxx.xxx/bitmask';
$string['auth_ntlmsso_subnet_key'] = 'Subnet';
$string['auth_ntlmsso_type'] = 'שיטת האימות הוגדרה בשרת לצורך אימות המשתמשים
(אם יש ספק נא להשתמש ב NTLM )';
$string['auth_ntlmsso_type_key'] = 'סוג אימות';
$string['connectingldap'] = 'מתחבר לשרת ה-LDAP...';
$string['creatingtemptable'] = 'יוצר טבלה זמנית {$a}';
$string['didntfindexpiretime'] = 'פונקציית password_expire()
לא מצאה זמן תפוגה';
$string['didntgetusersfromldap'] = 'האם קיבלת משתמשים כלשהם משרת ה-LDAP --- שגיאה? -- יוצא';
$string['gotcountrecordsfromldap'] = 'התקבלו {$a} רשומות מה-LDAP';
$string['morethanoneuser'] = 'מוזר! נמצאו יותר מרשומה אחת של משתמש ב-LDAP. כשהשתמשת בראשון בלבד';
$string['needbcmath'] = 'יש צורך בהרחבת BCMath  לשימוש בחיבורי grace  עם
Active Directory';
$string['needmbstring'] = 'יש צורך בהרחבת mbstring  לצורך שינוי סיסמאות ב
Active Directory';
$string['nodnforusername'] = 'יש שגיאה בשגרה
user_update_password().
אין DN עבור: {$a->username}';
$string['noemail'] = 'נכשל ניסיון לשלוח לך הודעת דואר אלקטרוני!';
$string['notcalledfromserver'] = 'לא אמור להיקרא מהשרת!';
$string['noupdatestobedone'] = 'אין עדכונים לביצוע';
$string['nouserentriestoremove'] = 'אין ערכי משתמשים להסרה';
$string['nouserentriestorevive'] = 'אין ערכי משתמש לחדש';
$string['nouserstobeadded'] = 'אין משתמשים להוספה';
$string['ntlmsso_attempting'] = 'נסיון Single Sign On דרך NTLM...';
$string['ntlmsso_failed'] = 'התחברות אוטומטית נכשלה, נסה את עמוד ההתחברות הרגיל...';
$string['ntlmsso_isdisabled'] = 'NTLM SSO מנוטרל.';
$string['ntlmsso_unknowntype'] = 'סוג ntlmsso  לא ידוע';
$string['pluginname'] = 'השתמש בשרת LDAP';
$string['pluginnotenabled'] = 'תוסף לא מאופשר!';
$string['renamingnotallowed'] = 'שינוי שם משתמש לא מאופשר ב-LDAP';
$string['rootdseerror'] = 'שגיאה בשאילתת rootDSE
עבור Active Directory';
$string['updatepasserror'] = 'שגיאה בשגרה user_update_password().
קוד השגיאה: {$a->errno}; מחרוזת השגיאה:
{$a->errstring}';
$string['updatepasserrorexpire'] = 'שגיאה בשגרה user_update_password().
כאשר קוראים את הזמן תפוגת הסיסמה.
קוד השגיאה: {$a->errno}; מחרוזת השגיאה:
{$a->errstring}';
$string['updatepasserrorexpiregrace'] = 'שגיאה בשגרה user_update_password().
כאשר משנים תאריך תפוגה ו/או חיבורי grace.
קוד השגיאה: {$a->errno}; מחרוזת השגיאה:
{$a->errstring}';
$string['updateremfail'] = 'שגיאה בעדכון רשומת LDAP.

קוד השגיאה: {$a->errno}; מחרוזת השגיאה:
{$a->errstring}
<br/>מפתח ({$a->key}) - ערך מוודל ישן: \'{$a->ouvalue}\' ערך חדש: \'{$a->nuvalue}\'';
$string['updateremfailamb'] = 'נכשל בנסיון לעדכן את ה-LDAP עם שדה דו-משמעי {$a->key}; <br/>מפתח ({$a->key}) - ערך מוודל ישן: \'{$a->ouvalue}\' ערך חדש: \'{$a->nuvalue}\'';
$string['updateusernotfound'] = 'לא הצליח למצוא משתמש כאשר עדכן כלפי חוץ. הפרטים להלן: חיפוש בסיסי: \'{$a->userdn}\'; חיפוש מסנן: \'(objectClass=*)\'; search attributes: {$a->attribs}';
$string['user_activatenotsupportusertype'] = 'auth: שגרת ldap user_activate()  לא תומכת ב -usertype: {$a} הנבחר';
$string['user_disablenotsupportusertype'] = 'auth: שגרת ldap user_disable()  לא תומכת ב -usertype: {$a} הנבחר';
$string['useracctctrlerror'] = 'שגיאה בעת קבלת userAccountControl עבור {$a}';
$string['userentriestoadd'] = 'ערכי משתמש אשר יתווספו: {$a}';
$string['userentriestoremove'] = 'ערכי משתמש אשר יוסרו: {$a}';
$string['userentriestorevive'] = 'ערכי משתמש אשר יחודשו: {$a}';
$string['userentriestoupdate'] = 'ארכי משתמש אשר יעודכנו: {$a}';
$string['usernotfound'] = 'המשתמש  לא נמצא ב-LDAP';
