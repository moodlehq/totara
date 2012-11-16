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
 * Strings for component 'auth', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   auth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actauthhdr'] = 'תוספי אימות פעילים';
$string['alternatelogin'] = 'אם תכניסו כאן כתובת URL, היא תשמש כעמוד ההתחברות לאתר שלכם. על עמוד זה להכיל טופס בו תכונת הבעלות מכוונת ל <strong>\'{$a}\'</strong> ושדות חזרה <strong>שם משתמש</strong> ו<strong>סיסמה</strong>.<br />
היזהרו שלא להקליד כתובת URL שגויה, מכיוון שאתם עלולים לנעול את עצמכם מחוץ לאתר. <br />
כדי להשתמש בדף ההתחברות שמשמש כברירת מחדל, השאירו את הגדרה זו ריקה.';
$string['alternateloginurl'] = 'כתובת URL חלופית המשמשת להתחברות';
$string['auth_changepasswordhelp'] = 'עזרה - שינוי סיסמה';
$string['auth_changepasswordhelp_expl'] = 'עזרת \'הצג סיסמה אובדת\' למשתמשים שאיבדו את ה{$a} סיסמה שלהם. אפשרות זו תוצג או בנוסף ל- או במקום
<strong>כתובת ה-URL: שנה סיסמה</strong> או  שינוי סיסמה למוודל באינטרנט (Internal Moodle password change).';
$string['auth_changepasswordurl'] = 'כתובת URL לשינוי סיסמה';
$string['auth_changepasswordurl_expl'] = 'ציינו את כתובת ה-URL אליה יישלחו משתמשים שאיבדו את ה{$a} סיסמה שלהם. קיבעו את <strong>השתמש בעמוד שינוי הסיסמה הסטנדרטי</strong> ל<strong>לא</strong>.';
$string['auth_changingemailaddress'] = 'ביקשת לשנות את כתובת הדוא"ל מ-{$a->oldemail} ל-{$a->newemail}. מסיבות אבטחה נשלח לך הודעת דוא"ל לכתובת החדשה בכדי שתאשר אותה. כתובת הדוא"ל החדשה תעודכן כאשר תלחץ על הקישור בהודעה שנשלחה אליך.';
$string['auth_common_settings'] = 'הגדרות שכיחות';
$string['auth_data_mapping'] = 'מיפוי מידע';
$string['auth_fieldlock'] = 'נעל ערך';
$string['auth_fieldlock_expl'] = '<p><b>נעל ערך:</b>אם אפשרות זו מופעלת, היא מונעת ממשתמשי מוודל וממנהלים לערוך את השדה הזה באופן ישיר. הישתמשו באפשרות זו במידה ואתם מתחזקים את הנתונים הללו במערכת auth חיצונית.
. Use this option if you are maintaining this data in the external  system. </p>';
$string['auth_fieldlocks'] = 'נעל שדות משתמשים';
$string['auth_fieldlocks_help'] = 'בידיכם האפשרות לנעול שדות המכילים נתונים של משתמשים. אפשרות זו שימושית באתרים בהם נתוני המשתמשים מתוזקים על ידי המנהלים באופן ידני על ידי עריכת רשומות המשתמשים או העלאה באמצעות האמצעי \'העלה משתמש\'. אם אתם נועלים שדות הנדרשים על ידי מוודל, וודאו שאתם מספקים את הנתונים הללו בזמן יצירת חשבונות משתמשים, או שלא יהיה ניתן להשתמש בחשבונות הללו.
קחו בחשבון שניתן להגדיר את מצב הנעילה ל\'לא נעול כשריק\' כדי להימנע מבעיה זו.';
$string['auth_invalidnewemailkey'] = 'שגיאה: אם אתה מנסה לאשר שינוי בכתובת הדוא"ל, חלה טעות בהעתקת הקישור ה-URL ששלחנו לך בדוא"ל. אנא העתק שוב את הכתובת ונסה שוב.';
$string['auth_multiplehosts'] = 'ניתן לפרט מארחים מרובים (לדוגמא host1.com;host2.com;host3.com) או (לדוגמה xxx.xxx.xxx.xxx;xxx.xxx.xxx.xxx)';
$string['auth_outofnewemailupdateattempts'] = 'תמו מספרי הנסיונות בהם היית רשאי לעדכן את כתובת הדוא"ל שלך. בקשת עדכון כתובת הדוא"ל שלך בוטלה.';
$string['auth_passwordisexpired'] = 'תוקף הסיסמה שלך פג. האם ברצונך לשנות את סיסמתך כעת?';
$string['auth_passwordwillexpire'] = 'הסיסמה שלך תפוג בתוך {$a} ימים. האם ברצונך לשנות את סיסמתך כעת?';
$string['auth_remove_delete'] = 'מחיקה פנימית מלאה';
$string['auth_remove_keep'] = 'שמור פנימי';
$string['auth_remove_suspend'] = 'השהה פנימי';
$string['auth_remove_user'] = 'פרט מה יש לעשות עם חשבונות משתמש פנימיים בזמן תאום המוני כאשר המשתמש הוצא ממקור חיצוני. רק משתמשים מושהים מוחזרים לשימוש באופן אוטומטי במידה והם מופיעים מחדש במקור החיצוני.';
$string['auth_remove_user_key'] = 'משתמש מרוחק שהוסר';
$string['auth_sync_script'] = 'תסריט (script) סנכרון ה-corn';
$string['auth_updatelocal'] = 'עדכן מקומית';
$string['auth_updatelocal_expl'] = '<p><b>עדכן מקומית:</b>אם אפשרות זו מופעלת, השדה יתעדכן (מתוך מקור אימות חיצוני) בכל פעם שהמשתמש מתחבר למערכת או כשמתרחש סינכרון משתמשים.
את השדות שמוגדרים לעדכון מקומי צריך לנעול.

