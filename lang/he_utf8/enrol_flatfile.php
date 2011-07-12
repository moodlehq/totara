<?PHP // $Id$
      // enrol_flatfile.php - created with Moodle 2.0 dev (Build: 20080327) (2008030700)


$string['description'] = 'שיטה זו תבדוק ותעבד באופן שיטתי קובץ טקסט ש באופן מיוחד במיקום אשר אותו אתה תפרט.
הקובץ הינו קובץ המופרד על ידי פסיק, ומונח כי יש בו ארבעה או שישה שדות בכל שורה:
<pre>
* operation, role, idnumber(user), idnumber(course) [, starttime, endtime]
כאשר:
* operation = add | del (הוסף | מחק)
* role = student | teacher | teacheredit
(סטודנט | מורה | מורהעורך | )
* idnumber(user) = מספר הזיהוי בטבלת המשתמשים NB לא id

* idnumber(course) = מספר הזיהוי בטבלת הקורס NB לא id
* starttime = זמן התחלה (בשניות החל מתקופה ) - נתון לבחירתכם
* endtime = זמן סיום(בשניות החל מתקופה) - נתון לבחירתכם
</pre>
הוא יכול להיראות משהו הדומה לזה:
<pre>
add, student, 5, CF101
add, teacher, 6, CF101
add, teacheredit, 7, CF101
del, student, 8, CF101
del, student, 17, CF101
add, student, 21, CF101, 1091115000, 1091215000
</pre>';
$string['enrolname'] = 'קובץ שטוח';
$string['filelockedmail'] = 'על ידי תהליך ה-cron לא ניתן למחוק את קובץ הטקסט בו אתה משתמש בשביל הרשמות על בסיס קבצים ($a). לרוב זה אומר שההתרים עליו הם שגויים. אנא תקן את ההתרים כדי שמוודל יוכל למחוק את הקובץ, אחרת יכול להיות שהוא יעובד באופן חוזר ונשנה.';
$string['filelockedmailsubject'] = 'טעות חשובה: קובץ הרשמה';
$string['location'] = 'מיקום הקובץ';
$string['mailadmin'] = 'הודע למנהל באמצעות דוא\"ל';
$string['mailusers'] = 'הודע למשתמשים באמצעות דוא\"ל';

?>
