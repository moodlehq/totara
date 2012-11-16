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
 * Strings for component 'enrol_authorize', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_authorize
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminacceptccs'] = 'אילו סוגים של כרטיסי אשראי יתקבלו?';
$string['adminaccepts'] = 'בחר את דרכי התשלום המקובלות ואת הסוגים שלהם.';
$string['adminauthorizeccapture'] = 'הגדרות סקירת הזמנה ולכידה-מתוזמנת';
$string['adminauthorizeemail'] = 'הגדרות שליחת דוא"ל';
$string['adminauthorizesettings'] = 'הגדרות Authorize.net';
$string['adminauthorizewide'] = 'הגדרות התקפות לאתר כולו';
$string['adminconfighttps'] = 'אנא וודא "<a href="{$a->url}">שהפעלת את  loginhttps </a>" כדי שתוכל להשתמש בהתקן תקע זה<br /> במנהל>> משתנים>> אבטחה>> אבטחת HTTP.';
$string['adminconfighttpsgo'] = 'לך ל<a href="{$a->url}">עמוד המאובטח</a> על מנת להגדיר את התצורה של התקן תקע זה.';
$string['admincronsetup'] = 'קובץ האצווה שאחראי על התחזוקה של cron.php לא הורץ כבר (לפחות) 24 שעות.<br /> חובה עליך להפעיל את Cron במידה ואתה רוצה להשתמש בתכונת הלכידה המתוזמנת.<br /><b>הפעל</b> את התקן התקע שלAuthorize.net ו<b>הגדר את cron</b> נכונה, או ששוב <b>בטל את הבחירה בan_review</b>.<br />
אם תבטל את תכונת הלכידה המתוזמנת, העיסקאות יבוטלו גם כן, אלא אם תסקור אותם תוך 30 יום.
<br />סמן את <b>an_review</b> והכנס את הערך<b>\'0\' בשדה an_capture_day</b> <br />אם אתה רוצה לקבל או לדחות תשלומים באופן <b>ידני</b> בתוך 30 יום.';
$string['adminemailexpiredsort'] = 'כשלמורה נשלח בדוא"ל מספר ההצעות המחכות להכרעה שפג תוקפן, אילו מהן היא חשובה?';
$string['adminemailexpiredsortcount'] = 'סדר ספירה';
$string['adminemailexpiredsortsum'] = 'סכום כולל';
$string['adminemailexpsetting'] = '(0=מנע שליחת דוא"ל, ברירת מחדל=2, מקסימום=5)<br />הגדרות לכידה ידנית בנוגע לשליחת דוא"ל:
cron=enabled, an_review=checked, an_capture_day=0, an_emailexpired=1-5)';
$string['adminhelpcapturetitle'] = 'יום לכידה מתוכנן';
$string['adminhelpreviewtitle'] = 'סקירת ההזמנה';
$string['adminneworder'] = 'מנהל יקר,
קיבלת הזמנה חדשה שמחכה להכרעה:

מספר הזיהוי של ההזמנה: {$a->orderid}
מספר הזיהוי של העיסקה: {$a->transid}
משתמש: {$a->user}
קורס: {$a->course}
סכום: {$a->amount}

לכידה מתוזמנת מופעלת?: {$a->acstatus}

אם הלכידה המתוזמנת מופעלת אזי כרטיס האשראי יילכד על {$a->captureon} ולאחר מכן המשתמש יירשם לקורס. אחרת, יפוג תוקפה של ההזמנה בתאריך {$a->expireon} ולאחר מכן, לא יהיה ניתן ללכוד אותה.

