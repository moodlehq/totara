<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_dbcantconnect'] = 'לא ניתן היה להתחבר לשם אימות לבסיס הנתונים המצוין';
$string['auth_dbchangepasswordurl_key'] = 'כתובת URL המשמשת לשינוי סיסמה';
$string['auth_dbdebugauthdb'] = 'ניפוי ADOdb';
$string['auth_dbdebugauthdbhelp'] = 'ניפוי חיבור ADOdb למסד נתונים מורחב - משתמשים בכך כאשר מקבלים עמוד ריק בעת התחברות. לא מתאים לאתרי ייצור.';
$string['auth_dbdeleteuser'] = 'משתמש מחוק $a[0] מספר זיהוי $a[1]';
$string['auth_dbdeleteusererror'] = 'חלה שגיאה במהלך המחיקה של משתמש $a';
$string['auth_dbdescription'] = 'שיטה זו עושה שימוש בטבלת בסיס נתונים חיצונית כדי לבדוק אם שם משתמש וסיסמה נתונים הינם תקפים. אם החשבון הינו חדש, אז בנוסף, ניתן להעתיק לתוך מוודל נתונים משדות אחרים.';
$string['auth_dbextencoding'] = 'קידוד db חיצוני';
$string['auth_dbextencodinghelp'] = 'הקידוד בו משתמשים בבסיס הנתונים החיצוני';
$string['auth_dbextrafields'] = 'שדות אלו הינם אופציונלים. אתה יכול לבחור למלא מראש חלק משדות המשתמש של Moodle באמצעות נתונים מ<b>שדות בסיס נתונים חיצוני</b> שתגדיר כאן. <br />אם תשאיר שדה זה ריק, אז יופעלו ברירות מחדל .<br />בכל מקרה, המשתמש יוכל לשנות את כל השדות הללו לאחר התחברות.';
$string['auth_dbfieldpass'] = 'שם השדה המכיל סיסמאות';
$string['auth_dbfieldpass_key'] = 'שדה סיסמה';
$string['auth_dbfielduser'] = 'שם השדה המכיל שמות משתמש';
$string['auth_dbfielduser_key'] = 'שדה שם משתמש';
$string['auth_dbhost'] = 'המחשב המארח את שרת בסיס הנתונים.';
$string['auth_dbhost_key'] = 'מחשב מארח';
$string['auth_dbinsertuser'] = 'משתמש משובץ $a[0] מספר זיהוי $a[1]';
$string['auth_dbinsertusererror'] = 'שגיאה במהלך שיבוץ משתמש $a';
$string['auth_dbname'] = 'שם בסיס הנתונים עצמו';
$string['auth_dbname_key'] = 'שם ה-DB';
$string['auth_dbpass'] = 'סיסמה המתאימה לשם המשתמש שמופיע לעיל';
$string['auth_dbpass_key'] = 'סיסמה';
$string['auth_dbpasstype'] = '<p>הגדירו את המבנה ששדה הסיסמה עושה בו שימוש. קידוד MD5 הוא יעיל לשימוש להתחברות לאפליקציות רשת נפוצות נוספות כמו PostNuke..</p> <p>השתמשו ב\'חיצוני\' אם ברצונכם שה-DB החיצוני ינהל את שמות המשתמשים וכתובות הדוא\"ל, בעוד שמוודל ינהל את הסיסמאות. אם אתם משתמשים ב\'פנימי\' <i>חובה</i> עליכם לספק שדה בעל כתובת דוא\"ל מיושבת ב-DB החיצוני, ולהריץ את admin/cron.php על בסיס קבוע. מוודל ישלח למשתמשים חדשים הודעת דוא\"ל ובה סיסמה זמנית. </p>';
$string['auth_dbpasstype_key'] = ' הסיסמה';
$string['auth_dbreviveduser'] = 'משתמש שהוקם מחדש $a[0] מספר זיהוי $a[1]';
$string['auth_dbrevivedusererror'] = 'חלה שגיאה במהלך הקמת המשתמש $a מחדש';
$string['auth_dbsetupsql'] = 'הוראת הגדרת SQL';
$string['auth_dbsetupsqlhelp'] = 'הוראת SQL עבור הגדרת בסיסי נתונים מיוחדים, לרוב משמשת כדי להגדיר קידוד תקשורת - דוגמא עבור MySQL ו-stgreSQL: <em>SET NAMES \'utf8\'</em>';
$string['auth_dbsuspenduser'] = 'משתמש מושהה $a[0] מספר זיהוי $a[1]';
$string['auth_dbsuspendusererror'] = 'חלה שגיאה במהלך השהיית המשתמש $a';
$string['auth_dbsybasequoting'] = 'השתמש בציתותי sybase';
$string['auth_dbsybasequotinghelp'] = 'תו החילוף של גרש בודד (מסוג Sybase) דרוש עבור Orcale, MS SQL ומספר מסדי נתונים אחרים. אל תשתמשו בו עבור MySQL';
$string['auth_dbtable'] = 'שם הטבלה בבסיס הנתונים';
$string['auth_dbtable_key'] = 'טבלה';
$string['auth_dbtitle'] = 'השתמש בבסיס נתונים חיצוני';
$string['auth_dbtype'] = 'סוג בסיס הנתונים (ראה את התיעוד של <a href=\"../lib/adodb/readme.htm#drivers\">ADOdb documentation</a> לפרטים)';
$string['auth_dbtype_key'] = 'בסיס נתונים';
$string['auth_dbupdatinguser'] = 'מעדכן משתמש $a[0] מספר זיהוי $a[1]';
$string['auth_dbuser'] = 'שם משתמש עם גישת קריאה לבסיס הנתונים';
$string['auth_dbuser_key'] = 'משתמש DB';
$string['auth_dbusernotexist'] = 'לא ניתן לעדכן משתמש שאינו קיים: $a';
$string['auth_dbuserstoadd'] = 'רשומות משתמשים שיש להוסיף: $a';
$string['auth_dbuserstoremove'] = 'רשומות משתמשים שיש להסיר: $a';