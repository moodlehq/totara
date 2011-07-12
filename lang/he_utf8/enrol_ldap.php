<?PHP // $Id: enrol_ldap.php,v 1.5 2009/06/07 14:29:15 emanuel1 Exp $
      // enrol_ldap.php - created with Moodle 1.9.5 (Build: 20090513) (2007101550)


$string['description'] = '<p>כדי לשלוט בהירשמויות שלכם אתם יכולים להשתמש בשרת LDAP.
אנו מניחים כי עץ ה-LDAP שלכם מכיל קבוצות שממפות אל עבר הקורסים, ושכל אחתד מהקבוצותקורסים הללו יהיו בעלי רשומות חברות שימפו לסטודנטים.</p>
<p>אנו יוצאים מנקודת הנחה שהקורסים ב- LDAP מוגדרים כקבוצות כשלכל קבוצה יש שדות חברות מרובים (<em>member</em> או<em>memberUid</em>) שמכילים זיהוי הייחודי למשתמש.</p>
<p>בכדי להשתמש בהרשמת LDAP, <strong>חובה</strong> על המשתמשים שלכם  להיות בעלי שדה מספר זיהוי תקף.
על מנת שהמשתמש יהיה רשום לקורס חובה שלקבוצות ה-LDAP יהיה את מספר הזיהוי שמופיע בשדות החבר. על פי רוב הדבר יעבוד ללא כל בעיה במידה ואתם כבר משתמשים באימות LDAP .</p>
<p>ההרשמות יעודכנו כאשר המשתמש יתחבר למערכת. בנוסף אתם יכולים להריץ קובץ אצווה כדי לשמור על ההרשמות מסונכרנות.
 הסתכלו ב-
<em>enrol/ldap/enrol_ldap_sync.php</em>.</p>
<p>בנוסף ניתן להגדיר את התקן תקע זה  ליצור קורסים אוטומטית כאשר קבוצות חדשות מופיעות ב- LDAP.</p>';
$string['enrol_ldap_autocreate'] = 'ניתן ליצור קורסים באופן אוטומטי אם יש הרשמות לקורס שעדיין לא קיים במוודל.';
$string['enrol_ldap_autocreation_settings'] = 'הגדרות יצירה אוטומטית של קורסים';
$string['enrol_ldap_bind_dn'] = 'אם ברצונכם להשתמש במשתמש-קשור בשביל לחפש אחר משתמשים,
ציינו זאת כאן. משהו כמו:
\'cn=ldapuser,ou=public,o=org\'';
$string['enrol_ldap_bind_pw'] = 'סיסמה עבור משתמש-קשור';
$string['enrol_ldap_category'] = 'הקטגוריה לקורסים שנוצרו באופן אוטומטי';
$string['enrol_ldap_contexts'] = 'הקשרי LDAP';
$string['enrol_ldap_course_fullname'] = 'לבחירתכם: שדה LDAP ממנו ניתן להשיג את השם המלא.';
$string['enrol_ldap_course_idnumber'] = 'מפה לזיהוי הייחודי ב-LDAP, לרוב:
<em>cn</em> או <em>uid</em>.
מומלץ לנעול את הערך במידה ואתם משתמשים ביצירה אוטומטית של קורסים.';
$string['enrol_ldap_course_settings'] = 'הגדרות הרשמה לקורס';
$string['enrol_ldap_course_shortname'] = 'ניתן לבחירה: שדה LDAP ממנו ניתן להשיג את השם הקצר.';
$string['enrol_ldap_course_summary'] = 'ניתן לבחירה: שדה LDAP ממנו ניתן להשיג את הסיכום.';
$string['enrol_ldap_editlock'] = 'נעל ערך';
$string['enrol_ldap_general_options'] = 'אפשרויות כלליות';
$string['enrol_ldap_host_url'] = 'ציין את המחשב המארח של LDAP בצורת כתובת URL כמו:
\'ldap://ldap.myorg.com/\'
או \'ldaps://ldap.myorg.com/\'';
$string['enrol_ldap_memberattribute'] = 'תכונת החבר של LDAP';
$string['enrol_ldap_objectclass'] = 'objectClass בו משתמשים כדי לחפש בקורסים. לרוב:
\'posixGroup\'';
$string['enrol_ldap_roles'] = 'מיפוי תפקידים';
$string['enrol_ldap_search_sub'] = 'חפשי חברויות בקבוצות מתוך תת-הקשרים';
$string['enrol_ldap_server_settings'] = 'הגדרות שרת LDAP';
$string['enrol_ldap_student_contexts'] = 'רשימה של הקשרים בהם ממוקמות קבוצות בעלות הרשמות תלמידים. הפרידו בין הקשרים שונים באמצעות \';\'. לדוגמא:
\'ou=courses,o=org; ou=others,o=org\'';
$string['enrol_ldap_student_memberattribute'] = 'תכונת חבר, כאשר משתמשים שייכים (רשומים) לקבוצה. לרוב \'member\' או\'memberUid\'.';
$string['enrol_ldap_student_settings'] = 'הגדרות הרשמות סטודנטים';
$string['enrol_ldap_teacher_contexts'] = 'רשימה של הקשרים בהם ממוקמות קבוצות בעלות הרשמות מורים. הפרידו בין הקשרים שונים באמצעות \';\'.
לדוגמא:
\'ou=courses,o=org; ou=others,o=org\'';
$string['enrol_ldap_teacher_memberattribute'] = 'תכונת חבר, כאשר משתמשים שייכים (רשומים) לקבוצה. לרוב \'member\' או\'memberUid\'.';
$string['enrol_ldap_teacher_settings'] = 'הגדרות הרשמות מורים';
$string['enrol_ldap_template'] = 'לבחירתכם: קורסים שנוצרו באופן אוטומטי יכולים להעתיק את ההגדרות שלהם מקורס-תבנית.';
$string['enrol_ldap_updatelocal'] = 'עדכן נתונים מקומיים';
$string['enrol_ldap_version'] = 'גירסת הפרוטוקול של LDAP בה משתמש השרת שלך.';
$string['enrolname'] = 'LDAP';