בנוסף, את יכול לקבל או לדחות את התשלום באופן מיידי באמצעות הקישור הבא:
{$a->url}';
$string['adminnewordersubject'] = '{$a->course}; הזמנה חדשה שמחכה להכרעה: {$a->orderid}';
$string['adminpendingorders'] = 'ניטרלת את תכונת הלכידה המתוזמנת.<br />
כלל {$a->count} העיסקאות בעלות המעמד \'לכידה מאושרת או מחכה להכרעה\' יבוטלו אלא אם כן תסמן אותן.<br />כדי לקבל או לדחות את התשלומים, לך לעמוד <a href=\'{$a->url}\'>הנהלת תשלומים</a>.';
$string['adminteachermanagepay'] = 'מורים יכולים לנהל את התשלומים של הקורס.';
$string['allpendingorders'] = 'כל ההזמנות שמחכות להכרעה';
$string['amount'] = 'סכום';
$string['anauthcode'] = 'השגת authcode';
$string['anauthcodedesc'] = 'אם כרטיס האשראי של המשתמש לא נתפס באינטרנט באופן ישיר, יש להשיג את  קוד ההסמכה דרך הטלפון מבנק הלקוח.';
$string['anavs'] = 'Address Verification System';
$string['ancaptureday'] = 'יום הלכידה';
$string['anemailexpired'] = 'תפוגת ההודעה';
$string['anemailexpireddesc'] = 'הדבר יעיל עבור \'manual-capture\'. מנהלי מערכת מקבלים הודעה על כמות תקופת הימים המצויינת עבור הזמנות הממתינות אשר פג תוקפן.';
$string['anemailexpiredteacher'] = 'הודעת תפוגה - מורה';
$string['anlogin'] = 'Authorize.net: שם התחברות';
$string['anpassword'] = 'Authorize.net: סיסמא';
$string['anreferer'] = 'הגדר את כתובת הURL המפנה, אם הקמת אותה בחשבונך ב- authorize.net. זה ישלח את השורה: "מפנה: כתובת URL" משובצת בתוך web request (בקשת רשת).';
$string['anreview'] = 'סקירה';
$string['anreviewdesc'] = 'סקירת ההזמנה לפני ביצוע סליקת כרטיס האשראי.';
$string['antestmode'] = 'הרץ עיסקאות במצב נסיוני בלבד (לא יימשך כסף)';
$string['antestmodedesc'] = 'הרץ עסקאות במצב נסיון בלבד (לא ימשך כסף)';
$string['antrankey'] = 'Authorize.net: מפתח עיסקה';
$string['approvedreview'] = 'סקירה מאושרת';
$string['authcaptured'] = 'אושר , נלכד';
$string['authcode'] = 'קוד אישור';
$string['authorize:config'] = 'מופעי רישום
Configure Authorize.Net';
$string['authorize:manage'] = 'ניהול משתמשים רשומים';
$string['authorize:managepayments'] = 'נהל תשלומים';
$string['authorize:unenrol'] = 'הסר משתמשים מרישום לקורס';
$string['authorize:unenrolself'] = 'הסר עצמך מרישום לקורס';
$string['authorize:uploadcsv'] = 'העלה קובץ CSV';
$string['authorizedpendingcapture'] = 'לכידה מאושרת  מחכה להכרעה';
$string['authorizeerror'] = 'Authorize.Net Error: {$a}';
$string['avsa'] = 'הכתובת תואמת (רחוב), המיקוד לא';
$string['avsb'] = 'לא סופקו נתוני כתובת';
$string['avse'] = 'שגיאה במערכת אימות הכתובת';
$string['avsg'] = 'בנק מנפיק הכרטיס - לא אמריקאי';
$string['avsn'] = 'אין התאמה לא לכתובת (הרחוב) ולא למיקוד';
$string['avsp'] = 'לא ניתן ליישם את מערכת אימות הכתובת';
$string['avsr'] = 'נסה שנית - המערכת לא זמינה או שחלף זמנה.';
$string['avsresult'] = 'תוצאת מערכת אימות כתובת (AVS): {$a}';
$string['avss'] = 'השירות לא נתמך על ידי המנפיק';
$string['avsu'] = 'נתוני הכתובת לא זמינים';
$string['avsw'] = 'מיקוד בן 9 ספרות תואם, הכתובת (הרחוב) לא.';
$string['avsx'] = 'הכתובת (הרחוב) והמיקוד בן 9 הספרות, תואמים.';
$string['avsy'] = 'הכתובת (הרחוב) והמיקוד בן 5 הספרות, תואמים.';
$string['avsz'] = 'המיקוד בן 5 הספרות תואם, אך הכתובת (הרחוב) לא.';
$string['canbecredit'] = 'את הכסף ניתן להחזיר ל {$a->upto}';
$string['cancelled'] = 'מבוטל';
$string['capture'] = 'לכידה';
$string['capturedpendingsettle'] = 'עיסקה שמחכה להכרעה או שנלכדה';
$string['capturedsettled'] = 'הוכרעה , נלכדה';
$string['captureyes'] = 'כרטיס האשראי יילכד והסטודנט יירשם לקורס. האם אתה בטוח?';
$string['cccity'] = 'ישוב';
$string['ccexpire'] = 'תאריך תפוגה';
$string['ccexpired'] = 'פג תוקפו של כרטיס האשראי';
$string['ccinvalid'] = 'מספר כרטיס  לא חוקי';
$string['cclastfour'] = 'CC last four';
$string['ccno'] = 'מספר כרטיס אשראי';
$string['ccstate'] = 'מדינה';
$string['cctype'] = 'סוג כרטיס אשראי';
$string['ccvv'] = 'אימות כרטיס';
$string['ccvvhelp'] = 'הסתכלו בצד האחורי של הכרטיס (שלושת הספרות האחרונות)';
$string['choosemethod'] = 'אם אתם יודעים את מפתח ההרשמה של הקורס, אנא הקלידו אותו למטה;<br />אחרת, אתם צריכים לשלם עבור הקורס הזה.';
$string['chooseone'] = 'מלאו את אחד מהשדות הבאים, או את שניהם. הסיסמה לא מוצגת.';
$string['cost'] = 'מחיר';
$string['costdefaultdesc'] = '<strong>בהגדרות הקורס, הכניסו-1</strong> כדי להשתמש במחיר ברירת המחדל בשדה מחיר הקורס.';
$string['currency'] = 'מטבע';
$string['cutofftime'] = 'זמן הפסקת העיסקה. כאשר העיסקה האחרונה נבחרת לפירעון?';
$string['cutofftimedesc'] = 'Transaction Cut-Off Time.
מתי הפעם האחרונה שהעסקה נבחרה להסדרה?';
$string['dataentered'] = 'המידע שהוכנס';
$string['delete'] = 'השמד';
$string['description'] = 'מודול Authorize.net  מאפשר לך להגדיר קורסים שמספקי תשלום שילמו עליהם מראש. אם המחיר של קורס כלשהוא הינו אפס, אז לא יידרש תשלום מהסטודנטים עבור הכניסה לקורס. ישנן שתי דרכים להגדיר את מחיר הקורס: (1) מחיר חובק אתר, שמשמש כברירת המחדל לאתר כולו, (2) הגדרת קורס אותה ניתן לשנות עבור כל קורס בנפרד. מחיר הקורס עוקף את מחיר האתר.<br /><br /><b>שימו לב:</b> אם אתם מכניסים מפתח הרשמה בהגדרות הקורס, אז בידי הסטונדטים תהיה גם האפשרות להירשם באמצעות המפתח. אפשרות זו שימושית במקרה שבו יש לכם סטודנטים שנדרשים לשלם וסטודנטים שלא נדרשים לשלם.';
$string['echeckabacode'] = 'מספר ניתוב של המערכת הבנקאית האמריקאית (ABA)';
$string['echeckaccnum'] = 'מספר חשבון בנק';
$string['echeckacctype'] = 'סוג חשבון בנק';
$string['echeckbankname'] = 'שם הבנק';
$string['echeckbusinesschecking'] = 'עובר ושב עיסקי';
$string['echeckchecking'] = 'עובר ושב';
$string['echeckfirslasttname'] = 'בעל חשבון הבנק';
$string['echecksavings'] = 'חסכון';
$string['enrolenddate'] = 'תאריך סיום';
$string['enrolenddaterror'] = 'תאריך סיום הרישום אינו יכול להיות מוקדם יותר מתאריך ההתחלה';
$string['enrolname'] = 'מחשב Gateway (המשמש לחיבור בין שתי רשתות) המשמש לעיבוד תשלומי Authorize.net';
$string['enrolperiod'] = 'תקופת הרישום';
$string['enrolstartdate'] = 'תחילת התאריך';
$string['expired'] = 'פג תוקף';
$string['expiremonth'] = 'חודש תפוגה';
$string['expireyear'] = 'שנת תפוגה';
$string['firstnameoncard'] = 'שם פרטי על הכרטיס';
$string['haveauthcode'] = 'כבר יש בידי קוד מאשר';
$string['howmuch'] = 'כמה?';
$string['httpsrequired'] = 'אנו מצטערים להודיע לך שנכון לרגע זה לא ניתן לעבד את הבקשה שלך. לא ניתן היה להגדיר נכונה את התצורה של האתר.<br /><br /> אנא אל תכניס את מספר כרטיס האשראי שלך אלא אם כן אתה רואה סימן של מנעול צהוב בתחתית הדפדפן. אם הסמל מופיע, משמעותו היא שהעמוד מצפין כל נתון שנשלח בין הלקוח לבין השרת. כלומר, שהנתונים מוגנים בזמן ההעברה בין שני המחשבים, ומכאן שלא ניתן ללכוד את מספר כרטיס האשראי שלך דרך האינטרנט.';
$string['invalidaba'] = 'מספר הניתוב של המערכת הבנקאית האמריקאית (ABA) שגוי';
$string['invalidaccnum'] = 'מספר חשבון שגוי';
$string['invalidacctype'] = 'סוג חשבון שגוי';
$string['isbusinesschecking'] = 'האם העסקה נבדקה?';
$string['lastnameoncard'] = 'שם המשפחה על הכרטיס';
$string['logindesc'] = 'אתה מחוייב להפעיל את אפשרות זו. <br /><br />אנא וודא שהפעלת את <a href="{$a->url}">loginhttps </a> במנהל>> משתנים >> אבטחה.<br /><br />הפעלת אפשרות זו מבטיחה שמוודל ישתמש בחיבור https מאובטח להתחברות ועמודי התשלום בלבד.';
$string['logininfo'] = 'שם ההתחברות, הסיסמה ומפתח העיסקה לא מוצגים עקב אמצעי זהירות ביטחוניים. אין צורך למלא את שדות אלה בשנית אם כבר הגדרת את התצורה של שדות אלה בעבר. במידה וכבר הוגדרה התצורה של שדות מסויימים בעבר, יופיע בצד השמאלי של הקופסא טקסט בצבע ירוק. במידה ואתה ממלא את השדות הללו בפעם הראשונה, חובה עליך לספק שם התחברות (*), ובנוסף <strong>או</strong> את מפתח העיסקה (#1) <strong>או</strong>  את הסיסמה (#2) בקופסא המתאימה. אנו ממליצים למלא את מפתח העיסקה עקב אמצעי זהירות בטחוניים. אם ברצונך למחוק את הסיסמה הנוכחית, סמן את תיבת הסימון.';
$string['messageprovider:authorize_enrolment'] = 'הודעות רישום מ- Authorize.Net';
$string['methodcc'] = 'כרטיס אשראי';
$string['methodccdesc'] = 'בחר כרטיס אשראי וקבל את הסוגים למטה';
$string['methodecheck'] = 'המחאה דיגיטלית (ACH)';
$string['methodecheckdesc'] = 'בחר eCheck  וקבל את הסוגים למטה';
$string['missingaba'] = 'מספר הניתוב של המערכת הבנקאית האמריקאית (ABA) חסר';
$string['missingaddress'] = 'חסרה כתובת';
$string['missingbankname'] = 'חסר שם הבנק';
$string['missingcc'] = 'חסר מספר הכרטיס';
$string['missingccauthcode'] = 'חסר קוד מאשר';
$string['missingccexpiremonth'] = 'חסר חודש תפוגה';
$string['missingccexpireyear'] = 'חסרה שנת תפוגה';
$string['missingcctype'] = 'חסר סוג הכרטיס';
$string['missingcvv'] = 'חסר מיספר אימות';
$string['missingzip'] = 'חסר מיקוד';
$string['mypaymentsonly'] = 'הראה את התשלומים שלי בלבד';
$string['nameoncard'] = 'שם על הכרטיס';
$string['new'] = 'חדש';
$string['nocost'] = 'אין עלות המשוייכת להרשמה בקורס זה דרך
Authorize.Net!';
$string['noreturns'] = 'אין החזרות!';
$string['notsettled'] = 'לא נפרע';
$string['orderdetails'] = 'פרטי ההזמנה';
$string['orderid'] = 'מספר הזיהוי של ההזמנה';
$string['paymentmanagement'] = 'ניהול תשלום';
$string['paymentmethod'] = 'שיטת תשלום';
$string['paymentpending'] = 'התשלום שלך עבור קורס זה מחכה להכרעה עם מספר ההזמנה הזה:  {$a->orderid}. ראה <a href=\'{$a->url}\'>פרטי הזמנה</a>.';
$string['pendingecheckemail'] = 'מנהל יקר,
כרגע ישנן {$a->count} המחאות דיגיטליות שמחכות להכרעה, ועליך להעלות קובץ CSV כדי לרשום את המשתמשים לקורס.

