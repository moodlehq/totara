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
 * Strings for component 'report_security', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   report_security
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['check_configrw_details'] = '<p>מומלץ כי הרשאות קבצים של config.php ישונו אחרי ההתקנה כך שהקובץ לא יוכל להשתנוץ על ידי שרת הרשת.
שימו לב כי אמצעי זה לא משפר את הבטחון באופן ניכר, אם כי הוא יכול להאט או להגביל שימושים לרעה. </p>.';
$string['check_configrw_name'] = 'קובף config.php הניתן לכתיבה';
$string['check_configrw_ok'] = 'config.php  לא ניתן לשינוי על ידי קבצי PHP';
$string['check_configrw_warning'] = 'קבצי PHP עשויים לשנות את config.php';
$string['check_cookiesecure_details'] = '<p>אם תקשורת http מופעלת מומלץ גם להפעיל את עוביות הביטחון. יש להוסיף הכוונה תמידית מhttp ל-https.
</p>';
$string['check_cookiesecure_error'] = 'יש לאפשר עוגיות מאובטחות';
$string['check_cookiesecure_name'] = 'עוגיות מאובטחות';
$string['check_cookiesecure_ok'] = 'עוגיות מאובטחות מאופשרות';
$string['check_defaultuserrole_details'] = '<p>לכל המשתמשים המחוברים למערכת ניתנו יכולות של משתמש ברירת המחדל. יש להבטיח שיכולות מסוכנות לא מורשות לתפקיד זה. </p> <p> הירושה היחידה הנתמכת למשתמש ברירת המחדל היא <em> משתמש מאומת (Authenticated)  </em>. אין לאפשר יכולות צפיה בקורס.</p>';
$string['check_defaultuserrole_error'] = 'תפקיד ברירת המחדל של משתמש "{$a}" הוגר בצורה לא נכונה';
$string['check_defaultuserrole_name'] = 'תפקיד ברירת המחדל לכל המשתמשים';
$string['check_defaultuserrole_notset'] = 'תפקיד ברירת המחדל לא הוגדר';
$string['check_defaultuserrole_ok'] = 'תפקיד ברירת המחדל לכל המשתמשים הודר בצורה נכונה';
$string['check_displayerrors_details'] = '<p>לא מומלץ לאפשר את הגדרת ה-PHP code>display_errors</code> באתרים פעילים משום שהודעות השגיאה יכולות לגלות מידע רגיד על השרת שלך. </p>';
$string['check_displayerrors_error'] = 'יכולות PHP להציג שגיאות מופעלת. מומלץ שהיא תופסק.';
$string['check_displayerrors_name'] = 'הצגת שגיאות PHP';
$string['check_displayerrors_ok'] = 'הצגת שגיאות PHP מנוטרלת';
$string['check_emailchangeconfirmation_details'] = '<p>מומלץ כי בעת שהמשתמשים משנים את כתובת הדוא"ל שלהם בפרופיל יתווסף שלב של אישור. אם אפשרות זאת מנוטרלת  שולחי "זבל" עשויים לנסות לנצל את השרת לשלוח "זבל". </p> <p> ניתן גם לסגור את שדה הדוא"ל מתוספי האימות, אפשרות שאת לא נידונה כאן. <p>';
$string['check_emailchangeconfirmation_error'] = 'המשתמשים רשאים לציין כל כתובת דוא"ל';
$string['check_emailchangeconfirmation_info'] = 'המשתמשים רשאים לציין כתובות דוא"ל רק מתחומים מותרים';
$string['check_emailchangeconfirmation_name'] = 'אישור שינוי הדוא"ל';
$string['check_emailchangeconfirmation_ok'] = 'אישור של שינוי הדוא"ל בפרופיל המשתמש';
$string['check_embed_details'] = '<p>כמות לא מוגבלת של EMBED היא מאד מסוכנת - כל משתמש רשום יכול להפעיל התקפת XSS כנגד כל משתמשי השרת האחרים. תכונה זאת חייבת להיות מנוטרל בשרתים פעילים. </p>';
$string['check_embed_error'] = 'כמות לא מוגבלת של EMBED היא מאד מסוכנת - הסכנה קיימת למרבית המשתמשים.';
$string['check_embed_name'] = 'אפשר EMBED ו-OBJECT';
$string['check_embed_ok'] = 'לא מאושרת כמות לא מוגבלת  לא מוגבלת של EMBED';
$string['check_frontpagerole_details'] = '<p>תפקיד ברירת-המחדל של הדף הקדמי ניתן לכל המשתמשים הרשומיםלפעילויות של הדף הקדמי. יש לוודא ששום יכולות מסוכנות מאופשרות לתפקיד זה. </p>  <p> מומלץ לייצור תפקיד יחודי עבור מטרה זאת וכי שום תפקיד אחר לא יתאפשר </p>';
$string['check_frontpagerole_error'] = 'תפקיד דף הקדמי {$a} הוגדר בצורה לא נכונה!';
$string['check_frontpagerole_name'] = 'תפקיד הדף הקדמי';
$string['check_frontpagerole_notset'] = 'תפקיד הדף הקדמי לא הוגדר';
$string['check_frontpagerole_ok'] = 'הגדרת תפקיד הדף הקדמי נכונה';
$string['check_globals_details'] = '<p> רישום כוללני הוא הגדקת PHP מסוכנת ביותר. </p> <p> <code>register_globals=off</code>
חייב להיות בהגדרות ה-PHP. הגדרה זאת מתבצעת על ידי עריכת <code>php.ini</code>,  שלך, תצורת Apache/IIS או קובץ <code>.htaccess</code>
</p>';
$string['check_globals_error'] = 'חובה (!) למנוע את הרישום הכוללני. יש לתקן את הגדרות שרת ה PHP מידית!';
$string['check_globals_name'] = 'Register globals';
$string['check_globals_ok'] = 'Register globals מנוטרל';
$string['check_google_details'] = '<p>  פתיחה להגדרות של Google מאפשרת למנועי החיפוש להגיע לקורסים עם הרשאת אורחים. אין טעם לאפשר הגדרה זו אם גישת האורחים איננה מאופשרת בקורס. </p>';
$string['check_google_error'] = 'שימוש במנועי חיפוש מותרת אך השימוש לאורחים אינו מותר.';
$string['check_google_info'] = 'ניתן לחפש במנועי חיפוש כאורח';
$string['check_google_name'] = 'פתח ל-Google';
$string['check_google_ok'] = 'לא אופשרה הגישה למנוע החיפוש';
$string['check_guestrole_details'] = '<p> תפקיד האורחים משמש אורחים ולא משתמשים שנרשמו למערכת והרשאות שמניות לקורסים לאורחים. יש לוודא כי יכולות מסוכנות לא מאופשרות בתפקיד זה. </p> <p> התפקיד היחידי הנתמך כתפקיד האורח הוא <em>אורח</em>
</p>';
$string['check_guestrole_error'] = 'תפקיד המבקר "{$a}" מודגר לא נכון!';
$string['check_guestrole_name'] = 'תפקיד המבקר';
$string['check_guestrole_notset'] = 'תפקיד המבקר לא הוגדר';
$string['check_guestrole_ok'] = 'תפקיד המבקר הוגדר נכון';
$string['check_mediafilterswf_details'] = '<p>שיבוץ אוטומטי של SWF הוא מאוד מסוכן - כל משתמש רשום יכול להתחיל התקפת XSS כנגד משתמשי השרת האחרים. אנא מנעו אפשרות זאת באתרים פעילים. <p>';
$string['check_mediafilterswf_error'] = 'מסנן Flash media מאופשר - לעיתים הדבר עלול לגרום נזק לשרתים';
$string['check_mediafilterswf_name'] = 'מסנן .swf media מאופשר';
$string['check_mediafilterswf_ok'] = 'מסנן Flash media כבוי';
$string['check_noauth_details'] = '<p>תוסף <em>ללא אימות</em> לא מיועד למערכות פעילות. אנא מנע  אותו אלא אם זאת היא מערכת פיתוח </p>';
$string['check_noauth_error'] = 'לא ניתן להשתמש בתוסף "ללא אימות" באתרים פעילים';
$string['check_noauth_name'] = 'ללא אימות';
$string['check_noauth_ok'] = 'תוסף "ללא אימות" כבוי';
$string['check_openprofiles_details'] = '<p> פרופילים פתוחים של משתמשים עשויים להיות מנוצלים על ידי שולחי "זבל". מומלץ כי
code>יש להכריח את המשתמשים להתחבר בעבור הפרופילים</code> או
code>חייב משתמשיםלהתחבר</code> are enabled>מופעל.</p>';
$string['check_openprofiles_error'] = 'כל אדם יכול לצפות בחשבונות ללא התחברות למערכת.';
$string['check_openprofiles_name'] = 'פתיחת חשבונות משתמש';
$string['check_openprofiles_ok'] = 'הצפיה בחשבונות משתמש מותנת בהתחברות למערכת.';
$string['check_passwordpolicy_details'] = '<p>מומלץ להגדיר מדיניות לסיסמה, מכיוון וניחוש סיסמאות היא פעמים רבות הדרך הקלה ביותר להשיג כניסה לא מאושרת. אין  צורך בדרישות קשות מדי, משום שזה יכול לגום לכך שהשתמשים לא יהיו מסוגלים לזכור את הסיסמאות שלהם וכתוצאה מכך הן תשכחנה או שיהיה צורך לרשום אותן. </p>';
$string['check_passwordpolicy_error'] = 'מדיניות סיסמה איננה מוגדרת עדיין.';
$string['check_passwordpolicy_name'] = 'מדיניות סיסמה';
$string['check_passwordpolicy_ok'] = 'מדיניות סיסמה מאופשרת';
$string['check_passwordsaltmain_details'] = '<p> הגדרת "מלח" לסיסמאות מקטין במידה רבה את הבכנה של גניבת סיסמאות. </p> <p>בכדי להגדיר "מלח" לסיסמה, הוסף את השורה הבאה לקובץ config.php file: </p>
<code>$CFG->passwordsaltmain = \'some long random string here with lots of characters\';</code>  <p>
מחרוזת הסימנים האקראית צריכה להיות תערובת של אותיות, ספרות וסימנים אחרים.
מומלץ להשתמש במחרוזת של לפחות 40 סימנים. </p> <p> אנא התייחסו ל- <a href="{$a}" target="_blank"> מסמך "המלח" סיסמאות</a> אם ברצונכם לשנות את "מלח" הסיסמה. לאחר ההגדרה אל תמחקו את "מלח" הסיסמה אחרת לא תוכלו להתחבר אי פעם למערכת!  </p>';
$string['check_passwordsaltmain_name'] = '"מלח" הסיסמה';
$string['check_passwordsaltmain_ok'] = '"מלח" הסיסמה נכון';
$string['check_passwordsaltmain_warning'] = 'לא הוגדר "מלח" לסיסמה';
$string['check_passwordsaltmain_weak'] = '"מלח" הסיסמה חלש';
$string['check_riskadmin_detailsok'] = '<p>אמת את הרשימה הבאה של מנהלי המערכת </p> {$a}';
$string['check_riskadmin_detailswarning'] = '<p>יש לוודא את הרשימה הבאה של מנהלי המערכת: </p> {$a->admins}
</p> מומלץ למנות תפקיד מנהל מערכת רק בהקשר למערכת. למשתמשים הבאים יש זכויות (לא נתמכות) של מנהל מערכת בהקשרים אחרים:
{$a->unsupported}';
$string['check_riskadmin_name'] = 'מנהלי המערכת';
$string['check_riskadmin_ok'] = 'נמצאו {$a} מנהלי מערכת.';
$string['check_riskadmin_unassign'] = '<a href="{$a->url}">{$a->fullname} ({$a->email}) בחן את הצבת התפקידים</a>';
$string['check_riskadmin_warning'] = 'נמצאו {$a->admincount} מנהלי שרתים וכן
{$a->unsupcount} הקצאות תפקיד לא נתמכות של מנהלי מערכת.';
$string['check_riskbackup_details_overriddenroles'] = '<p>עקיפות פעילות אלו מעניקות למשתמשים את היכולת לכלול נתוני משתמש בגיבויים. יש להבטיח כי  הרשאה זאת אמנם דרושה.
</p>
{$a}';
$string['check_riskbackup_details_systemroles'] = '<p>תפקידי המערכת הבאים מאפשרים כעת למשתמשים לכלכול מיד של משתמשים בגיבויים. יש לוודא שהרשאה זאת היא הכרחית. </p> {$a{';
$string['check_riskbackup_details_users'] = '<p>משום מה שנאמר לעיל או מפאת עקיפות מקומיות יש למשתמשים הבאים את היכולת לבצע גיבוייםהכוללים מידע פרטי מכל המשתמשים הרשומים לקורסים שלהםץ יש לוודא כי הם (1) אמינים ו-(2) מוגנים על ידי סיסמאות חזקות: {$a}
</p>';
$string['check_riskbackup_detailsok'] = 'אים תפקידים אשר מתירים באופן מפורש ביצוע גיבוי של נתוני המשתמש. אולם למנהלי מערכת בעלי היכולת "עשה הכל" מתאפשר כנראה יכולים לבצע זאת.';
$string['check_riskbackup_editoverride'] = '<a href="{$a->url}">{$a->name} ב- {$a->contextname}</a>';
$string['check_riskbackup_editrole'] = '<a href="{$a->url}">{$a->name}</a>';
$string['check_riskbackup_name'] = 'גיבוי נתוני המשתמש';
$string['check_riskbackup_ok'] = 'אין תפקידים המאשפרים באופן מפורש גיבויים של מידע משתמש.';
$string['check_riskbackup_unassign'] = '<a href="{$a->url}">{$a->fullname} ({$a->email}) ב- {$a->contextname}</a>';
$string['check_riskbackup_warning'] = 'נמצאו {$a->rolecount} תפקידים, {$a->overridecount}  עקיפות ו-{$a->usercount} משתמשיםעם היכולת לגבות נמידע של משתמשים.';
$string['check_riskxss_details'] = '<p>
RISK_XSS מציין את כל היכולות המסוכנות שרק למשתמשים מורשים יכולים להשתמש בהן. </p>
<p>יש לוודא את הרשימה הבאה של משתמשים ויש להבטיח עי ניתן לסמוך עליהם לחלוטין בשרת זה. </p> <p> {$a}';
$string['check_riskxss_name'] = 'משמשי XSS שבוטחים בהם';
$string['check_riskxss_warning'] = 'RISK_XSS מצא {$a} משתמשים שניתן לבטוח בהם';
$string['check_unsecuredataroot_details'] = '<p>אין לאפשר למדור שורש הנתונים להיות בר גישה מהרשת. הדרך הטובה ביותר להבטיח כי המדור לא יהיה בר גישה הוא להשתמש באחד מהמדורים שמחוץ למדור הציבורי.</p> <p>אם המדור הוזז חובה לעדכן את הגדרות<code>$CFG->dataroot</code> ב-<code>config.php</code> accordingly בהתאמה </p>';
$string['check_unsecuredataroot_error'] = 'תיקיית ה- dataroot שלך <code>{$a}</code> הוא במקום שגוי והוא גלוי ברשת.';
$string['check_unsecuredataroot_name'] = 'תיקיית ה- dataroot שלך לא מאובטחת';
$string['check_unsecuredataroot_ok'] = 'אין לאפשר גישה ל-תיקיית ה- dataroot שלך  דרך הרשת.';
$string['check_unsecuredataroot_warning'] = 'תיקיית ה- dataroot שלך <code>{$a}</code> במקום שגוי ועשויה להיות גלויה לרשת.';
$string['configuration'] = 'תצורה';
$string['description'] = 'תיאור';
$string['details'] = 'פרטים';
$string['issue'] = 'בעיה';
$string['pluginname'] = 'סקירת אבטחה';
$string['security:view'] = 'צפה בדוח הביטחון';
$string['status'] = 'מצב';
$string['statuscritical'] = 'קריטי';
$string['statusinfo'] = 'מידע';
$string['statusok'] = 'בסדר';
$string['statusserious'] = 'רציני';
$string['statuswarning'] = 'אזהרה';
$string['timewarning'] = 'העיבוד יכול לערוך זמן רב, אנא היו סבלניים...';
