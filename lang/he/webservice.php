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
 * Strings for component 'webservice', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   webservice
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessexception'] = 'חריגת שליטת גישה
Access control';
$string['actwebserviceshhdr'] = 'פרוטוקולים של web service פעילים';
$string['addaservice'] = 'הוסף שירות';
$string['addcapabilitytousers'] = 'בדוק את יכולות המשתמשים';
$string['addcapabilitytousersdescription'] = 'על משתמשים להכיל 2 יכולות:
webservice:createtoken
ויכולת התואמת את שימוש הפרוטוקולים , למשל: webservice/rest:use, webservice/soap:use.
בכדי לבצע זאת עליך ליצור
תפקיד web services
עם יכולות מתאימות לאפשור והקצאה ל-
משתמש web services
כתפקיד המערכת.';
$string['addfunction'] = 'הוסף פונקציה';
$string['addfunctionhelp'] = 'בחר את הפונקיצה אותה תוסיף לשירות';
$string['addfunctions'] = 'הוסף פונקציות';
$string['addfunctionsdescription'] = 'בחר בפונקציות הנדרשות עבור שירות שנוצר הכי חדש.';
$string['addrequiredcapability'] = 'הקצה/הסר הקצאת יכולת נדרשת';
$string['addservice'] = 'הוסף שירות חדש :
{$a->name} (id: {$a->id})';
$string['addservicefunction'] = 'הוסף פונקציות עבור השירות
"{$a}"';
$string['allusers'] = 'כל המשתמשים';
$string['amftestclient'] = 'לקוח
AMF test';
$string['apiexplorer'] = 'API explorer';
$string['apiexplorernotavalaible'] = 'API explorer  לא זמין עדיין';
$string['arguments'] = 'ארגומנטים';
$string['authmethod'] = 'שיטת אימות';
$string['cannotcreatetoken'] = 'אין הרשאות ליצירת web service token עבור השרות {$a}.';
$string['cannotgetcoursecontents'] = 'לא ניתן לקבל תוכן קורס';
$string['checkusercapability'] = 'בדוק את יכולות המשתמש';
$string['checkusercapabilitydescription'] = 'על הסטודנט לקבל יכולות מתאימות עבור ה protocols שמשתמשים, למשל:
webservice/rest:use, webservice/soap:use.
לצורך כך יש ליצורתפקיד  web service עם יכולות של protocol המאפשר ורושם אותו למשתמש של ה- web service כתפקיד מנהלתי.';
$string['configwebserviceplugins'] = 'מסיבות אבטחה, רק פרוטוקולים אשר בשימוש צריכים להיות מאופשרים.';
$string['context'] = 'הקשר (context)';
$string['createservicedescription'] = 'השירות מכיל מערך מתודות של
web service. תוכל לאפשר למשתמש לגשת לשירות חדש. סמן \'אפשור\' ב
<strong>הוספת שירות</strong>
ובאפשרות \'משתמשים מורשים\'.
בחר \'לא נדרשת יכולת\'';
$string['createserviceforusersdescription'] = 'השירות מכיל מערך מתודות של
web service. תוכל לאפשר למשתמשים לגשת לשירות חדש. סמן \'אפשור\' ב <strong>הוספת שירות</strong> ובאפשרות \'משתמשים מורשים\' הסר את הסימון.
\' בחר \'לא נדרשת יכולת';
$string['createtoken'] = 'צור אסימון';
$string['createtokenforuser'] = 'צור אסימון עבור משתמש';
$string['createtokenforuserdescription'] = 'צור אסימון עבור משתמש של ה-
web service';
$string['createuser'] = 'צור משתמש ספציפי';
$string['createuserdescription'] = 'משתמש של web services נדרש לייצג שליטת מערכת Moodle';
$string['default'] = 'ברירת מחדל עבור "{$a}"';
$string['deleteaservice'] = 'מחק שירות';
$string['deleteservice'] = 'מחק את השירות
{$a->name} (id: {$a->id})';
$string['deleteserviceconfirm'] = 'מחיקת השירות תמחק גם את האסימונים הקשורים לשירות זה. האם ברצונך למחוק את שירות חיצוני  "{$a}" ?';
$string['deletetokenconfirm'] = 'האם אכן רצונך למחוק את  אסימון ה-
web service
עבור
<strong>{$a->user}</strong>
בשירות
<strong>{$a->service}</strong>?';
$string['disabledwarning'] = 'כל הפרוטוקולים של ה-web service כבויים. הגדרת "אפשור web service"
יכולה להימצא בהגדרות מאפיינים מתקדמים.';
$string['doc'] = 'תיעוד';
$string['docaccessrefused'] = 'אין לך הרשאה לצפות בתיעוד עבור אסימון זה';
$string['documentation'] = 'תיעוד ה- web service';
$string['downloadfiles'] = 'ניתן להוריד קבצים';
$string['editaservice'] = 'ערוך שירות';
$string['editservice'] = 'ערות את שרות זה:
{$a->name} (id: {$a->id})';
$string['enabled'] = 'מאופשר';
$string['enabledocumentation'] = 'אפשר תיעוד פיתוח';
$string['enabledocumentationdescription'] = 'תיעוד web services מפורטים זמין לפרוטוקולים מאופשרים';
$string['enableprotocols'] = 'אפשר פרוטוקולים';
$string['enableprotocolsdescription'] = 'לפחות פרוטוקול אחד צריך להיות מאופשר. לצורך סיבות אבטחה, רק פרוטוקולים אשר ישתמשו בהם צריכים להיות מאופשרים.';
$string['enablews'] = 'אפשר web services';
$string['enablewsdescription'] = 'web services חייבים להיות מאופשרים בהגדרות המאפיינים המתקדמים';
$string['entertoken'] = 'הכנס אסימוןמפתח אבטחה:';
$string['error'] = 'שגיאה: {$a}';
$string['errorcodes'] = 'הודעת שגיאה';
$string['errorinvalidparam'] = 'הפרמטר "{$a}" לא חוקי';
$string['execute'] = 'הרצה';
$string['executewarnign'] = 'אזהרה: אם תקיש "הרצה" מסד הנתונים שלך ישתנה ושינוי המצב בחזרה לקדמותו לא יוכל להתבצע בצורה אוטומטית';
$string['externalservice'] = 'שירות חיצוני';
$string['externalservicefunctions'] = 'פפונקציות שירות חיצוני';
$string['externalservices'] = 'שירות חיצוני';
$string['externalserviceusers'] = 'משתמשי השירות החיצוני';
$string['failedtolog'] = 'נכשל בנסיון לרשום דוח';
$string['function'] = 'פונקציה';
$string['functions'] = 'פונקציות';
$string['generalstructure'] = 'מבנה כללי';
$string['information'] = 'מידע';
$string['invalidextparam'] = 'פרמטר api חיצוני לא חוקי
{$a}';
$string['invalidextresponse'] = 'תגובת api חיצונית לא חוקית
{$a}';
$string['invalidiptoken'] = 'אסימון לא חוקי - ה-IP שלך לא נתמך';
$string['invalidtimedtoken'] = 'אסימון לא חוקי - פג תוקף האסימון';
$string['invalidtoken'] = 'אסימון לא חוקי  - האסימון לא נמצא';
$string['invalidtokensession'] = 'אסימון מבוסס מושב לא חוקי - המושב לא נמצא או שפג תוקפו';
$string['iprestriction'] = 'הגבלת IP';
$string['iprestriction_help'] = 'המשתמש צריך לקרוא ל-
web service מרשימת ה-IP שמופיעה';
$string['key'] = 'מפתח';
$string['keyshelp'] = 'המפתחות משמשות לגשת לחשבון ה-Moodle שלך מאפליקציות חיצוניות';
$string['manageprotocols'] = 'ניהול פרוטוקולים';
$string['managetokens'] = 'ניהול אסימונים';
$string['missingcaps'] = 'חסרות יכולות';
$string['missingpassword'] = 'חסרה סיסמה';
$string['missingusername'] = 'חסר שם משתמש';
$string['mobilewsdisabled'] = 'כבוי';
$string['mobilewsenabled'] = 'מופעל';
$string['nofunctions'] = 'לשירות אין פונקציות';
$string['norequiredcapability'] = 'לא נדרשת יכולת';
$string['notoken'] = 'רשימת האסימונים ריקה.';
$string['onesystemcontrolling'] = 'אפשר מערכת חיצונית לשליטה ב-Moodle';
$string['operation'] = 'פעולה (ניתוח)';
$string['optional'] = 'אפשרי';
$string['passwordisexpired'] = 'פג תוקף הסיסמה';
$string['phpparam'] = 'XML-RPC (PHP structure)';
$string['phpresponse'] = 'XML-RPC (PHP structure)';
$string['postrestparam'] = 'PHP code for REST (POST request)';
$string['potusers'] = 'משתמשים שאינם מורשים';
$string['potusersmatching'] = 'תוצאות של משתמשים אשר אינם מורשים';
$string['print'] = 'הדפס הכל';
$string['protocol'] = 'פרוטוקול';
$string['removefunction'] = 'הסר';
$string['removefunctionconfirm'] = 'האם אכן ברצונך להסיר את הפונקציה
"{$a->function}" מהשירות
"{$a->service}"';
$string['requireauthentication'] = 'שיטה זו דורשת אימות עם הרשאת
xxx';
$string['required'] = 'נדרש';
$string['requiredcapability'] = 'יכולת נדרשת';
$string['requiredcapability_help'] = 'אם מאופשר, רק משתמשים עם יכולת נדרשת עשויים לגשת לשירות.';
$string['requiredcaps'] = 'יכולות נדרשות';
$string['resettokenconfirm'] = 'האם אכן ברצונך לאפס את מפתח web service  זה למשתמש
<strong>{$a->user}</strong>
בשירות <strong>{$a->service}</strong>?';
$string['resettokenconfirmsimple'] = 'האם אכן ברצונך לאפס את המפתח הזה? כל קישור שנשמר המכיל מפתח ישן לא יעבוד מעתה והלאה.';
$string['response'] = 'תגובה';
$string['restcode'] = 'REST';
$string['restexception'] = 'REST';
$string['restoredaccountresetpassword'] = 'שחזור החשבון מצריך איפוס סיסמה לפני קבלת ה- token';
$string['restparam'] = 'REST (POST parameters)';
$string['restrictedusers'] = 'רק משתמשים מורשים';
$string['securitykey'] = 'מפתח אבטחה (אסימון)';
$string['securitykeys'] = 'מפתחות קוד אבטחה';
$string['selectauthorisedusers'] = 'בחר משתמשים מורשים';
$string['selectedcapability'] = 'נבחרו';
$string['selectedcapabilitydoesntexit'] = 'האפשרות הנוחכית של היכולת הנדרשת  - ({$a}) איננה קיימת.
אנא שנה אותה ושמור את השינויים.';
$string['selectservice'] = 'בחר שירות';
$string['selectspecificuser'] = 'בחר משתמש מסויים';
$string['selectspecificuserdescription'] = 'הוסף את משתמש ה- web services כמשתמש מורשה';
$string['service'] = 'שירות (service)';
$string['servicehelpexplanation'] = 'שירות הוא מערך של פונקציות.
ניתן לגשת לשירות על-ידי כל המשתמשים או משתמשים אשר צויינו מראש.';
$string['servicename'] = 'שם השירות';
$string['servicesbuiltin'] = 'שירותים מובנים מראש';
$string['servicescustom'] = 'שירותים מותאמים אישית';
$string['serviceusers'] = 'משתמשים מורשים';
$string['serviceusersettings'] = 'הגדרות משתמש';
$string['serviceusersmatching'] = 'תוצאות משתמשים מורשים';
$string['serviceuserssettings'] = 'שנה הגדרות עבור משתמשים מורשים';
$string['simpleauthlog'] = 'התחברות מאומתת פשוטה';
$string['step'] = 'צעד';
$string['testclient'] = 'לקוח Web service test';
$string['testwithtestclient'] = 'בדוק את השרות';
$string['token'] = 'אסימון';
$string['tokenauthlog'] = 'אימות אסימון';
$string['tokencreatedbyadmin'] = 'ניתן לאפס רק על-ידי מנהל
(*)';
$string['tokencreator'] = 'יוצר';
$string['unknownoptionkey'] = 'מפתח אפשרות  ({$a}) לא ידוע';
$string['updateusersettings'] = 'עדכון';
$string['userasclients'] = 'משתמשים כלקוחות עם אסימון';
$string['usermissingcaps'] = 'חסרות יכולות: {$a}';
$string['usernameorid'] = 'שם משתמש  מספר זיהוי משתמש ( user id)';
$string['usernameorid_help'] = 'הכנס שם משתמש או מספר זיהוי משתמש (user id)';
$string['usernameoridnousererror'] = 'לא נמצאו משתמשים במתן שם משתמש או מספר זיהוי משתמש זה';
$string['usernameoridoccurenceerror'] = 'נמצאו יותר ממשתמש אחד עם אותו שם משתמש. אנא מסור את מספר זיהוי המשתמש ( user id)';
$string['usernotallowed'] = 'למשתמש זה אין הרשאה עבור שרות זה. יש לאפשר לו הרשאה זו קודם לכם בעמוד הניהול המשתמשים של המערכת';
$string['usersettingssaved'] = 'הגדרות המשתמש נשמרו';
$string['validuntil'] = 'תקף עד';
$string['validuntil_help'] = 'אם מוגדר, השירות יפסיק לפעול עבור המשתמש לאחר תאריך זה.';
$string['webservice'] = 'Web service';
$string['webservices'] = 'Web services';
$string['webservicesoverview'] = 'סקירה';
$string['webservicetokens'] = 'אסימוני Web service';
$string['wrongusernamepassword'] = 'שם משתמש או סיסמה שגויים';
$string['wsauthnotenabled'] = 'תוסף אימות ה-web service לא מאופשר';
$string['wsclientdoc'] = 'תיעוד לקוח web service של Moodle';
$string['wsdocumentation'] = 'תיעוד web service';
$string['wsdocumentationdisable'] = 'תיעוד web service לא מאופשר';
$string['wsdocumentationintro'] = 'בכדי ליצור לקוח , מומלץ לקרוא את זה
{$a->doclink}';
$string['wsdocumentationlogin'] = 'או הכנס את web service שלך , שם משתמש וסיסמה:';
$string['wspassword'] = 'סיסמת ה-Web service';
$string['wsusername'] = 'שם משתמש של ה-Web service';