לחץ על הקישור וקרא את קובץ העזרה שנמצא בעמוד:
{$a->url}';
$string['pendingechecksubject'] = '{$a->course}: המחאות דיגיטליות שמחכות להכרעה({$a->count})';
$string['pendingordersemail'] = 'מנהל יקר,
יפוג תוקפן של {$a->pending} עיסקאות עבור הקורס "{$a->course}" אלא אם כן תקבל את התשלום תוך {$a->days} ימים.

זוהי הודעת אזהרה, מפני שלא הפעלת לכידה-מתוזמנת. הדבר אומר שאתה חייב לקבל או לדחות את התשלומים באופן ידני.

כדי לקבל או לדחות את התשלומים שמחכים להכרעה, לך ל:
{$a->url}

כדי להפעיל לכידה-מתוזמנת (מה שאומר שבעתיד לא תקבל הודעות אזהרה בדוא"ל) לך ל: {$a->enrolurl}.';
$string['pendingordersemailteacher'] = 'מורה יקר,

יפוג תוקפן של {$a->pending} עיסקאות שסך תשלומיהן {$a->currency} {$a->sumcost} לקורס "{$a->course}" אלא אם כן תקבל את התשלום שלהן תוך {$a->days} ימים.

עליך לקבל או לדחות את התשלומים באופן ידני שכן המנהל לא הפעיל את האפשרות של לכידה-מתוזמנת.

{$a->url}';
$string['pendingorderssubject'] = 'אזהרה: {$a->course}, יפוג תוקפן של {$a->pending}  הזמנה(ות) תוך {$a->days} ימים.';
$string['pluginname'] = 'Authorize.Net';
$string['reason11'] = 'הוגשה עיסקה זהה.';
$string['reason13'] = 'או שמספר הזהות שמשמש להתחברות של הסוחר אינו תקף, או שהחשבון אינו פעיל.';
$string['reason16'] = 'העיסקה לא נמצאה.';
$string['reason17'] = 'הסוחר לא מקבל כרטיסי אשראי מסוג זה.';
$string['reason245'] = 'לא ניתן להשתמש בסוג זה של המחאה דיגיטלית כאשר משתמשים בטופס התשלום המתארח ב-gateway (המשמש לחיבור בין שתי רשתות).';
$string['reason246'] = 'לא ניתן להשתמש בסוג זה של המחאה דיגיטלית.';
$string['reason27'] = 'העיסקה נסתיימה באי התאמה של מערכת אימות הכתובת (AVS). הכתובת שסופקה לא מתאימה לכתובת שליחת החשבון של בעל הכרטיס.';
$string['reason28'] = 'הסוחר לא מקבל כרטיסי אשראי מסוג זה.';
$string['reason30'] = '(Merchant Service Provider)הגדרת התצורה של מעבד התשלומים אינה תקפה. צרו קשר עם ספק שירותי סליקת כרטיסי האשראי .';
$string['reason39'] = 'או שקוד המטבע שסופק שגוי, או שהוא לא נתמך, או שהוא לא מורשה על ידי סוחר זה, או שאין לו שער חליפין.';
$string['reason43'] = '(Merchant Service Provider) הגדרות התצורה של הספק שגויות. צרו קשר עם ספק שירותי סליקת כרטיסי האשראי';
$string['reason44'] = 'העיסקה הזו נדחתה! שגיאה ברמת מסנן קוד הכרטיס!';
$string['reason45'] = 'העיסקה הזו נדחתה! שגיאה ברמת מסנן קוד הכרטיס או מערכת אימות הכתובת (AVS)!';
$string['reason47'] = 'הסכום שמבוקש לפירעון אינו יכול לעבור מעל לסכום המקורי המאושר.';
$string['reason5'] = 'נדרש סכום תקף.';
$string['reason50'] = 'העיסקה מחכה לפירעון ולא ניתן לקבל עליה החזר כספי.';
$string['reason51'] = 'הסכום של כל פריטי האשראי כנגד עיסקה זו עולה על סכום העיסקה המקורית.';
$string['reason54'] = 'העיסקה הנל אינה עומדת בדרישות להענקת האשראי.';
$string['reason55'] = 'הסכום של כל פריטי האשראי כנגד עיסקה זו עומד לעלות על סכום החיוב המקורי.';
$string['reason56'] = 'סוחר זה מקבל עיסקאות בהמחאות דיגיטליות בלבד (ACH), הוא לא מקבל עיסקאות בכרטיסי אשראי.';
$string['refund'] = 'החזר כספי';
$string['refunded'] = 'ניתן החזר כספי';
$string['returns'] = 'החזרים';
$string['reviewfailed'] = 'הסקירה נכשלה.';
$string['reviewnotify'] = 'יסקרו את התשלום שלך. צפה לקבל דואר אלקטרוני מהמורה שלך תוך כמה ימים.';
$string['sendpaymentbutton'] = 'שלח תשלום';
$string['settled'] = 'נפרע';
$string['settlementdate'] = 'תאריך הפירעון';
$string['shopper'] = 'קונה';
$string['status'] = 'אפשר רישומי Autorize.net';
$string['subvoidyes'] = 'העיסקה שמיועדת להחזר כספי ({$a->transid}) עומדת להתבטל - הדבר יזכה את חשבונך ב {$a->amount}. האם אתה בטוח?';
$string['tested'] = 'נבדק';
$string['testmode'] = '[מצב ניסיוני]';
$string['testwarning'] = 'נראה שלכידה, ביטול, החזרת הכסף עובדות במצב הנסיוני, אבל לא עודכנה או נתווספה אף רשומה לבסיס הנתונים.';
$string['transid'] = 'מספר הזהות של העיסקה';
$string['underreview'] = 'תחת סקירה';
$string['unenrolselfconfirm'] = 'האם ברצונך לבטל עצמך מהרשמה לקורס
"{$a}"?';
$string['unenrolstudent'] = 'הוצא את הסטודנט מרשימת הקורס?';
$string['uploadcsv'] = 'העלה קובץ CSV';
$string['usingccmethod'] = 'הירשם באמצעות <a href="{$a->url}"><strong>כרטיס אשראי </strong></a>';
$string['usingecheckmethod'] = 'הירשם באמצעות <a href="{$a->url}"><strong>המחאה דיגיטליתk</strong></a>';
$string['verifyaccount'] = 'אימות חשבון סוחר ה-authorize.Net';
$string['verifyaccountresult'] = '<b>תוצאת האימות:</b> {$a}';
$string['void'] = 'חסר תוקף';
$string['voidyes'] = 'העיסקה תבוטל, האם אתה בטוח?';
$string['welcometocoursesemail'] = 'סטודנט יקר,

תודה עבור התשלומים שלך. אתה נרשמת לקורסים הבאים:
{$a->courses}
בידיך האפשרות לערוך את הפרופיל שלך:
{$a->profileurl}
בנוסף תוכל לצפות בפרטי התשלומים שלך:
{$a->profileurl}';
$string['youcantdo'] = 'אתה לא יכול לבצע את הפעולה הזו: {$a->action}';
$string['zipcode'] = 'מיקוד';
