<?php
// enrol_ldap.php - created with Totara langimport script version 1.0

$string['description'] = '<p>You can use an LDAP server to control your enrolments.
It is assumed your LDAP tree contains groups that map to
the courses, and that each of thouse groups/courses will
have membership entries to map to students.</p>
<p>It is assumed that courses are defined as groups in
LDAP, with each group having multiple membership fields
(<em>member</em> or <em>memberUid</em>) that contain a unique
identification of the user.</p>
<p>To use LDAP enrolment, your users <strong>must</strong>
to have a valid idnumber field. The LDAP groups must have
that idnumber in the member fields for a user to be enrolled
in the course.
This will usually work well if you are already using LDAP
Authentication.</p>
<p>Enrolments will be updated when the user logs in. You
can also run a script to keep enrolments in synch. Look in
<em>enrol/ldap/enrol_ldap_sync.php</em>.</p>
<p>This plugin can also be set to automatically create new
courses when new groups appear in LDAP.</p>';
$string['enrol_ldap_autocreate'] = 'المقررات يمكن أن تنشأ بشكل آلي في حال كان التسجيل في مقرر غير موجود';
$string['enrol_ldap_autocreation_settings'] = 'الإعدادات الآلية لإنشاء مقرر';
$string['enrol_ldap_bind_dn'] = 'إذا كنت ترغب في استخدام مستخدم مرتبط للبحث عم المستخدمين، فقم بتحديدها هنا. شيءٌ مثل \'cn=ldapuser,ou=public,o=org\'';
$string['enrol_ldap_bind_pw'] = 'كلمة مرور لمستخدم مرتبط';
$string['enrol_ldap_category'] = 'صنف إنشاء المقررات آلياً';
$string['enrol_ldap_contexts'] = 'LDAP contexts';
$string['enrol_ldap_course_fullname'] = 'اختياري: حقل LDAP للحصول على نموذح اسم كامل.';
$string['enrol_ldap_course_idnumber'] = 'ربط للمعرف التميز في LDAP، وعادةً <em>cn</em> or <em>uid</em>. يوصى بإغلاق القيمة إذا كنت تقوم بإنشاء آلي للمقرر.';
$string['enrol_ldap_course_settings'] = 'اعدادات التسجيل في مقرر دراسي';
$string['enrol_ldap_course_shortname'] = 'خيارى: حقل الـ LDAP للحصول على اسم قصير من';
$string['enrol_ldap_course_summary'] = 'خيارى: حقل الـ LDAP للحصول على ملخص من';
$string['enrol_ldap_editlock'] = 'أغلق القيمة';
$string['enrol_ldap_general_options'] = 'خيارات عامة';
$string['enrol_ldap_host_url'] = 'حدد رابط LDAP ، مثلاً:
\'ldap://ldap.myorg.com/\'
or \'ldaps://ldap.myorg.com/\'';
$string['enrol_ldap_memberattribute'] = 'خصائص أعضاء LDAP';
$string['enrol_ldap_objectclass'] = 'يستخدم objectClass للبحث عن المقررات. وعادةً\'posixGroup\'.';
$string['enrol_ldap_roles'] = 'مطابقة الصلاحيات';
$string['enrol_ldap_search_sub'] = 'البحث عن عضويات مجموعة من subcontexts.';
$string['enrol_ldap_server_settings'] = 'اعدادات سيرفر LDAP';
$string['enrol_ldap_student_contexts'] = 'قائمة السياقات التي توجد بها مجموعات التسجيل مع الطلاب. قم بتقسيم السياقات المتشابهة ب \';\'. على سبيل المثال: 
\'ou=courses,o=org; ou=others,o=org\'';
$string['enrol_ldap_student_memberattribute'] = 'سمة العضو، عندما ينتمي المستخدمين (المسجلين) لمجموعة. وعادة \'member\'
أو \'memberUid\'.';
$string['enrol_ldap_student_settings'] = 'اعدادات تسجيل الطالب';
$string['enrol_ldap_teacher_contexts'] = 'قائمة السياقات التي توجد بها مجموعات التسجيل مع المعلمين. قم بتقسيم السياقات المتشابهة ب \';\'. على سبيل المثال: 
\'ou=courses,o=org; ou=others,o=org\'';
$string['enrol_ldap_teacher_memberattribute'] = 'سمة العضو، عندما ينتمي المستخدمين (المسجلين) لمجموعة. وعادة \'member\'
أو \'memberUid\'.';
$string['enrol_ldap_teacher_settings'] = 'اعدادات تسجيل المعلم';
$string['enrol_ldap_template'] = 'اختياري: المناهج الدراسية المنشئه آلياً يمكن أن تنسخ اعداداتها من قالب مقرر.';
$string['enrol_ldap_updatelocal'] = 'حدث المعلومات المحلية';
$string['enrol_ldap_version'] = 'إن النسخة التي يستخدمها السيرفر الخاص بك هي برتوكول LDAP.';
$string['enrolname'] = 'LDAP';

?>