?>
<?PHP // $Id$
      // enrol_ldap.php - created with Moodle 1.9.5+ (Build: 20090624) (2007101550)



$string['description'] = '<p>כדי לשלוט בהירשמויות שלכם אתם יכולים להשתמש בשרת LDAP.
אנו מניחים כי עץ ה-LDAP שלכם מכיל קבוצות שממפות אל עבר הקורסים, ושכל אחתד מהקבוצות/הקורסים הללו יהיו בעלי רשומות חברות שימפו למשתתפים.</p>
<p>אנו יוצאים מנקודת הנחה שהקורסים ב- LDAP מוגדרים כקבוצות כשלכל קבוצה יש שדות חברות מרובים (<em>member</em> או<em>memberUid</em>) שמכילים זיהוי הייחודי למשתמש.</p>
<p>בכדי להשתמש בהרשמת LDAP, <strong>חובה</strong> על המשתמשים שלכם  להיות בעלי שדה מספר זיהוי תקף.
על מנת שהמשתמש יהיה רשום לקורס חובה שלקבוצות ה-LDAP יהיה את מספר הזיהוי שמופיע בשדות החבר. על פי רוב הדבר יעבוד ללא כל בעיה במידה ואתם כבר משתמשים באימות LDAP .</p>
<p>ההרשמות יעודכנו כאשר המשתמש יתחבר למערכת. בנוסף אתם יכולים להריץ קובץ אצווה כדי לשמור על ההרשמות מסונכרנות.
 הסתכלו ב-
<em>enrol/ldap/enrol_ldap_sync.php</em>.</p>
<p>בנוסף ניתן להגדיר את התקן תקע זה  ליצור קורסים אוטומטית כאשר קבוצות חדשות מופיעות ב- LDAP.</p>';
$string['enrol_ldap_autocreate'] = 'ניתן ליצור קורסים באופן אוטומטי אם יש הרשמות לקורס שעדיין לא קיים במוודל.';
$string['enrol_ldap_autocreation_settings'] = 'הגדרות יצירה אוטומטית של קורסים';
$string['enrol_ldap_category'] = 'הקטגוריה לקורסים שנוצרו באופן אוטומטי';
$string['enrol_ldap_course_idnumber'] = 'מפה לזיהוי הייחודי ב-LDAP, לרוב:
<em>cn</em> או <em>uid</em>.
מומלץ לנעול את הערך במידה ואתם משתמשים ביצירה אוטומטית של קורסים.';
$string['enrol_ldap_course_settings'] = 'הגדרות הרשמה לקורס';
$string['enrol_ldap_student_contexts'] = 'רשימה של הקשרים בהם ממוקמות קבוצות בעלות הרשמות משתתפים. הפרידו בין הקשרים שונים באמצעות \';\'. לדוגמא:
\'ou=courses,o=org; ou=others,o=org\'';
$string['enrol_ldap_student_settings'] = 'הגדרות הרשמות משתתפים';
$string['enrol_ldap_teacher_contexts'] = 'רשימה של הקשרים בהם ממוקמות קבוצות בעלות הרשמות מדריכים. הפרידו בין הקשרים שונים באמצעות \';\'.
לדוגמא:
\'ou=courses,o=org; ou=others,o=org\'';
$string['enrol_ldap_teacher_settings'] = 'הגדרות הרשמות מדריכים';
$string['enrol_ldap_template'] = 'לבחירתכם: קורסים שנוצרו באופן אוטומטי יכולים להעתיק את ההגדרות שלהם מתבנית-קורס.';

?>
