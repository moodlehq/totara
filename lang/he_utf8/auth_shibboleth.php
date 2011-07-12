<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_shib_changepasswordurl'] = 'תובת URL לשינוי סיסמה';
$string['auth_shib_convert_data'] = 'התאמת נתוני API';
$string['auth_shib_convert_data_description'] = 'ניתן להשתמש ב-API זה בכדי להתאים את הנתונים שסופקו על ידי שיבולת. קרא את: <a href=\"../auth/shibboleth/README.txt\" target=\"_blank\">README</a> להוראות נוספות.';
$string['auth_shib_convert_data_warning'] = 'הקובץ אינו קיים, או שאינו קריא על ידי תהליך שרת הרשת!';
$string['auth_shib_instructions'] = 'השתמשו <a href=\"$a\">התחברות שיבולת</a> כדי להתחבר דרך שיבולת, אם המוסד שלכם תומך בזה. <br />
אחרת השתמשו בטופס ההתחברות הרגיל שמוצג פה.';
$string['auth_shib_instructions_help'] = 'כאן עליכם לספק למשתמשים שלכם הוראות הפעלה שהתאמתם אישית כדי להסביר את שיבולת. הוראות אלה יופיעו בעמוד ההתחברות, בקטע ההוראות. על ההוראות להכיל קישור ל\"<b>$a</b>\" עליו ילחצו המשתמשים כשהם ירצו להתחבר.';
$string['auth_shib_no_organizations_warning'] = 'אם תרצה להשתמש בשרות WAYF משולב, תצטרך לספק רשימת ספקי זהוי entityIDs המופרדים בפסיק, שמותיהם ובתור אופציה מושב התחלה.';
$string['auth_shib_only'] = 'שיבולת בלבד';
$string['auth_shib_only_description'] = 'ביחרו באפשרות זו אם אתם מעוניינים לאכוף אימות של שיבולת.';
$string['auth_shib_username_description'] = 'שם משתנה סביבת שיבולת בשרת רשת בו שישמש כשם משתמש במוודל.';
$string['auth_shibboleth_contact_administrator'] = 'במקרה ואינך שותף עם הארגונים שניתנו והינך זקוק לגישה לקורס בשרות זה, אנא צור קשר עם';
$string['auth_shibboleth_errormsg'] = 'אנא בחר את הארגון שאתה חבר בו!';
$string['auth_shibboleth_login'] = 'התחברות דרך שיבולת';
$string['auth_shibboleth_login_long'] = 'התחברות ל-Moodle דרך שיבולת';
$string['auth_shibboleth_manual_login'] = 'התחברות ידנית';
$string['auth_shibboleth_select_member'] = 'אני חבר ב...';
$string['auth_shibboleth_select_organization'] = 'לאימות דרך שיבולת אנא בחר את הארגון לו אתה שייך מהרשימה הגולשת.';
$string['auth_shibbolethdescription'] = 'באמצעות שיטה זו משתמשים נוצרים ומאומתים על ידי שימוש ב<a ref=\"http://shibboleth.internet2.edu/\" target=\"_blank\">שיבולת</a>.<br>קיראו את קובץ ה<a href=\"../auth/shibboleth/README.txt\" target=\"_blank\">README</a> של שיבולת, שמסביר כיצד עליכם להגדיר את המוודל שלכם עם שיבולת.';
$string['auth_shibbolethtitle'] = 'שיבולת';
$string['shib_no_attributes_error'] = 'נראה כי אתה מאומת באמצעות שיבולת, אבל מוודל לא קיבל כל תכונות משתמש שהן. אנא וודא שמספק הזהות שלך משחרר את התכונות הדרושות ($a) למספק השרות שמוודל מריץ או שידע את מנהל הרשת של שרת זה.';
$string['shib_not_all_attributes_error'] = 'למוודל דרושות תכונות מסויימות של שיבולת, שבמקרה שלך, לא נמצאות. התכונות הן: $a<br />אנא צור קשר על מנהל הרשת של השרת או עם ספק הזהות שלך.';
$string['shib_not_set_up_error'] = 'לא נראה כי אימות שיבולת מוגדר נכונה זאת מפני ששם משתני סביבת שיבולת לא נוכחים בעמוד זה. אנא התייעץ ב-<a href=\"README.txt\">README</a> על מנת לקבל הוראות נוספות על איך יש להגדיר את האימות דרך שיבולת, או צור קשר עם מנהל הרשת של התקנת מוודל זו.';