</p>';
$string['auth_updateremote'] = 'עדכן חיצונית';
$string['auth_updateremote_expl'] = '<p><b>עדכן חיצונית:</b>אם אפשרות זו מופעלת, מקור האימות החיצוני יתעדכן בכל פעם שמתבצע עדכון רשומת המשתמש. אין לנעול את השדות כדי לאפשר את עריכתם. </p>';
$string['auth_updateremote_ldap'] = '<p><b>הערה:</b> עדכון נתוני LDAP חיצוניים דורשת שתגדיר את binddn ו-bindpw למשתמש-קשור עם הרשאות עריכה לכל רשומות המשתמשים. נכון לעכשיו הוא אינו משמר תכונות בעלות ערכים מרובים, ולכן תסיר ערכים נוספים במהלך העדכון. </p>';
$string['auth_user_create'] = 'אפשר יצירת משתמשים';
$string['auth_user_creation'] = 'משתמשים חדשים (אנונימיים) יכולים ליצור חשבונות משתמש על מקור האימות החיצוני שיאושרו דרך דואר אלקטרוני. אם תאפשר זאת, זכור גם להגדיר אפשרויות בכל מודול ליצירת משתמשים.';
$string['auth_usernameexists'] = 'שם משתמש נבחר כבר קיים. אנא בחר שם חדש.';
$string['authenticationoptions'] = 'אפשרויות אימות';
$string['authinstructions'] = 'כאן אתה יכול לספק למשתמשים שלך הוראות, כדי שהם ידעו באיזה שם משתמש וסיסמה הם צריכים להשתמש.  הטקסט שתכניס כאן יופיע בעמוד ההתחברות. אם תשאיר ריק, לא יופיעו כל הוראות.';
$string['auto_add_remote_users'] = 'הוספה אוטומטית של משתמשים מרוחקים';
$string['changepassword'] = 'כתובת URL לשינוי סיסמה';
$string['changepasswordhelp'] = 'כאן אתה מפרט מקום בו המשתמשים שלך יכולים להשתמש כדי למצוא או לשנות את שם המשתמש או הסיסמה שלהם אם הם שכחו אותם. זה יסופק למשתמשים ככפתור בעמוד ההתחברות ובעמוד המשתמש שלהם. אם תשאיר ריק, כפתור זה לא יופיע.';
$string['chooseauthmethod'] = 'בחר צורת אימות:';
$string['chooseauthmethod_help'] = 'תפריט זה מאפשר לכם לשנות את שיטת האימות של משתמש מסויים.
שימו לב שזה מאוד תלוי בשיטות האימות הקיימות באתר, ובאילו הגדרות הן משתמשות.
שינוי לא נכון כאן יכול למנוע מהמשתמש את היכולת להתחבר לאתר ואף יכול למחוק את החשבון שלו לחלוטין. אז אנא תשתמשו באפשרות הזו רק אם אתם בטוחים לחלוטין במה שאתם עושים.';
$string['createpasswordifneeded'] = 'צור סיסמה, אם היא נדרשת';
$string['emailchangecancel'] = 'בטל את שינוי הדוא"ל';
$string['emailchangepending'] = 'השינוי עומד להתרחש. פתח את הקישור שנשלח אליך ב-{$a->preference_newemail}';
$string['emailnowexists'] = 'כתובת הדוא"ל שניסיתי להקצות לפרופיל שלך מוקצה למשתמש אחר, לכן לא ניתן לבצע את בקשתך לשינוי כתובת הדוא"ל. תוכל לנסות שוב ע"י כתובת דוא"ל אחרת מזאת שניסית.';
$string['emailupdate'] = 'עדכון כתובת דוא"ל';
$string['emailupdatemessage'] = '{$a->fullname} היקר,
לאחר בקשתך לשינוי כתובת דוא"ל עבור חשבון המשתמש שלך באתר {$a->site}, אנא פתח את הקישור הבא בדפדפן שלך לצורך אישור שינוי זה.
{$a->url}';
$string['emailupdatesuccess'] = 'כתובת דוא"ל של משתמש  <em>{$a->fullname}</em>
עודכנה בהצלחה ל-<em>{$a->email}</em>.';
$string['emailupdatetitle'] = 'אישור עבור עדכון הדוא"ל ב-{$a->site}';
$string['enterthenumbersyouhear'] = 'הכנס את המספרים שאתה שומע';
$string['enterthewordsabove'] = 'הכנס את מילים מלמעלה';
$string['errormaxconsecutiveidentchars'] = 'סיסמאות חייבות להכיל לכל   היותר {$a}  תווים זהים רצופים';
$string['errorminpassworddigits'] = 'סיסמאות מחייבות לפחות {$a} ספרהות.';
$string['errorminpasswordlength'] = 'סיסמאות מחייבות אורך של לפחות {$a} תווים.';
$string['errorminpasswordlower'] = 'סיסמאות מחייבות לפחות {$a} אותיות קטנות.';
$string['errorminpasswordnonalphanum'] = 'סיסמאות מחייבות לפחות {$a} תווים שהם לא אלפאנומרים.';
$string['errorminpasswordupper'] = 'סיסמאות מחייבות לפחות {$a} אותיות גדולות.';
$string['errorpasswordupdate'] = 'חלה שגיאה במהלך עדכון הסיסמה, הסיסמה לא שונתה.';
$string['forcechangepassword'] = 'אלץ שינוי סיסמה';
$string['forcechangepassword_help'] = 'אלץ משתמשים לשנות את הסיסמה שלהם בנסיון ההתחברות הבא ל-Moodle.';
$string['forcechangepasswordfirst_help'] = 'אלץ משתמשים לשנות את הסיסמה שלהם בנסיון ההתחברות הראשון ל-Moodle.';
$string['forgottenpassword'] = 'אם תכניס כתובת URL כאן, הדבר ישמש כעמוד שחזור סיסמה אבודה עבור אתר זה. הדבר מעניין לאתרים בהם הסיסמאות מנוהלות לגמרי מחוץ לאתר של ה-Moodle. השאר ריק בכדי להשתמש בשחזור הסיסמה של ברירת המחדל.';
$string['forgottenpasswordurl'] = 'ה-URL של הסיסמה שנשכחה';
$string['getanaudiocaptcha'] = 'קבל את CAPTCHA השמע';
$string['getanimagecaptcha'] = 'קבל את תמונת ה-CAPTCHA';
$string['getanothercaptcha'] = 'קבל CAPTCHA אחר';
$string['guestloginbutton'] = 'כפתור התחברות לאורחים';
$string['incorrectpleasetryagain'] = 'שגיאה. אנא נסה שוב';
$string['infilefield'] = 'שדה נדרש בקובץ';
$string['informminpassworddigits'] = 'לפחות {$a} ספרות';
$string['informminpasswordlength'] = 'לפחות {$a} סימנים';
$string['informminpasswordlower'] = 'לפחות {$a} אותיות קטנות';
$string['informminpasswordnonalphanum'] = 'לפחות {$a} סימנים לא-אלפא מספריים';
$string['informminpasswordupper'] = 'לפחות {$a} אותיות רשיות';
$string['informpasswordpolicy'] = 'בסיסמה צריכים להיות {$a}';
$string['instructions'] = 'הוראות';
$string['internal'] = 'פנימי';
$string['locked'] = 'נעול';
$string['md5'] = 'הצפנת MD5';
$string['nopasswordchange'] = 'לא ניתן היה לשנות את הסיסמה';
$string['nopasswordchangeforced'] = 'אינך יכול להמשיך ללא שינוי הסיסמה שלך. אך נכון לעכשיו אין דף זמין בו ניתן לשנותה. אנא צור קשר עם מנהל המוודל שלך.';
$string['noprofileedit'] = 'לא ניתן לערוך את הפרופיל';
$string['ntlmsso_attempting'] = 'נסיון Single Sign On דרך NTLM...';
$string['ntlmsso_failed'] = 'התחברות אוטומטית נכשלה, נסה את עמוד ההתחברות הרגיל...';
$string['ntlmsso_isdisabled'] = 'NTLM SSO מנוטרל.';
$string['passwordhandling'] = 'טיפול בשדה סיסמה';
$string['plaintext'] = 'טקסט פשוט';
$string['pluginnotenabled'] = 'התוסף המשמש לאימות \'{$a}\' איננו מופעל';
$string['pluginnotinstalled'] = 'התוסף המשמש לאימות \'{$a}\' איננו מותקן';
$string['potentialidps'] = 'התחברות בשימוש חשבונך  ב:';
$string['recaptcha'] = 'reCAPTCHA';
$string['recaptcha_help'] = 'CAPTCHA היא תוכנית היכולה לדעת אם המשתמש שלו הוא אדם או מחשב. CAPTCHAs נמצאים בשימוש על ידי אתרי אינטרנט רבים כדי למנוע ניצול לרעה מ"הרובוטים", או תוכנות אוטומטיות בדרך כלל נכתבות בכדי ליצור ספאם. אף תוכנית מחשב לא יכול לקרוא את הטקסט המעוות כמו גם בני האדם , כדי שהרובוטים לא יוכלו לנווט באתרים מוגנים על ידי CAPTCHAs.
## הוראות
אנא הזן את המילים שאתה רואה בתיבה בסדר, והפרד באמצעות רווח. הדבר עוז בכדי למנוע תוכנות אוטומטיות מלפגוע בשירות זה.
אם אתה לא בטוח מה הן המילים, הזן את הניחוש הטוב ביותר שלך או גש לקישור "קבל עוד CAPTCHA".
משתמשים לקויי ראייה יכולים לעקוב אחר קישור "קבל CAPTCHA שמע" לשמוע סט של ספרות ולהזינם זאת במקום האתגר החזותי.';
$string['selfregistration'] = 'הרשמה עצמית';
$string['selfregistration_help'] = '';
$string['sha1'] = 'SHA-1 hash';
$string['showguestlogin'] = 'אתה יכול להחביא או להראות את כפתור ההתחברות לאורחים בעמוד ההתחברות.';
$string['stdchangepassword'] = 'השתמש בדף שינוי סיסמה סטנדרטי';
$string['stdchangepassword_expl'] = 'אם מערכת האימות החיצונית מאפשרת שינויי סיסמה דרך מוודל, שנה ערך זה ל-כן. הגדרה זו עוקפת את \'כתובת URL לשינוי סיסמה\'.';
$string['stdchangepassword_explldap'] = 'הערה: במידה ושרת ה-LDAP הוא חיצוני מומלץ להשתמש ב-LDAP במקום צינור SSL מוצפן (ldaps://).';
$string['suspended'] = 'חשבון מושהה';
$string['suspended_help'] = 'חשבונות משתמש מושהים אינם יכולים להתחבר למערכת או להתשמש ב-web services כמו כן לא ניתן לשלוח הודעות.';
$string['unlocked'] = 'לא נעול';
$string['unlockedifempty'] = 'לא נעול אם ריק';
$string['update_never'] = 'לעולם לא';
$string['update_oncreate'] = 'בזמן יצירה';
$string['update_onlogin'] = 'בזמן כל התחברות';
$string['update_onupdate'] = 'בזמן עדכון';
$string['user_activatenotsupportusertype'] = 'auth: ldap user_activate()
לא תומך בסוגי משתמש שנבחרו:
{$a}';
$string['user_disablenotsupportusertype'] = 'auth: ldap user_disable()
לא תומך בסוגי משתמש שנבחרו עדיין';
