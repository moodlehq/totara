<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_changingemailaddress'] = 'ביקשת לשנות את כתובת הדוא\"ל מ-$a->oldemail ל-$a->newemail. מסיבות אבטחה נשלח לך הודעת דוא\"ל לכתובת החדשה בכדי שתאשר אותה. כתובת הדוא\"ל החדשה תעודכן כאשר תלחץ על הקישור בהודעה שנשלחה אליך.';
$string['auth_emailchangecancel'] = 'ביטול שינוי הדוא\"ל';
$string['auth_emailchangepending'] = 'השינוי עומד להתרחש. פתח את הקישור שנשלח אליך ב-$a->preference_newemail';
$string['auth_emaildescription'] = 'אימות דואר אלקטרוני הוא שיטת האימות המשמשת כברירת מחדל. כאשר המשתמש נרשם, ובוחר שם משתמש וסיסמה משלו, לכתובת הדואר האלקטרוני שלו נשלחת הודעת אישור. דואר אלקטרוני זה מכיל קישור מאובטח לעמוד בו המשתמש יכול לאשר את החשבון שלו. התחברויות עתידיות רק בודקות את שם המשתמש והסיסמה כנגד הערכים השמורים בבסיס הנתונים של Moodle.';
$string['auth_emailnoemail'] = 'נכשל ניסיון לשלוח לך הודעת דואר אלקטרוני!';
$string['auth_emailnoinsert'] = 'לא ניתן היה להוסיף את הרשומה שלך לבסיס הנתונים!';
$string['auth_emailnowexists'] = 'כתובת הדוא\"ל שניסיתי להקצות לפרופיל שלך מוקצה למשתמש אחר, לכן לא ניתן לבצע את בקשתך לשינוי כתובת הדוא\"ל. תוכל לנסות שוב ע\"י כתובת דוא\"ל אחרת מזאת שניסית.';
$string['auth_emailrecaptcha'] = 'מוסיף אישור וידאושמע עבור אלמנט לרישום עמוד למשתמשי רישום עצמי בדוא\"ל. הדבר מגן על האתר שלך מפני שליחת דוא\"ל זבל ותורם לסיבה כדאית. ראה  http://recaptcha.net/learnmore.html
לפרטים נוספים.
<br /><em>PHP cURL extension is required.</em>';
$string['auth_emailrecaptcha_key'] = 'אפשר אלמנט reCAPTCHA';
$string['auth_emailsettings'] = 'הגדרות';
$string['auth_emailtitle'] = 'אימות על בסיס דואר אלקטרוני';
$string['auth_emailupdate'] = 'עדכון כתובת דוא\"ל';
$string['auth_emailupdatemessage'] = '$a->fullname היקר,
לאחר בקשתך לשינוי כתובת דוא\"ל עבור חשבון המשתמש שלך באתר $a->site, אנא פתח את הקישור הבא בדפדפן שלך לצורך אישור שינוי זה.
$a->url';
$string['auth_emailupdatesuccess'] = 'כתובת דוא\"ל של משתמש  <em>$a->fullname</em>
עודכנה בהצלחה ל-<em>$a->email</em>.';
$string['auth_emailupdatetitle'] = 'אישור עבור עדכון הדוא\"ל ב-$a->site';
$string['auth_invalidnewemailkey'] = 'שגיאה: אם אתה מנסה לאשר שינוי בכתובת הדוא\"ל, חלה טעות בהעתקת הקישור ה-URL ששלחנו לך בדוא\"ל. אנא העתק שוב את הכתובת ונסה שוב.';
$string['auth_outofnewemailupdateattempts'] = 'תמו מספרי הנסיונות בהם היית רשאי לעדכן את כתובת הדוא\"ל שלך. בקשת עדכון כתובת הדוא\"ל שלך בוטלה.';