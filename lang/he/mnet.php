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
 * Strings for component 'mnet', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['RPC_HTTPS_SELF_SIGNED'] = 'HTTPS (self-signed)';
$string['RPC_HTTPS_VERIFIED'] = 'HTTPS (signed)';
$string['RPC_HTTP_PLAINTEXT'] = 'HTTP unencrypted';
$string['RPC_HTTP_SELF_SIGNED'] = 'HTTP (self-signed)';
$string['RPC_HTTP_VERIFIED'] = 'HTTP (signed)';
$string['aboutyourhost'] = 'אודות השרת שלך';
$string['accesslevel'] = 'רמת גישה';
$string['addhost'] = 'הוסף מארח';
$string['addnewhost'] = 'הוסף מארח חדש';
$string['addtoacl'] = 'הוסף לבקרת גישה';
$string['allhosts'] = 'כל המארחים';
$string['allhosts_no_options'] = 'כאשר צופים במארחים רבים האפשרויות לא תהיינה זמינות';
$string['allow'] = 'הרשה';
$string['applicationtype'] = 'סוג היישום';
$string['authfail_nosessionexists'] = 'הרשאה נכשלה: מושב ה-mnet לא קיים.';
$string['authfail_sessiontimedout'] = 'הרשאה נכשלה: זמן מושב ה-mnet חלף.';
$string['authfail_usermismatch'] = 'הרשאה נכשלה: המשתמש לא נמצא מתאים.';
$string['authmnetdisabled'] = 'התקן Moodle Networking Authentication
<strong>מנוטרל</strong>.';
$string['badcert'] = 'תעודת-זיהוי שגויה';
$string['certdetails'] = 'פרטי ה-Cert';
$string['configmnet'] = 'MNet  מאפשר תקשורת בשרת זה עם שרתים אחרים או שירותים אחרים.';
$string['couldnotgetcert'] = 'לא נמצאה תעודת-זיהוי ב <br/> {$a}. <br/> המחשב המארח כנראה נפל או שהוגדר שלא כהלכה.';
$string['couldnotmatchcert'] = 'הדבר איננו מתאים לתעודת-זיהוי אשר פורסמה בשרת דפי האינטרנט.';
$string['courses'] = 'קורסים';
$string['courseson'] = 'קורסים ב';
$string['current_transport'] = 'משלוח נוכחי';
$string['currentkey'] = 'מפתח ציבורי נוכחי';
$string['databaseerror'] = 'לא ניתן היה לכתוב פרטים אלו במסד הנתונים';
$string['deleteaserver'] = 'מחיקת שרת';
$string['deletedhostinfo'] = 'מארח זה נמחק. אם תרצה לבטל את המחיקה , החלף את מצב המחיקה חזרה ל"לא".';
$string['deletedhosts'] = 'מאחרים מחוקים: {$a}';
$string['deletehost'] = 'הסר מארח';
$string['deletekeycheck'] = 'האם אתה בטוח כי הינך רוצה למחוק מפתח זה?';
$string['deleteoutoftime'] = 'חלון ה-60 שניות עבור מחיקת מפתח זה פג. אנא התחל שוב.';
$string['deleteuserrecord'] = 'SSO ACL: מחק רשומה למשתמש \'{$a->user}\' מ-{$a->host}.';
$string['deletewrongkeyvalue'] = 'שגיאה התרחשה. אם לא ניסית למחוק את מפתח שרת ה-SSL שלך, יתכן שהותקפת ע"י גורם עויין חיצוני. שום פעולה לא התרחשה.';
$string['deny'] = 'מנע';
$string['description'] = 'תיאור';
$string['duplicate_usernames'] = 'נכשלנו בנסיון ביצירת אינדקס בעמודות "mnethostid" ו- "username" בטבלת המשתמש שלך.<br/> דבר זה יכול לקרות כאשר יש לך <a href="{$a}" target="_blank"> שמות משתמשים כפולים בטבלת המשתמש שלך </a>.<br/> השדרוג שלך עדיין חייב להסתיים בהצלחה. לחץ על הקישור להעיל, והוראות לפתרון הבעיה יופיעו בחלון חדש. תוכל לגשת לזה בסוף השדרוג. <br/>';
$string['enabled_for_all'] = '(שירות זה מאופשר לכל המארחים)';
$string['enterausername'] = 'אנא הכנס שם משתמש או רשימת שמות משתמשים מופרדים ע"י פסיקים.';
$string['error7020'] = 'שגיאה זו בד"כ מתרחשת אם האתר המרוחק יצר רשומה עבורך עם wwwroot שגוי, למשל, http://yoursite.com במקום http://www.yoursite.com. אנא פנה למנהל המערכת של האתר המרוחק עם ה-wwwroot שלך (מוגדר בקובץ ה-config.php) ובקש ממנו לעדכן את הרשומה שלו עבורך.';
$string['error7022'] = 'ההודעה ששלחת לאתר המרוחק קודדה כהלכה אך לא נחתמה. הדבר נחשב כלא צפוי. תצטרך לדווח על באג אם הדבר מתרחש (זאת ע"י מתן אינפורמציה מירבית על גרסאות Moodle)';
$string['error7023'] = 'האתר המרוחק ניסה להסיר את צופן ההודעה באמצעות כל המפתחות שישנן ברשומה עבור האתר שלך. כל הנסיונות נכשלו. תוכל לתקן את שגיאה זו ע"י מתן מפתחות מחדש עם האתר המרוחק. זהו מקרה מאוד לא סביר, אלא אם כן אין לך תקשורת עם האתר המרוחק במשך מספר חודשים.';
$string['error7024'] = 'שלחת הודעה לא מקודדת לאתר המרוחק, אך האת ר המרוחק לא מקבל תקשורת לא מקודדת מהאתר שלך. זהו מקרה מאוד לא סביר. תצטרך לדווח על באג אם הדבר מתרחש (זאת ע"י מתן אינפורמציה מירבית על גרסאות Moodle)';
$string['error7026'] = 'המפתח שהודעתך חתומה עליו שונה מהמפתח שקיים בקובץ עבור השרת שלך במחשב המרוחק. נוסף על כך, המחשב המרוחק ניסה להכניס את המפתח הנוכחי שלך ונכשל. אנא תן מפתח חדש באופן ידני עם המחשב המרוחק (המארח) ונסה שנית.';
$string['error709'] = 'האתר המרוחק נכשל מלהשיג מפתח SSL ממך.';
$string['expired'] = 'המפתח פג ב';
$string['expires'] = 'יחידה תקפה';
$string['expireyourkey'] = 'מחק את מפתח זה';
$string['expireyourkeyexplain'] = 'Moodle מסובב את המפתחות שלל באופן אוטומטי כל 28 ימים (כברירת מחדל). ניתנת לך האפשרות לסיים את תוקף מפתח זה באופן ידני בכל זמן שתרצה. דבר זה יועיל אם מפתח זה בעמדת סכנה. תחליף לכך היווצר אוטומטית באופן מיידי.<br /> מחיקת מפתח זה לא יאפשר למשתמשי Moodle אחרים לתקשר איתך, עד שבאופן ידני תיצור קשר עם כל מנהל מערכת שיש ותספק לו את המפתח החדש שלך.';
$string['exportfields'] = 'שדות ליצוא';
$string['failedaclwrite'] = 'נכשל בנסיון לכתובת לרשימת בקרת גישת MNET .';
$string['findlogin'] = 'מצא התחברות';
$string['forbidden-function'] = 'פונקציה זו לא אופשרה עבור RCP.';
$string['forbidden-transport'] = 'שיטת המשלוח שהינך מנסה להשתמש לא מורשית.';
$string['forcesavechanges'] = 'אלץ שמירת שינויים';
$string['helpnetworksettings'] = 'הגדרת תקשורת inter-Moodle';
$string['hidelocal'] = 'הסתר משתמשים מקומיים';
$string['hideremote'] = 'הסתר משתמשים מרוחקים';
$string['host'] = 'מארח';
$string['hostcoursenotfound'] = 'מארח או קורס לא נמצא';
$string['hostdeleted'] = 'מארחים נמחקו';
$string['hostexists'] = 'רשומה כבר קיימת עבור מארח זה ופריסת Moodle עם ID זיהוי {$a}.
<br/> לחץ על <em> המשך</em> לשם עריכת רשומה זו.';
$string['hostlist'] = 'רשימת מארחים מרושתים';
$string['hostname'] = 'שם מחשב-מארח';
$string['hostnamehelp'] = 'שם התחום (domain) המלא-כשיר של המחשב מארח המרוחק. למשל www.example.com';
$string['hostnotconfiguredforsso'] = 'שרת זה לא מוגדר עבור חיבורים מרוחקים.';
$string['hostsettings'] = 'הגדרות מחשב המארח';
$string['http_self_signed_help'] = 'הרשה חיבורים אשר משתמשים בתעודת-זיהוי-אשר הונפקה באופן עצמאי מסוג DIY SSL במחשב המארח המרוחק.';
$string['http_verified_help'] = 'הרשה חיבורים אשר משתמשים בתעודת-זיהוי מסוג -SSL ב-PHP במחשב המארח המרוחק אך דרך http ולא https.';
$string['https_self_signed_help'] = 'הרשה חיבורים אשר משתמשים ב-self-singed DIY SSL ב-PHP במחשב המארח המרוחק דרך http.';
$string['https_verified_help'] = 'הרשה חיבורים אשר משתמשים בתעודת-זיהוי מסוג -SSL במחשב המארח המרוחק.';
$string['id'] = 'ID';
$string['idhelp'] = 'ערך זה הוקצה אוטומטית ולא ניתן לשנותו';
$string['importfields'] = 'שדות ליבוא';
$string['inspect'] = 'בדוק';
$string['installnosuchfunction'] = 'שגיאת קוד! משהו מנסה להתקין פונקציית  mnet xmlrpc ({$a->method}) מקובץ ({$a->file}) ולא ניתן למצוא אותה!';
$string['installnosuchmethod'] = 'שגיאת קוד! משהו מנסה להתקין פונקציית  mnet xmlrpc ({$a->method})  במחלקה ({$a->class}) ולא ניתן למצוא אותה!';
$string['installreflectionclasserror'] = 'שגיאת קוד!
התבוננות פנימה נכשלהעבור המתודה
\'{$a->method}\'
במחלקה \'{$a->class}\'.
הודעת השגיאה המקורית היא:
\'{$a->error}\'';
$string['installreflectionfunctionerror'] = 'שגיאת קוד!
התבוננות פנימה נכשלהעבור הפונקציה \'{$a->method}\'
בקובץ \'{$a->file}\'.
הודעת השגיאה המקורית היא:
\'{$a->error}\'';
$string['invalidaccessparam'] = 'פרמטר גישה לא חוקי.';
$string['invalidactionparam'] = 'פרמטר פעולה לא חוקי.';
$string['invalidhost'] = 'עליך לספק מזהה מחשב מארח חוקי.';
$string['invalidpubkey'] = 'המפתח אינו מפתח SSL חוקי.';
$string['invalidurl'] = 'פרמטר URL לא חוקית';
$string['ipaddress'] = 'כתובת IP';
$string['is_in_range'] = 'כתובת ה-IP &nbsp;<code>{$a}</code>&nbsp; מייצגת מחשב מארח אמין.';
$string['ispublished'] = '{$a} של Moodle איפשר עבורך את שירות זה.';
$string['issubscribed'] = '{$a} של Moodle רשום לשירות זה במחשב המארח שלך.';
$string['keydeleted'] = 'המפתח נמחק והוחלף בהצלחה.';
$string['keymismatch'] = 'המפתח הציבורי שהינך מחזיק עבור מחשב מארח זה שונה מהמפתח הציבורי הנוכחי שפורסם במחשב המארח.';
$string['last_connect_time'] = 'זמן חיבור אחרון';
$string['last_connect_time_help'] = 'הזמן האחרון שהיית מחובר למחשב אורח זה.';
$string['last_transport_help'] = 'המשלוח שהשתמשת לחיבור האחרוו למחשב מארח זה.';
$string['leavedefault'] = 'השתמש בהגדרות ברירת מחדשל במקום.';
$string['listservices'] = 'רשימת השירותים';
$string['loginlinkmnetuser'] = '<br/>
אם הינך משתמש מרוחק של Moodle Network ואתה יכול <a href="{$a}"> לאשר את כתובת הדוא"ל שלך כאן </a>, תופנה חזרה לעמוד ההתחברות שלך לאתר.';
$string['logs'] = 'יומני מעקב';
$string['managemnetpeers'] = 'ניהול שרתים מרוחקים';
$string['method'] = 'שיטה';
$string['methodhelp'] = 'שיטת עזרה ל-{$a}';
$string['methodsavailableonhost'] = 'שיטות זמינות ב {$a}';
$string['methodsavailableonhostinservice'] = 'שיטות זמינות ל-{$a->service}  ב-
{$a->host}';
$string['methodsignature'] = 'חתימת שיטה ל-{$a}';
$string['mnet'] = 'תקשורת Moodle';
$string['mnet_concatenate_strings'] = 'חבר בשרשרת (עד) 3 מחרוזות והחזר את התוצאה.';
$string['mnet_session_prohibited'] = 'משתמשים משרת הבית שלך לא מורשים כרגע לשוטט ב-{$a}';
$string['mnetdisabled'] = 'Moodle Network  <strong>מנוטרל</strong>';
$string['mnetidprovider'] = 'ספק MNET ID';
$string['mnetidproviderdesc'] = 'תוכל להשתמש במתקן זה לקבל קישור שבו תוכל להתחבר ב, אם תספק את כתובת הדוא"ל שלך אשר יתאים למשתמש, קודם לכן ניסית להתחבר עם.';
$string['mnetidprovidermsg'] = 'תוכל להתחבר דרך ספק ה{$a} שלך.';
$string['mnetidprovidernotfound'] = 'מצטערים, אין מידע נוסף.';
$string['mnetlog'] = 'יומני מעקב';
$string['mnetpeers'] = 'שרתים מרוחקים אשר זמינים';
$string['mnetservices'] = 'שירותים';
$string['mnetsettings'] = 'הגדרות Moodle Network';
$string['moodle_home_help'] = 'הנתיב לדף הבית של Moodle במחשב המארח המרוחק לדוגמא /moodel/';
$string['name'] = 'שם';
$string['net'] = 'תקשורת';
$string['networksettings'] = 'הגדרות תקשורת (Network)';
$string['never'] = 'לעולם לא';
$string['noaclentries'] = 'אין כניסות לרשימת בקרת הגישה ל-SSO';
$string['noaddressforhost'] = 'מצטערים, אך לא ניתן לפתור את שם מארח זה ({$a})';
$string['nocurl'] = 'ספריית Curl של PHP לא מותקנת';
$string['nolocaluser'] = 'לא קיימת רשומה מקומית עבור משתמש מרוחק.';
$string['nomodifyacl'] = 'אינך רשאי לשנות את רשימת בקרת הגישה ל-MNET.';
$string['nonmatchingcert'] = 'נושא תעודת-הזיהוי : <br/><em>{$a->subject}</em><br /> לא מתאים למחשב המארח ממנו הגיע: <br /><em>{$a->host}</em>.';
$string['nopubkey'] = 'התרחשה בעיה בעת קבלת המפתח הציבורי <br /> כנראה שמחשב המארח אינו מרשה את  תקשורת Moodle או שהמפתח אינו תקין.';
$string['nosite'] = 'לא נמצא קורס ברמת האתר.';
$string['nosuchfile'] = 'פונקצית/קובץ {$a} לא קיימת';
$string['nosuchfunction'] = 'לא ניתן למצוא את הפונקציה או שהפונקציה נאסרה עבור RPC.';
$string['nosuchmodule'] = 'הפונקציה הייתה הופנתה שלא כהלכה ולא ניתן היה למצוא אותה. אנא השתמש בתסדיר mod/modulename/lib/functionname.';
$string['nosuchpublickey'] = 'לא ניתן להשיג את המפתח הציבורי לאישור החתימה';
$string['nosuchservice'] = 'שירות ה-RCP לא מופעל במחשב מארח זה.';
$string['nosuchtransport'] = 'אין משלוח עם ה-ID הקיים הזה';
$string['notBASE64'] = 'מחרוזת זו לא בתסדיר קידוד Base64. המחרוזת לא יכולה להיות מפתח תקף.';
$string['notPEM'] = 'מפתח זה לא בתסדיר PEM. הדבר לא יעבוד בצורה תקנית.';
$string['not_in_range'] = 'כתובת ה-IP';
$string['notenoughidpinfo'] = 'זהות הספק שלך לא נותנת מספיק מידע ליצור או לעדכן את החשבון שלך בצורה מקומית. מצטערים.';
$string['notinxmlrpcserver'] = 'נסיון לגשת ללקוח המרוחק של MNet , לא במשך הרחבת שרת XMLRPC .';
$string['notmoodleapplication'] = 'אזהרה: זהו לא יישום Moodle, יתכן כי כמה שיטות  בדיקה לא תעבודנה בצורה תקינה.';
$string['notpermittedtojump'] = 'אין לך הרשאה גישה להתחיל מושב מרוחק משרת Moodle זה.';
$string['notpermittedtojumpas'] = 'לא ניתן להתחיל מושב (session) כאשר אתה מחובר כמשתמש אחר במערכת.';
$string['notpermittedtoland'] = 'אין לך הרשאה גישה להתחיל מושב מרוחק';
$string['off'] = 'כבוי';
$string['on'] = 'פעיל';
$string['options'] = 'אפשרויות';
$string['peerprofilefielddesc'] = 'כאן תוכל לעקוף את ההגדרות המערכתיות עבור כל שדה פרופיל  לשליחה ויבוא כאשר משתמשים חדשים נוצרים.';
$string['permittedtransports'] = 'משלוחים מותרים';
$string['phperror'] = 'שגיאה פנימית של PHP מנעה את בקשתך מלהתבצע.';
$string['position'] = 'עמדה';
$string['postrequired'] = 'הפונקציה שנמחקה מצריכה בקשת POST.';
$string['profileexportfields'] = 'שדות לשליחה';
$string['profilefielddesc'] = 'כאן תוכל להגדיר את רשימת שדות פרופיל אשר נשלחות ומתקבלות דרך MNET כאשר חשבונות המשתמשים נוצרים או מתעדכנים. תוכל לעקוף הגדרות אלו עבור כל עמית MNET בנפרד. דע , כי השדות הבאים נשלחים כל הזמן והם אינם ניתנים לבחירה: {$a}';
$string['profilefields'] = 'שדות פרופיל';
$string['profileimportfields'] = 'שדות ליבוא';
$string['promiscuous'] = 'מופקר';
$string['publickey'] = 'מפתח ציבורי';
$string['publickey_help'] = 'המפתח הציבורי התקבל אוטומטית מהשרת המרוחק.';
$string['publish'] = 'פרסם';
$string['reallydeleteserver'] = 'האם אתה בטוח כי ברצונך למחוק את השרת?';
$string['receivedwarnings'] = 'האזהרות  שלהלן התקבלו.';
$string['recordnoexists'] = 'רשומה לא קיימת.';
$string['reenableserver'] = 'לא - בחר באפשרות זו כדי לאפשר את השרת שוב.';
$string['registerallhosts'] = 'רשום את כל המארחים <em> מצב מופקר
</em>';
$string['registerallhostsexplain'] = 'יש לך האפשרות להירשם לכל המארחים אשר מנסים להתחבר אליך בצורה אוטומטית. משמעות הדבר היא שרשומה תיווצר ברשימת המארחים לכל אתר Moodle אשר מתחבר אליך ומבקש את המפתח הציבורי.<br /> קיימת לך האפשרות למטה לעצב שרותים עבור \'כל המארחים\' ע"י איפשור כמה מן השרותים שם, יש לך את היכולת לספק שרותים לכל שרת Moodle באופן אקראי.';
$string['registerhostsoff'] = 'הרשמת כל המארחים כעת
<b>כבויה</b>';
$string['registerhostson'] = 'הרשמת כל המארחים כעת
<b>פעילה</b>';
$string['remotecourses'] = 'קורסים מרחוק';
$string['remotehost'] = 'מארח מרוחק';
$string['remotehosts'] = 'מחשב מארח מרוחק';
$string['remoteuserinfo'] = 'Remote {$a->remotetype} user - profile fetched from <a href="{$a->remoteurl}">{$a->remotename}</a>';
$string['requiresopenssl'] = 'תקשורת דורשת את הרחבת ה-OpenSSL';
$string['restore'] = 'שחזור';
$string['returnvalue'] = 'החזרת ערך';
$string['reviewhostdetails'] = 'סקירת פרטי המחשב המארח';
$string['reviewhostservices'] = 'סקירת שרותי המחשב המארח';
$string['selectaccesslevel'] = 'אנא בחר רמת גישה מהרשימה';
$string['selectahost'] = 'אנא בחר מחשב Moodle מארח מרוחק';
$string['service'] = 'שם השרות';
$string['serviceid'] = 'מספר זיהוי של השירות';
$string['servicesavailableonhost'] = 'שירותיםי זמינים ב-{$a}';
$string['serviceswepublish'] = 'שרותים אשר פרסמנו ל-{$a}';
$string['serviceswesubscribeto'] = 'שרותים ב-{$a} אשר נרשמנו להם';
$string['settings'] = 'הגדרות';
$string['showlocal'] = 'הצג משתמשים מקומיים';
$string['showremote'] = 'הצג משתמשים מרוחקים';
$string['ssl_acl_allow'] = 'SSO ACL: אפשר משתמש {$a->user} from {$a->host}';
$string['ssl_acl_deny'] = 'SSO ACL: מנע משתמש {$a->user} from {$a->host}';
$string['ssoaccesscontrol'] = 'בקרת גישת SSO';
$string['ssoacldescr'] = 'השתמש בעמוד זה להעניק/למנוע גישה למשתמשים מסויימים ממחשבים מארחים מרוחקים של Moodle Network. הדבר פונקציונלי כאשר מציעים לך שרותי SSO למשתמשים מרוחקים. בכדי לשלוט על היכולת של המשתמשים המקומיים שלך לשוטט למחשבים מארחים של Moodle Network אחרים, השתמש במערכת התפקידים להעניק להם את יכולת ה-<em>mnetcanroam</em>';
$string['ssoaclneeds'] = 'בכדי שתכונה זו תעבוד, אתה חייב להדליק את Moodle Networking On, ובנוסף לאפשר את התקן אימות תקשורת Moodle יחד עם הוספה אוטומטית של משתמשים.';
$string['strict'] = 'מפורש';
$string['subscribe'] = 'הירשם';
$string['system'] = 'מערכת';
$string['testclient'] = 'לקוח נסיון MNET';
$string['testtrustedhosts'] = 'בדוק כתובת';
$string['testtrustedhostsexplain'] = 'הכנס כתובת IP כדי לראות אם מחשב המארח בר אמון.';
$string['theypublish'] = 'הם מפרסמים';
$string['theysubscribe'] = 'הם נרשמו כמנויים';
$string['transport_help'] = 'אפשרויות אלו הופכיות, כך שתוכל להכריח את המחשב המארח המרוחק להשתמש באימות signed SSL אם לשרת שלך קיים אימות signed SSL.';
$string['trustedhosts'] = 'מארחי XML-RPC';
$string['trustedhostsexplain'] = '<p> מנגנון מערכת מחשב המארח המהימנה מאפשרת למחשבים מסויימים לבצע שיחות דרך XML-RPC לכל חלק של Moodle API. דבר זה זמין לסקיפטים בכדי לשלוט בהתנהגות Moodle ואם תאפשר זאת  הדבר עלול להיות מאוד מסוכן. אם אתה בספק השאר אפשרות זאת כבויה.</p>
<p> דבר זה לא שימושי בתקשורת Moodle.</p>
בכדי לאפשר זאת, הכנס רשימה של כתובות IP או רשתות, אחת בכל שורה.
כמה דוגמאות:</p>
Your local host:<br />127.0.0.1<br />Your local host (with a network block):<br />127.0.0.1/32<br />Only the host with IP address 192.168.0.7:<br />192.168.0.7/32<br />Any host with an IP address between 192.168.0.1 and 192.168.0.255:<br />192.168.0.0/24<br />Any host whatsoever:<br />192.168.0.0/0<br />
ברור כי הדוגמא האחרונה <strong> איננה </strong> הגדרה מומלצת.';
$string['turnitoff'] = 'כיבוי';
$string['turniton'] = 'הדלקה';
$string['type'] = 'סוג';
$string['unknown'] = 'לא ידוע';
$string['unknownerror'] = 'שגיאה בלתי ידועה התרחשה במהלך ההתקשרות.';
$string['usercannotchangepassword'] = 'אינך יכול לשנות את סיסמתך כאן בגלל היותך משתמש מרוחק.';
$string['userchangepasswordlink'] = '<br/> תוכל לשנות את סיסמתך אצל<a href="{$a->wwwroot}/login/change_password.php">{$a->description}</a>הספק שלך';
$string['usernotfullysetup'] = 'חשבון המשתמש שלך לא הושלם. אתה צריך לגשת <a href="{$a}"> אחורה לספק שלך</a>  ולוודא כי הפרופיל שלך הושלם שם. יתכן ותצטרך להתנתק ולהתחבר מהאתר עבור תקיפות פעולה זו.';
$string['usersareonline'] = 'אזהרה: {$a} משתמשים משרת זה מחוברים כרגע לאתר שלך.';
$string['validated_by'] = 'מאושר ע"י הרשת
&nbsp;<code>{$a}</code>';
$string['verifysignature-error'] = 'אימות חתימה זה נכשל. התרחשה שגיאה.';
$string['verifysignature-invalid'] = 'אימות החתימה נכשל. כנראה ה-payload לא רשום על שמך.';
$string['version'] = 'גירסה';
$string['warning'] = 'אזהרה';
$string['wrong-ip'] = 'כתובת ה-IP שלך לא מתאימה לכתובת שקיימת לנו ברשומה.';
$string['xmlrpc-missing'] = 'אתה מוכרח להתקין XML-RPC במערכת ה-PHP שלך בכדי שתכונה זאת תעבוד.';
$string['yourhost'] = 'המחשב המארח שלך';
$string['yourpeers'] = 'שרתים מרוחקים אליהם אתה מחובר';
