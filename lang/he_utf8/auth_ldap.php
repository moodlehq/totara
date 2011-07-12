<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_ldap_ad_create_req'] = 'לא ניתן ליצור את החשבון החדש ב-Active Directory. וודא כי כל הדרישות לשם הפעלה זו נכונות. (חיבור LDAPS, משתמש קשור (bind) עם זכויות מתאימות וכד\'.';
$string['auth_ldap_attrcreators'] = 'רשימת קבוצות קונטקסטים אשר חבריהם רשאים ליצור תכונות. הפרד קבוצות רבות עם הסימן \';\'. בדר\"כ יראה למשל כך \'cn=teachers,ou=staff,o=myorg\'';
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
$string['auth_ldap_noconnect'] = 'רכיב ה-LDAP לא יכול להתחבר לשרת: $a';
$string['auth_ldap_noconnect_all'] = 'רכיב ה-LDAP לא יכול לאף שרת: $a';
$string['auth_ldap_noextension'] = 'אזהרה: לא נראה כי רכיב ה-PHP LDAP נוכח. אנא וודא שהוא מותקן ונוכח.';
$string['auth_ldap_objectclass'] = 'לבחירתכם: עוקף את objectClass  שמשמש לתת שםלערוך חיפוש משתמשים ב-LDAP_user_type. לרוב, אין צורך לשנות את הגדרה זו.';
$string['auth_ldap_objectclass_key'] = 'מחלקת Object';
$string['auth_ldap_opt_deref'] = 'קובע כיצד מתייחסים לכינויים בזמן עריכת חיפוש. בחרו באחד מהערכים הבאים:
\"לא\" (LDAP_DEREF_NEVER) או \"כן\"
(LDAP_DEREF_ALWAYS).';
$string['auth_ldap_opt_deref_key'] = 'התייחסות לשמות נרדפים';
$string['auth_ldap_passtype'] = 'פרט את ה של סיסמאות חדשות או כאלה ששונו בשרת ה-LDAP.';
$string['auth_ldap_passtype_key'] = ' סיסמה';
$string['auth_ldap_passwdexpire_settings'] = 'הגדרות פג-תוקף סיסמאת LDPA.';
$string['auth_ldap_preventpassindb'] = 'בחרו כן על מנת למנוע מסיסמאות להישמר ב-DB של מוודל.';
$string['auth_ldap_preventpassindb_key'] = 'הסתר סיסמאות';
$string['auth_ldap_search_sub'] = 'שים ערך <> 0 אם אתה רוצה לחפש משתמשים מתת-הקשרים.';
$string['auth_ldap_search_sub_key'] = 'חפש בתת-הקשרים';
$string['auth_ldap_server_settings'] = 'הגדרות שרת LDAP';
$string['auth_ldap_unsupportedusertype'] = 'מחבר: ldap user_create() לא תומך בסוג המתשתמש הנבחר:\"$a\" (עדיין...)';
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
$string['auth_ldapdescription'] = 'שיטה זו מספקת אימות כנגד שרת LDAP חיצוני. אם שם משתמש וסיסמה הם תקפים, Moodle יוצר כניסת משתמש חדשה בבסיס הנתונים. רכיב זה יכול לקרוא מאפייני משתמשים מ-LDAP ולמלא מראש שדות רצויים ב-Moodle. בהתחברות עתידית יבדקו רק שם המשתמש והסיסמה.';
$string['auth_ldapextrafields'] = 'שדות אלו הם אופציונליים. אתה יכול לבחור למלא מראש שדות משתמש שתפרט פה עם מידע מה<b>LDAP שדות</b>. <br /> אם תשאיר שדות אלו ריקים אז דבר לא יעבור מ-LDAP ובמקומם ישתמשו בברירות המחדל של Moodle .<br />
</p><p>
בכל מקרה, המשתמש יוכל לערוך את כל השדות הללו לאחר התחברות.</p>';
$string['auth_ldapnotinstalled'] = 'לא ניתן להשתמש באימות LDAP. רכיב ה-PHP LDAP איננו מותקן.';
$string['auth_ldaptitle'] = 'השתמש בשרת LDAP';
$string['auth_ntlmsso_enabled_key'] = 'אפשר';
$string['auth_ntlmsso_subnet'] = 'אם מאופשר, הדבר ינסה SSO עם לקוחות ב-subnet הבא. תבנית: xxx.xxx.xxx.xxx/bitmask';
$string['ntlmsso_attempting'] = 'נסיון Single Sign On דרך NTLM...';
$string['ntlmsso_failed'] = 'התחברות אוטומטית נכשלה, נסה את עמוד ההתחברות הרגיל...';
$string['ntlmsso_isdisabled'] = 'NTLM SSO מנוטרל.';