<?php
// enrol_ldap.php - created with Totara langimport script version 1.1

$string['description'] = '<p> يمكنك إستخدام سيرفر LDAP للتحكم بتسجيلاتك.
من المفترض أن شجرة LDAP الخاصة بك تحتوي على مجموعات تربط بالمقررات، وكل واحدة من هذه المجموعات والمقررات سيكون لها مدخلات عضوية تربط بلطلاب. </p> 
<p>من المفترض ان المقررات معرفة كمجموعات في LDAP، ومع كل مجموعة يوجد بها حقول عضوية متعددة (<em>member</em> or <em>memberUid</em>) والتي تحتوي على تعريف مميز للمستخدم. </p>
<p>لكي تستخدم تسجيل LDAP، <strong>يجب</strong> أن يكون لدى مستخدمينك حقل رقم معرف صالح. يجب أن يكون لدى مجموعات LDAP رقم المعرف في حقول العضوية للمستخدم لكي يتم تسجيله في المقرر.
ويعمل هذا جيداً في العادة إذا قمت باستخدام صلاحيات LDAP بالفعل.</p>
<p>سيتم تحديث التسجيلات عندما يقوم المستخدم بتسجيل الدخول. يمكنك أيضاً تشغيل سكربت للمحافظة على التسجيل في التزامن. انظر لـ <em>enrol/ldap/enrol_ldap_sync.php</em>.</p>
<p>ويمكن أيضاً وضع هذا المساعد لكي يقوم بإنشاء مقررات جديدة آلياً عندما تظهر مجموعات جديدة في LDAP. </p>';
$string['enrol_ldap_autocreate'] = 'يمكن إنشاء مقررات آلياً إذا كان هناك تسجيلات في المقرر ولا لم تظهر حتى الآن في Moodle.';
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
$string['enrol_ldap_host_url'] = 'تحديد مضيف LDAP URL-form like
\'ldap://ldap.myorg.com/\'
or \'ldaps://ldap.myorg.com/\'';
$string['enrol_ldap_memberattribute'] = 'سمة عضو LDAP';
$string['enrol_ldap_objectclass'] = 'يستخدم objectClass للبحث عن المقررات. وعادةً\'posixGroup\'.';
$string['enrol_ldap_roles'] = 'ربط الدور';
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
