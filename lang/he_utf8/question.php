<?PHP // $Id: question.php,v 1.23 2011/04/03 05:30:39 emanuel1 Exp $
      // question.php - created with Moodle 1.9.8+ (Build: 20100407) (2007101580)


$string['adminreport'] = 'דווח על בעיות אפשריות במסד הנתונים של שאלותיך';
$string['broken'] = 'זהו \"קישור שבור\" - הוא מצביע על קובץ שאיננו קיים';
$string['byandon'] = 'על ידי <em>$a->user</em> ב <em>$a->time</em';
$string['categorycurrent'] = 'קטגוריה נוכחית';
$string['categorycurrentuse'] = 'השתמש בקטגוריה זאת';
$string['categorydoesnotexist'] = 'קטגוריה זו לא קיימת';
$string['categorymoveto'] = 'שמור בקטגוריה';
$string['changepublishstatuscat'] = '<a href=\"$a->caturl\">לקטגוריה \"$a->name\"</a>בקורס \"$a->coursename\" יהיה מצב שיתופי שישונה מ<strong>$a->changefrom ל$a->changeto </strong>';
$string['copy'] = 'העתק מ $a ושנה את הקישורים';
$string['created'] = 'נוצר ב-';
$string['createdmodifiedheader'] = 'נוצר/שונה ב-';
$string['cwrqpfs'] = 'בחירה של שאלות אקראיות מתת-קטגוריות.';
$string['cwrqpfsinfo'] = '<p>
בעת העידכון למוודל 1.9 אנו נפריד את קטגוריות השאלה להקשרים שונים. מספר קטגוריות של שאלות ושאלות באתר שלכם יצטרכו לעבור שינוי במצב השיתוף שלהן. הדבר הכרחי במקרים הבודדים שאחת או יותר מהשאלות ה\'אקראיות\' בבוחן הוגדרו שהן נבחרות מתערובת של קטגוריות משותפות וקטגוריות לא משותפות (שזה המצב באתר זה). זה מתרחש כאשר הוחלט לבחור שאלה \'אקראית\' מתת-קטגוריות, ולאחת או יותר תת-הקטגוריות יש מצב שיתוף שונה מקטגורית ה\'אב\' שבה נוצרה השאלה האקראית.
</p>
<p>
בקטגוריות השאלה הבאות, שמהן נבחרו שאלות \'אקראיות\' מקטגוריות ה\'אבות\', יחול שיוני במצב לאותו מצב שיתוף כמו הקטגוריה של השאלה ה\'אקראית\' בעת העידכון למהדורה 1.9. לקטגוריות הבאות ישתנה מצב השיתוף. השאלות שדבר זה יכול עליהן ימשיכו לעבוד בכל הבחנים הקיימים עד שתסירו אותם מבחנים אלו.';
$string['cwrqpfsnoprob'] = 'שום קטגוריות שאלות באתר שלכם איננה מושפעת על ידי השאלות ה\'אקראיות\' הבוחדרות שאלות מתת-קטגוריות.';
$string['defaultfor'] = 'ברירת המחדל עבור $a';
$string['defaultinfofor'] = 'קטגוריית ברירת המחדל לשאלות בהקשר משותף \'$a\'.';
$string['deletecoursecategorywithquestions'] = 'קיימות שאלות בבנק השאלות המשוייכות לקטגוריית קורס זה. אם תמשיך, הן תימחקנה. תוכל להעבירם למקום אחר באמצעות שימוש בבנק השאלות';
$string['donothing'] = 'אל תעתיק או תזיז קבצים או שנה קישורים';
$string['editingcategory'] = 'עריכת קטגוריה';
$string['editingquestion'] = 'עריכת שאלה';
$string['editthiscategory'] = 'עדכן קטגוריה זו';
$string['erroraccessingcontext'] = 'לא מסוגל להתחבר להקשרים';
$string['errordeletingquestionsfromcategory'] = 'שגיאה במחיקת שאלות מקטגוריה $a.';
$string['errorfilecannotbecopied'] = 'שגיאה - לא ניתן להעתיק את קובץ $a';
$string['errorfilecannotbemoved'] = 'שגיאה - לא ניתן להזיז את קובץ $a';
$string['errorfileschanged'] = 'קבצי שגיאה שקושרו משאלות שונו מבעת האחרונה שהטופס הוצג.';
$string['errormanualgradeoutofrange'] = 'הציון $a->grade  לא בין 0 ו- $a->maxgrade עבור השאלה $a->name. הציון והמשום לא נשמרו.';
$string['errormovingquestions'] = 'שגיאה כאשר מעבירים שאלות עם מספרי זהוי הבאים $a.';
$string['errorprocessingresponses'] = 'שגיאה חלה כאשר נעבדו התגובות.';
$string['errorsavingcomment'] = 'שגיאה בשמירת תגובה לשאלה $a->name במסד נתונים זה.';
$string['errorupdatingattempt'] = 'שגיאה בעדכון נסיון $a->id במסד נתונים זה.';
$string['exportcategory'] = 'יצוא קטגוריה';
$string['filesareacourse'] = 'אזור הקבצים של הקורס';
$string['filesareasite'] = 'אזור בקסצים של האתר';
$string['filestomove'] = 'העתק/הסט קבצים ל-$a?';
$string['fractionsnomax'] = 'על אחת מהתשובות להיות בעלת תוצאה של 100%%, כך שזה יהיה אפשרי לקבל את מלוא הניקוד עבור שאלה זו.';
$string['getcategoryfromfile'] = 'קבל קטגוריה מהקובץ';
$string['getcontextfromfile'] = 'קבל הקשר מהקובץ';
$string['ignorebroken'] = 'התעלם מקישורים שבורים';
$string['invalidcontextinhasanyquestions'] = 'מועבר הקשר לא חוקי question_context_has_any_questions.';
$string['linkedfiledoesntexist'] = 'הקובץ המקושר $a לא קיים בספרייה הראשית (ציבורית) של המערכת';
$string['makechildof'] = 'צור תת־קטגוריה  $a';
$string['maketoplevelitem'] = 'הסט לרמה עליונה';
$string['missingimportantcode'] = 'לסוג שאלה זה חסר קוד חשוב: $a.';
$string['modified'] = 'שונה';
$string['move'] = 'הסט מ-$a ושנה את הקישורים';
$string['movecategory'] = 'הסט קטגוריה';
$string['movedquestionsandcategories'] = 'שאלות וקטגוריית שאלות מועברים מ$a->oldplace to $a->newplace.';
$string['movelinksonly'] = 'שנה את ההצבעה של הקישורים, אלח תזיז או תעתיק את הקבצים';
$string['moveq'] = 'שאלות נוספות';
$string['moveqtoanothercontext'] = 'הסט השאלה להקשר';
$string['movingcategory'] = 'הסטת קטגוריה';
$string['movingcategoryandfiles'] = 'האם אתה בטוח שאתה רוצה להעביר את הקטגוריה  {$a->name} וכל צאצאי הקטגוריה לקונטקסט עבור \"{$a->contextto}\"?<br/> הבחנו {$a->urlcount} בקבצים המקושרים משאלות ב{\$a-fromareaname}, האם תרצה להעתיק או להעביר אותם ל{$a->toareaname?';
$string['movingcategorynofiles'] = 'האם אתה בטוח שאתה רוצה להזיז את קטגוריה \"{$a->name}\" וכל צאצאי הקטגוריות להקשר עבור \"{$a->contextto}?';
$string['movingquestions'] = 'הסטת שאלות וכל קובץ שהוא';
$string['movingquestionsandfiles'] = 'האם אתה בטוח שאתה רוצה להעביר שאלות {$a->questions} לקונטקסט עבור <strong>\"{$a->tocontext}\"</strong>?<br /> הבחנו <strong>{$a->urlcount} בקבצים </strong> המקושרים משאלות אלו ב{$a->fromareaname}, האם תרצה להעתיק רו להעביר אותם ל{$a->toareaname}?';
$string['movingquestionsnofiles'] = 'האם אתה בטוח שאתה רוצה להעביר שאלהות {$a->questions} לקונטקסט עבור <strong>\"{$a->tocontext}\"</strong>?<br/> לא נמצאו <strong> כל קבצים</strong> המקושרים משאלות אלו ב{$a->fromareaname}';
$string['needtochoosecat'] = 'עליך לבחור קטגוריה להזיז זאלה זאת אליה או לחץ על \'ביטול\'';
$string['nopermissionadd'] = 'אין לך רשות להוסיף שאלות במקום זה';
$string['nopermissionmove'] = 'אין לך הרשאות להעביר שאלות מכאן. אתה מוכרח לשמור את השאלה בקטגוריה זו או לשמור אותה כשאלה חדשה.';
$string['noprobs'] = 'לא נמצאו בעיות כלשהן עם מסד הנתונים של שאלותיך';
$string['notenoughdatatoeditaquestion'] = 'לא פורטו, לא מספר זיהוי השאלה, לא מספר זיהוי הקטגוריה ולא סוג השאלה.';
$string['notenoughdatatomovequestions'] = 'עליך לספק את מספרי הזיהוי של השאלות שאתה רוצה להזיז';
$string['permissionedit'] = 'ערוך שאלה זאת';
$string['permissionmove'] = 'הסט שאלה זאת';
$string['permissionsaveasnew'] = 'שמור זאת כשאלה חדשה';
$string['permissionto'] = 'יש לך רשות:';
$string['published'] = 'פורסם';
$string['questionaffected'] = '<a href=\"$a->qurl\">שאלה \"$a->name\" ($a->qtype)</a> בקטגורית שאלה זו אך היא גם נלקחת בשימוש ב<a href=\"$a->qurl\"> בוחן \"$a->quizname\"</a> בקורס אחר \"$a->coursename';
$string['questionbank'] = 'מאגר שאלות';
$string['questioncategory'] = 'קטגוריית שאלה';
$string['questioncatsfor'] = 'קטגוריות שאלה עבור \'$a\'';
$string['questiondoesnotexist'] = 'שאלה זו לא קיימת.';
$string['questionsmovedto'] = 'שאלות שבשימוש הועברו ל\"$a\" בקטגוריית קורס האב.';
$string['questionsrescuedfrom'] = 'שאלות נשמרו מקונטקסט $a.';
$string['questionsrescuedfrominfo'] = 'שאלות אלו (כאלו שכנראה הוסתרו) נשמרו כאשר קונטקסט $a נמחקו מפני שהם עדיין בשימוש ע\"י בחנים ופעילויות מסויימות.';
$string['questionuse'] = 'השתמש בשאלה בפעילות זאת';
$string['shareincontext'] = 'העבר לקטגוריה $a';
$string['tofilecategory'] = 'כתוב את הקטגוריה לקובץ';
$string['tofilecontext'] = 'כתוב את ההקשר לקובץ';
$string['unknown'] = 'לא ידוע';
$string['unknownquestiontype'] = 'סוג שאלה לא ידוע: $a.';
$string['unpublished'] = 'לא פורסם';
$string['upgradeproblemcategoryloop'] = 'בעיה הובחנה כאשר עודכנה קטגוריית שאלות. קיימת לולאה בעץ הקטגוריה. מספרי זיהוי הקטגוריה המושפעים הם $a.';
$string['upgradeproblemcouldnotupdatecategory'] = 'לא ניתן היה לעדכן את קטגוריית השאלה $a->name ($a->id).';
$string['upgradeproblemunknowncategory'] = 'בעיה הובחנה כאשר עודכנה קטגוריית שאלות. קטגוריית  $a->id מתייחסת לאב $a->parent אשר איננו קיים. האב שונה לתקן את המצב הנ\"ל.';
$string['yourfileshoulddownload'] = 'קובץ היצוא אמור להתחיל לרדת מייד. אם איננו יורד , אנא לחצו <a href=\"$a\">כאן </a>.';

?>
<?PHP // $Id$
      // question.php - created with Moodle 1.9.5+ (Build: 20090624) (2007101550)



$string['changepublishstatuscat'] = '<a href=\"caturl\">לקטגוריה \"a->name\"</a>בקורס \"$a->coursename\" יהיה סטאטוס שיתופי שישונה מ<strong>$a->changefrom ל$a->changeto </strong>';
$string['deletecoursecategorywithquestions'] = 'קיימות שאלות בבנק השאלות המשוייכות לקטגוריית קורס זה. אם תמשיך, הן תימחקנה. תוכל להעבירם למקום אחר באמצעות שימוש בבנק השאלות';
$string['filesareacourse'] = 'אזור הקבצים של הקורס';
$string['questionaffected'] = '<a href=\"$a->qurl\">שאלה \"$a->name\" ($a->qtype)</a> בקטגורית שאלה זו אך היא גם נלקחת בשימוש ב<a href=\"$a->qurl\"> בוחן \"$a->quizname\"</a> בקורס אחר \"$a->coursename';
$string['questionsmovedto'] = 'שאלות שבשימוש הועברו ל\"$a\" בקטגוריית הקורס האב.';

?>
