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
 * Strings for component 'workshop', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   workshop
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'בקרת גישה';
$string['aggregategrades'] = 'חשב ציונים מחדש';
$string['aggregation'] = 'צבור ציונים';
$string['allocate'] = 'הקצה הגשות';
$string['allocatedetails'] = 'צפוי:{$a->expected}<br />
הוגש: {$a->submitted}<br />
להקצבה: {$a->allocate}';
$string['allocation'] = 'הגשות מוקצות';
$string['allocationdone'] = 'ההקצאה התבצעה';
$string['allocationerror'] = 'שגיאה בהקצאה';
$string['allsubmissions'] = 'כל ההגשות';
$string['alreadygraded'] = 'כבר קבל ציון';
$string['areainstructauthors'] = 'הוראות להגשות';
$string['areainstructreviewers'] = 'הוראות להערכה';
$string['areasubmissionattachment'] = 'צירופים להגשה';
$string['areasubmissioncontent'] = 'טקסטים מוגשים';
$string['assess'] = 'מעריך';
$string['assessedexample'] = 'הערכת דוגמת הגשה';
$string['assessedsubmission'] = 'הערכת הגשה';
$string['assessingexample'] = 'הערכה של דוגמת הגשה';
$string['assessingsubmission'] = 'בערכת הגשה';
$string['assessment'] = 'הערכה';
$string['assessmentby'] = 'by <a href="{$a->url}">{$a->name}</a>';
$string['assessmentbyfullname'] = 'הוערך על ידי {$a}';
$string['assessmentbyyourself'] = 'הערכה עצמית';
$string['assessmentdeleted'] = 'בוטלה ההערכת';
$string['assessmentend'] = 'מועד אחרון להערכה';
$string['assessmentenddatetime'] = 'מועד אחרון להערכה: {$a->distanceday}) {$a->daydatetime})';
$string['assessmentendevent'] = '(מועד אחרון להערכה) {$a}';
$string['assessmentform'] = 'טופס הערכה';
$string['assessmentofsubmission'] = '=========';
$string['assessmentreference'] = 'הערכת הסימוכין';
$string['assessmentreferenceconflict'] = 'לא ניתן להעריך הגשת דוגמה שאליה יחסת הערכה.';
$string['assessmentreferenceneeded'] = 'עליך להעריך הגשת דוגמה זאת בכדי לספק הערכת התייחסות. לחצו "המשך" בכדי להעריך את ההגשה.';
$string['assessmentsettings'] = 'הגדרות ההערכה';
$string['assessmentstart'] = 'תחילת ההערכות מ-';
$string['assessmentstartdatetime'] = 'ניתן להערכה מ-{$a->daydatetime} ({$a->distanceday})';
$string['assessmentstartevent'] = '{$a} (פתוח להערכה)';
$string['assessmentweight'] = 'משקל ההערכה';
$string['assignedassessments'] = 'הגשות המוקצות להערכה';
$string['assignedassessmentsnone'] = 'טרם הוקצאו הגשות להערכה';
$string['backtoeditform'] = 'בחזרה לערחכה מ-';
$string['byfullname'] = 'על ידי
<<a href="{$a->url}">{$a->name}</a';
$string['calculategradinggrades'] = 'חשב את ציוני ההערכה';
$string['calculategradinggradesdetails'] = 'צפוי:{$a->expected}<br />מחושב:{$a->calculated}';
$string['calculatesubmissiongrades'] = 'חשב את ציוני ההגשה';
$string['calculatesubmissiongradesdetails'] = 'צפוי:{$a->expected}<br />מחושב:{$a->calculated}';
$string['chooseuser'] = 'בחר משתמש...';
$string['clearaggregatedgrades'] = 'אפס את כל הציונים המצטברים';
$string['clearaggregatedgrades_help'] = 'הציונים שהצטברו להגשה והציונים להערכה יאופסו. אתה יכול לחשב מחדש ציונים אלו מהתחלה בשלב הערכת הציונים.';
$string['clearaggregatedgradesconfirm'] = 'האם אתה בטוח שברצונך לנקות את הציונים שחושבו עבור ההגשות והציונים של ההערכות?';
$string['clearassessments'] = 'אפס את ההערכות';
$string['clearassessments_help'] = 'הציונים שהצטברו להגשה והציונים להערכה יאופסו. המידע כיצד מולאו טפסי ההערכה עדין קיים, אולם יהיה על המב\'קרים לפתוח מחדש את טופס ההערכה ולשמור אותו מחדש בכדי שהציונים יחושבו שנית.';
$string['clearassessmentsconfirm'] = 'האם אתה בטוח שברצונל לאפס את כל ציוני ההערכה? לא תוכל להשיג בכוחות עצמך את המידע מחדש, והמעריכים יהיו חייבים להעריך מחדש את ההגשות שהוקצו.';
$string['configexamplesmode'] = 'ברירת המחדל של הערכת דוגמאות בפעילות הערכות עמיתים';
$string['configgrade'] = 'הציון המירבי להגשות בפעילות הערכות עמיתים';
$string['configgradedecimals'] = 'ברירת המחדל של מספר הספרות שיוצגו לאחר הנקודה העשרונית כאשר מציגים ציונים.';
$string['configgradinggrade'] = 'הציון המירבי להערכות בפעילות הערכות עמיתים';
$string['configmaxbytes'] = 'ברירת המחדל של הערך המירבי של גודל הקובץ שמגישים בכל פעילויות הערכת עמיתים של האתר (תלוי גם בגבולות הקורס והגדרות מקומיות נוספות)';
$string['configstrategy'] = 'אסטרטגית ברירת המחדל של מתן ציונים בפעילות הערכות עמיתים';
$string['createsubmission'] = 'הגש';
$string['daysago'] = 'לפני {$a} ימים';
$string['daysleft'] = 'נשארו {$a} ימים';
$string['daystoday'] = 'היום';
$string['daystomorrow'] = 'מחר';
$string['daysyesterday'] = 'אתמול';
$string['deadlinesignored'] = 'מגבלות הזמן לא חלים עליך';
$string['editassessmentform'] = 'ערוך הגשה מ-';
$string['editassessmentformstrategy'] = 'עריכת הגשה מ-{$a}';
$string['editingassessmentform'] = 'עריכת הגשה מ-';
$string['editingsubmission'] = 'עריכת הגשה';
$string['editsubmission'] = 'עריכת הגשה';
$string['err_multiplesubmissions'] = 'תוך כדי עריכת טופס זה, נשמרה מהדורה אחרת של ההגשה. אסורות הגשות מרובות על ידי משתתף.';
$string['err_removegrademappings'] = 'לא ניתן להסיר מיפוי של ציונים שלא השתשמו בו';
$string['evaluategradeswait'] = 'אנא המתן עד שההערכות יעברו הערכה והציונים יחושבו';
$string['evaluation'] = 'הערכת ציונים';
$string['evaluationmethod'] = 'שיטת הערכת ציונים';
$string['evaluationmethod_help'] = 'שיטת ההערככה של הציונים קובעת איך הציון להערכות מחושב. כרדע יש רק אפשרות אחת - השוואה עם ההערכה הטובה ביותר.';
$string['example'] = 'דוגמת הגשה';
$string['exampleadd'] = 'הוסף דוגמת הגשה';
$string['exampleassess'] = 'הערך דוגמאות הגשה';
$string['exampleassessments'] = 'הערכה של דוגמאות הגשה';
$string['exampleassesstask'] = 'הערך דוגמאות';
$string['exampleassesstaskdetails'] = 'צפוי:{$a->expected}<br />מוערך:{$a->assessed}';
$string['examplecomparing'] = 'השווה הערכות של דוגמאות הגשה';
$string['exampledelete'] = 'מחק דוגמה';
$string['exampledeleteconfirm'] = 'האם אתה בטוח שברצונך למחוק את ההגשה של הדוגמה הנידונה? לחצו "המשך" בכדי למחוק את ההגשה.';
$string['exampleedit'] = 'ערוך את הדוגמה';
$string['exampleediting'] = 'דוגמה לעריכה';
$string['exampleneedassessed'] = 'ראשית כל עליך להעריך את כל דוגמאות ההגשה';
$string['exampleneedsubmission'] = 'חובה עליך להגיש את עבודתך ולהעריך ראשית כל את כל דוגמאות ההגשה';
$string['examplesbeforeassessment'] = 'חובת הערכה של "דוגמאות הגשה" זמינות לאחר ההגשה שלך ולפני שלב הערכת עמיתים';
$string['examplesbeforesubmission'] = 'יש להעריך דוגמאות לפני שמגישים את העבודות שלך';
$string['examplesmode'] = 'סיגנון של הערכת דוגמאות';
$string['examplesubmissions'] = 'הגשות לדוגמא';
$string['examplesvoluntary'] = 'אין חובה לבצע הערכה ל"הגשת דוגמה"';
$string['feedbackauthor'] = 'משוב למחבר';
$string['feedbackby'] = 'משוב על-ידי {$a}';
$string['feedbackreviewer'] = 'משוב לסוקר';
$string['formataggregatedgrade'] = '{$a->grade}';
$string['formataggregatedgradeover'] = '<del>{$a->grade}</del><br /><ins>{$a->over}</ins>';
$string['formatpeergrade'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">>({$a->gradinggrade})</span>';
$string['formatpeergradeover'] = 'span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span>';
$string['formatpeergradeoverweighted'] = 'span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span> @ <span class="weight">{$a->weight}</span>';
$string['formatpeergradeweighted'] = 'span class="grade">{$a->grade}</span> <span class="gradinggrade">>({$a->gradinggrade})</span> @ <span class="weight">{$a->weight}</span>';
$string['givengrades'] = 'הציונים שהוענקו';
$string['gradecalculated'] = 'ציון מחושב להגשה';
$string['gradedecimals'] = 'מספר המקומות העשרוניים בציון';
$string['gradegivento'] = '<';
$string['gradeinfo'] = 'ציון: {$a->received} מ-{$a->max}';
$string['gradeitemassessment'] = '{$a->workshopname} (assessment)';
$string['gradeitemsubmission'] = '{$a->workshopname} (submission)';
$string['gradeover'] = 'ציון עוקף להגשה';
$string['gradereceivedfrom'] = '>';
$string['gradesreport'] = 'דוח ציוני פעילות הערכת עמיתים';
$string['gradinggrade'] = 'ציון ההערכה';
$string['gradinggrade_help'] = 'ההגדרה מציינת את הציון המירבי שניתן לקבלו על ידי הערכת ההגשה.';
$string['gradinggradecalculated'] = 'ציון מחושב להערכה';
$string['gradinggradeof'] = 'ציון להערכה ({$a})';
$string['gradinggradeover'] = 'ציון עוקף להערכה';
$string['gradingsettings'] = 'הגדרות ההערכה';
$string['iamsure'] = 'כן, אני בטוח בכך';
$string['info'] = 'מידע';
$string['instructauthors'] = 'הוראות להגשה';
$string['instructreviewers'] = 'הוראות להערכה';
$string['introduction'] = 'הקדמה';
$string['latesubmissions'] = 'הגשות מאוחרות';
$string['latesubmissions_desc'] = 'הרשה הגשות לאחר המועד הסופי';
$string['latesubmissions_help'] = 'אם מופעל אזי מחברים יכולים להגיש את עבודתם לאחר המועד הסופי או משך שלב ההערכה. אם זאת לא ניתן לערוך הגשות מאוחרות.';
$string['latesubmissionsallowed'] = 'מותרות הגשות מאוחרות';
$string['maxbytes'] = 'גודל מירבי של הקבצים';
$string['modulename'] = 'הערכת עמיתים (סדנה)';
$string['modulenameplural'] = 'הערכות עמיתים (סדנאות)';
$string['mysubmission'] = 'ההגשה שלי';
$string['nattachments'] = 'המספר המירבי של פריטים מצורפים להגשה';
$string['noexamples'] = 'אין עדיין דוגמאות בהערכת עמיתים (סדנה)';
$string['noexamplesformready'] = 'חובה עליך להגדיר את טופס ההערכה לפני שאתה מספק דוגמאות של הגשות';
$string['nogradeyet'] = 'אין עדיין מיון';
$string['nosubmissionfound'] = 'לא נמצאו הגשות של משתמש זה';
$string['nosubmissions'] = 'אין עדיין הגשות בהערכת עמיתים (סדנה) זאת';
$string['notassessed'] = 'עוד לא הוערך';
$string['nothingtoreview'] = 'לא נמצאו הגשות להערכה';
$string['notoverridden'] = 'אין עקיפה';
$string['noworkshops'] = 'בקורס זה אין פעילות הערכות עמיתים (סדנאות)';
$string['noyoursubmission'] = 'עדיין לא הגשת את עבודתך';
$string['nullgrade'] = '-';
$string['page-mod-workshop-x'] = 'עמוד רכיב סדנה כלשהו';
$string['participant'] = 'משתתף';
$string['participantrevierof'] = 'המשתתף הוא מעריך של';
$string['participantreviewedby'] = 'המשתתף מוערך על ידי';
$string['phaseassessment'] = 'שלב הערכות';
$string['phaseclosed'] = 'סגור';
$string['phaseevaluation'] = 'שלב הערכת הציונים';
$string['phasesetup'] = 'שלב הארגון';
$string['phasesubmission'] = 'שלב ההגשה';
$string['pluginadministration'] = 'ניהול הערכת עמיתים (סדנה)';
$string['pluginname'] = 'הערכת עמיתים (סדנה)';
$string['prepareexamples'] = 'הכן דוגמאות הגשה';
$string['previewassessmentform'] = 'הצגה מוקדמת';
$string['publishedsubmissions'] = 'הגשות שפורסמו';
$string['publishsubmission'] = 'פרסם את ההגשה';
$string['publishsubmission_help'] = 'הגשות שפורסמו זמינות לאחרים כאשר פעילות הערכת עמיתים מסתיימת.';
$string['reassess'] = 'הערך מחדש';
$string['receivedgrades'] = 'ציונים שהתקבלו';
$string['recentassessments'] = 'הערכות פעילות הערכת עמיתים';
$string['recentsubmissions'] = 'הגשות פעילות הערכת עמיתים:';
$string['saveandclose'] = 'שמור וסגור';
$string['saveandcontinue'] = 'שמירה והמשך עריכה';
$string['saveandpreview'] = 'שמור וצפה';
$string['selfassessmentdisabled'] = 'ההערה העצמית מנוטרלת';
$string['someuserswosubmission'] = 'יש לפחות מחבר אחד שעדיין לא הגיש את עבודתו';
$string['sortasc'] = 'מיון בסדר עולה';
$string['sortdesc'] = 'מיון בסדר יורד';
$string['strategy'] = 'אסטרטגית הציונים';
$string['strategy_help'] = 'אסטרטגיית הציונים קובעת את טופס ההערכה שישתמשו בו ואת שיוטת הערכת ההגשות. קיימות 4 אפשרויות:
* הערכה מצטברת - הערות וציון ניתנים לגבי מחוונים שצוינו
* הערות - הערות ניתניות לגבי המחוונים שצוינו אך לא ניתן לתת ציון
* מספר השגיאות - הערות והערכת נכון/שגוי ניתנים לגבי המחוונים שצוינו
* הנחיות - רמת ההערכה ניתנת לפי הקרטריונים שנקבעו';
$string['strategyhaschanged'] = 'אסטרטגית הציונים של פעילות הערכת עמיתים השתנתה מאז שהטופס נפתח לשם עריכה.';
$string['submission'] = 'הגשה';
$string['submissionattachment'] = 'נספח';
$string['submissionby'] = 'הוגש על ידי {$a}';
$string['submissioncontent'] = 'תוכן ההגשה';
$string['submissionend'] = 'מועד אחרון להגשות';
$string['submissionenddatetime'] = 'מועד אחרון להגשות: {$a->distanceday} {$a->daydatetime})';
$string['submissionendevent'] = '{$a} (מועד אחרון להגשות)';
$string['submissiongrade'] = 'ציון ההגשה';
$string['submissiongrade_help'] = 'ההגדרה קובעת את הציון המירבי שניתן להשיג לעבודה שהוגשה.';
$string['submissiongradeof'] = 'הציון להגשה (של {$a})';
$string['submissionsettings'] = 'הגדרות ההצגה';
$string['submissionstart'] = 'תחילת מועד ההגשות';
$string['submissionstartdatetime'] = 'הגשות אפשריות מ-{$a->distanceday} {$a->daydatetime})';
$string['submissionstartevent'] = '{$a} (פתוח להגשות)';
$string['submissiontitle'] = 'כותרת';
$string['subplugintype_workshopallocation'] = 'שיטת הקצאת הגשות';
$string['subplugintype_workshopallocation_plural'] = 'שיטות הקצאת הגשות';
$string['subplugintype_workshopeval'] = 'שיטת הערכת ציונים';
$string['subplugintype_workshopeval_plural'] = 'שיטות הערכת ציון';
$string['subplugintype_workshopform'] = 'אסטרטגית הציונים';
$string['subplugintype_workshopform_plural'] = 'אסטרטגיות מתן ציון';
$string['switchingphase'] = 'מחליפים שלב';
$string['switchphase'] = 'החלף שלב';
$string['switchphase10info'] = 'אתה עומד להעביר את הסדנה ל-<strong>שלב הארגון</strong>. בשלב זה אין המשתמשים יכולים לשנות את ההגשות שלהם אןו את ההערכות שלהם. מורים יכולים להשתמש בשלב זה לשנות את הגדרת פעילות הערכת עמיתים, לשנות את אסטרטגית הציונים או לשנות את טפסי ההערכה.';
$string['switchphase20info'] = 'אתה בדרך להעביר את פעילות הערכת העמיתים ל-<strong>שלב הההגשה</strong>. הסטודנטים יכולים להגיש את העבודה משך שלב זה (במסגרת בקרת התאריכים  - באם הוגדרה). מורים יכולים להקצות הגשות לבקרת החברים.';
$string['switchphase30info'] = 'אתה מתעתד להעביר את פעילות הערכת העמיתים ל-<strong>שלב הערכה</strong>. בשלב זה המעריכים יכולים להעריך את ההגשות שהוקצו להם לבדיקה (במסגרת בקרת התאריכים - באם הוגדרה).';
$string['switchphase40info'] = 'אתה מתעתד להעביר את פעילות הערכת העמיתים ל-<strong>שלב הערכת הציונים</strong>. בשלב זה במשתמשים יכולים לשנות את ההגשות שלהם ואת ההערכות שלהם. המורים יכולים  להשתמש בכלי ההערכה לחשב את הציונים הסופיים ולתת משוב למעריכים.';
$string['switchphase50info'] = 'אתה מתעתד לסגור את פעילות הערכת העמיתים. פעולה זאת תגרום לכך שהציונים המחושבים יוכנסו ליומן הציונים. הסטודנטים יכולים לצפותבהגשות שלהם וההערכות של ההגשות.';
$string['taskassesspeers'] = 'הערכת עמיתים';
$string['taskassesspeersdetails'] = 'סך הכל:{$a->total}<br /> עדיין חסר: {$a->todol}';
$string['taskassessself'] = 'הערך את עצמך';
$string['taskinstructauthors'] = 'ספק הוראות להגשה';
$string['taskinstructreviewers'] = 'ספק הוראות להערכה';
$string['taskintro'] = 'הגדר את ההקדמה להערכת עמיתים';
$string['tasksubmit'] = 'הגש את עבודתך';
$string['toolbox'] = 'ארגז הכלים של הערכת עמיתים';
$string['undersetup'] = 'פעילות הערכת העמיתים נמצאת בתהליך בניה. אנא חכה עד שהיא תסתעף לדף הבא.';
$string['useexamples'] = 'השתמש בהגדרות';
$string['useexamples_desc'] = 'הגשות לדוגמא מצורפות עבור תרגול ההערכה';
$string['useexamples_help'] = 'באם מופעל, המשתמשים יכולים לנסות דוגמה אחת או יותר של השגות ולהשוות את ההערכה שלהם עם הערכת סימוכין. הציון לא נכלל בציון הניתן להערכות.';
$string['usepeerassessment'] = 'השתמש בהערכת חברים';
$string['usepeerassessment_desc'] = 'סטודנטים רשאיים להעריך עבודות אחרים';
$string['usepeerassessment_help'] = 'באם מופעל, ניתן להקצות למשתמש הגשות ממשתמשים אחרים לשם הערכה. המשתמש יקבל ציון להערכה שיתווסף לציון שהוא יקבל להגשה שלו.';
$string['userdatecreated'] = 'הוגש ב-<span>{$a}</span>';
$string['userdatemodified'] = 'שונה ב-<span>{$a}</span>';
$string['userplan'] = 'תכנון הערכת עמיתים';
$string['userplan_help'] = 'תכנון הערכת עמיתים מציג את כל השלבים של הפעילות ומונה את כל המשימות לכל שלב. השלב הנוכחי מודגש והשלמת המשימה מסומנת על ידי תג.';
$string['useselfassessment'] = 'השתמש בהערכה עצמית';
$string['useselfassessment_desc'] = 'הסטודנטים רשאים להעריך את עבודתם שלהם';
$string['useselfassessment_help'] = 'באם מופעל, ניתן להקצות למשתמש את ההגשות שלו עצמו להערכה והוא יקבל ציון להערכה שיתווסף לציון שהוא יקבל להגשה שלו.';
$string['weightinfo'] = 'משקל: {$a}';
$string['withoutsubmission'] = 'מעריך ללא הגשה משלו';
$string['workshop:allocate'] = 'נא להקצות הגשות להערכה';
$string['workshop:editdimensions'] = 'ערוך את טפסי ההערכה';
$string['workshop:ignoredeadlines'] = 'התעלם הגבלת זמן';
$string['workshop:manageexamples'] = 'נהל את דוגמאות ההגשה';
$string['workshop:overridegrades'] = 'עקוף ציונים מחושבים';
$string['workshop:peerassess'] = 'הערכת חברים';
$string['workshop:publishsubmissions'] = 'פרסם את ההגשות';
$string['workshop:submit'] = 'הגש';
$string['workshop:switchphase'] = 'החלף';
$string['workshop:view'] = 'צפה בהערכת עמיתים';
$string['workshop:viewallassessments'] = 'צפה בכל הערכות';
$string['workshop:viewallsubmissions'] = 'צפה בכל ההגשות';
$string['workshop:viewauthornames'] = 'צפה בשמות המחברים';
$string['workshop:viewauthorpublished'] = 'צפיה במחברים של ההגשות שפורסמו';
$string['workshop:viewpublishedsubmissions'] = 'צפה בהגשות שפורסמו';
$string['workshop:viewreviewernames'] = 'צפיה בשמות המערכיכים';
$string['workshopfeatures'] = 'תכונות הערכת עמיתים';
$string['workshopname'] = 'שם הערכת עמיתים (סדנה)';
$string['yourassessment'] = 'ההערכה שלך';
$string['yoursubmission'] = 'ההגשה שלך';
