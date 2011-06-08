<?PHP // $Id: enrol_imsenterprise.php,v 1.5 2010/11/07 14:20:00 emanuel1 Exp $
      // enrol_imsenterprise.php - created with Moodle 1.9.8+ (Build: 20100407) (2007101580)


$string['aftersaving...'] = 'מרגע ששמרת את ההגדרות שלך, יכול להיות שתרצה ל-';
$string['allowunenrol'] = 'אפשר לנתוני ה- IMS <strong>לבטל את הרשמות</strong> התלמידים או המורים.';
$string['basicsettings'] = 'הגדרות בסיסיות';
$string['coursesettings'] = 'אפשרויות נתוני קורס';
$string['createnewcategories'] = 'אם הן לא נמצאות במוודל, צור קטגוריות קורס חדשות (מוסתרות).';
$string['createnewcourses'] = 'אם הם לא נמצאים במוודל, צור קורסים חדשים (מוסתרים).';
$string['createnewusers'] = 'צור חשבונות משתמשים עבור משתמשים שעדיין לא נרשמו למוודל.';
$string['cronfrequency'] = 'התדירות של העיבוד';
$string['deleteusers'] = 'מחק חשבונות משתמשים כאשר מצוין לעשות כך בנתוני ה-IMS';
$string['description'] = 'שיטה זו תחפש במיקום שתציין אחר מבנה קובץ טקסט מיוחד, ולאחר מכן תעבד אותו, כאשר היא תחזור על פעולות אלה שוב ושוב. הקובץ חייב לעקוב אחר <a href=\'../help.php?module=enrol/imsenterprise&file=formatoverview.html\' target=\'_blank\'>פירוט ההוראות של IMS Enterprise </a> ולהכיל אדם, קבוצה ומרכיבי חברות ב-XML.';
$string['doitnow'] = 'בצא יבוא IMS Enterprise ברגע זה';
$string['enrolname'] = 'קובץ IMS Enterprise';
$string['filelockedmail'] = 'לא ניתן היה למחוק באמצעות תהליך ה-cron את קובץ הטקסט בו אתה משתמש בשביל הרשמות המבוססות על קבצי IMS ($a). לרוב הדבר אומר שההיתרים עליו שגויים.
 אנא תקן את ההיתרים כדי שמוודל יוכל למחוק את הקובץ הנל, אחרת, יכול להיות שהוא יעובד שוב ושוב.';
$string['filelockedmailsubject'] = 'שגיאה חשובה: קובץ הרשמה';
$string['fixcasepersonalnames'] = 'שנה את השמות הפרטיים לאותיות רישיות';
$string['fixcaseusernames'] = 'שנה את שמות המשתמשים לאותיות קטנות';
$string['imsrolesdescription'] = 'פירוט ההוראות של IMS Enterprise כולל בחובו 8 סוגי תפקידים ברורים ונפרדים. אנא בחר באיזה אופן אלה ימונו במוודל ואם יש להתעלם מחלק מהם.';
$string['location'] = 'מיקום הקובץ';
$string['logtolocation'] = 'מיקום הפלט מקובץ יומן המעקב (ריק אם אין יומני מעקב)';
$string['mailadmins'] = 'הודע למנהל על ידי דוא\"ל';
$string['mailusers'] = 'הודע למשתמשים על ידי דוא\"ל';
$string['miscsettings'] = 'שונות';
$string['processphoto'] = 'הוסף לפרופיל את נתון תמונת המשתמש';
$string['processphotowarning'] = 'אזהרה: סביר להניח שתהליך עיבוד התמונות יוסיף עומס משמעותי על השרת. מומלץ שלא להפעיל את אפשרות זו אם תלמידים רבים צפויים לעבור עיבוד.';
$string['restricttarget'] = 'עבד את הנתונים רק כאשר מפורטת המטרה הבאה';
$string['sourcedidfallback'] = 'השתמש ב-&quot;sourcedid&quot בשביל מספר הזיהוי של אדם כלשהו במקרה ששדה ה-&quot;userid&quot; לא נמצא.';
$string['truncatecoursecodes'] = 'קצץ את הקודים של הקורס לאורך הזה';
$string['usecapitafix'] = 'סמן את קופסא זו אם אתה משתמש ב-&quot;Capita&quot; ( פורמט ה-XML שגוי מעט)';
$string['usersettings'] = 'אפשרויות נתוני משתמשים';
$string['zeroisnotruncation'] = '0 מראה על כך שאין קיצוץ';

?>
