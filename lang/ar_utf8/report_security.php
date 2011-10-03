<?PHP // $Id$ 
      // report_security.php - created with Moodle 1.9.13 (Build: 20110801) (2007101591.04)


$string['check_configrw_details'] = 'فمن المستحسن أن يتم تغيير أذونات الملف config.php بعد التثبيت بحيث لا يمكن أن يكون تعديل الملف من قبل خادم الويب.
يرجى ملاحظة أن هذا الإجراء لا يحسن الوضع الأمني ​​لخادم الويب بشكل ملحوظ، و لكن قد يؤدي إلى البطء أو الحد من الاستغلال العام.';
$string['check_configrw_name'] = 'config. قابل للكتابة';
$string['check_configrw_ok'] = 'ليس بالإمكان تعديل الملف config.php بواسطة البرامج النصية PHP';
$string['check_configrw_warning'] = 'من الممكن أن يتم تعديل ملف config.php بواسطة البرامج النصية PHP';
$string['check_cookiesecure_details'] = 'إذا فعلت الاتصال بواسطة https فمن الأفضل أن تفعل خدمة تحصين ال(Cookies). يجب عليك أيضا إضافة توجيه دائم من http إلى https.';
$string['check_cookiesecure_error'] = 'الرجاء تفعيل خدمة تحصين ال(cookies)';
$string['check_cookiesecure_name'] = 'cookies محصنة';
$string['check_cookiesecure_ok'] = 'خدمة تحصين ال(cookies) مفعلة لديك';
$string['check_courserole_anything'] = 'خاصية \"doanything\" يجب ألا تكون مسموحة في هذا السياق';
$string['check_courserole_details'] = 'كل دورة لها دور التحاق واحد إفتراضي محدد. يرجى التأكد من عدم السماح لأي قدرات خطرة لهذا الدور. </ P>
<p>نوع التوارث الوحيد المعتمد للدورة الإفتراضية هو <em>الطالب</ EM> </';
$string['check_courserole_error'] = 'تم العثور على أدوار دورات إفتراضية لم تعرف تعريفا صحيحا';
$string['check_courserole_name'] = '(أدوار دورات إفتراضية)';
$string['check_courserole_notyet'] = 'لم يستخدم سوى دور دورات إفتراضية';
$string['check_courserole_ok'] = 'تعريفات أدوار الدورات الإفتراضية صحيحة';
$string['check_courserole_risky'] = 'الكشف عن قدرات خطرة في سياق href=\"$a\"> <a</a>';
$string['check_courserole_riskylegacy'] = 'تم العثور على نوع توارث خطر في <a href=\"$a->url\">$a->shortname</a>.';
$string['check_defaultcourserole_anything'] = 'خاصية \"doanything\" يجب ألا تكون مسموحة في هذا <a href=\"$a\">السياق</a>';
$string['check_defaultcourserole_details'] = 'دورالطالب الإفتراضي للالتحاق بالدورات يحدد الدور الافتراضي للدورات. يرجى التأكد من عدم السماح لأي قدرات خطرة في هذا الدور. </ P>
<p>نوع التوارث الوحيد المعتمد للدور الإفتراضي هو <em>الطالب </ EM> </';
$string['check_defaultcourserole_error'] = 'تم العثور على دور دورة إفتراضي لم يعرف تعريفا صحيحا';
$string['check_defaultcourserole_legacy'] = 'تم العثور على نوع توارث خطر';
$string['check_defaultcourserole_name'] = 'دور دورة إفتراضية موحد';
$string['check_defaultcourserole_notset'] = 'الدور الإفتراضي غير محدد';
$string['check_defaultcourserole_ok'] = 'تعريف الدور الإفتراضي للموقع صحيح';
$string['check_defaultcourserole_risky'] = 'تم العثور على قدرات خطرة في <السياق التالي a href=\"$a\">t</';
$string['check_defaultuserrole_details'] = 'يعطى جميع المستخدمين الموجودين قدرات الدور الإفتراضي للمستخدم. يرجى التأكد عدم من السماح لأي قدرات خطرة في هذا الدور. 
نوع التوارث الوحيد المعتمد لدور المستخدم الإفتراضي هو <em>المستخدم الموثق</em>. يجب عدم تفعيل عرض الدورات.';
$string['check_defaultuserrole_error'] = 'الدور الإفتراضي للمستخدم \"$a\" لم يعرف تعريفا صحيحا';
$string['check_defaultuserrole_name'] = 'الدور الإفتراضي لجميع المستخدمين';
$string['check_defaultuserrole_notset'] = 'لم يحدد الدور الإفتراضي';
$string['check_defaultuserrole_ok'] = 'تعريف الدور الإفتراضي لجميع المستخدمين صحيح';
$string['check_displayerrors_details'] = 'ليس من المستحسن تفعيل <code>display_errors</code> و هو من إعدادات الPHP في مواقع الإنتاج لأن الرسائل الناتجة نتيجة أخطاء قد تحتوي معلومات حساسة عن خادم الويب الخاص بك.';
$string['check_displayerrors_error'] = 'إعداد الPHP لإظهار الأخطاء مفعل. من المستحسن عدم تفعيلها.';
$string['check_displayerrors_name'] = 'إظهار أخطاء الPHP';
$string['check_displayerrors_ok'] = 'إظهار أخطاء الPHP لم يفعل';
$string['check_emailchangeconfirmation_details'] = 'من المستحسن إجبار خطوة التأكد من العناووين البريد الاكتروني عندما يرغب المستخدمون التغيير في عناووينهم في صفحاتهم الشخصية. السبب في ذلك أنه من الممكن أن يستغل الspammers فرصة استخدام خادم الويب التابع لك لإرسال رسائل مزعجة لك. 
من الممكن إغلاق خانة العنوان البريد الاكتروني عن برمجيات التوثيق و لكن هذه القدرة لم تنظر إليها هنا.';
$string['check_emailchangeconfirmation_error'] = 'بامكان المستخدمين إدخال أي عنوان بريد الكتروني';
$string['check_emailchangeconfirmation_info'] = 'بامكان المستخدمين إدخال عناووين البريد الكتروني من الأنطقة المسموحة فقط.';
$string['check_emailchangeconfirmation_name'] = 'تأكيد تغيير عنوان البريد الكتروني';
$string['check_emailchangeconfirmation_ok'] = 'تأكيد تغيير عنوان البريد الكتروني موجود في الصفحة الشخصية للمستخدم';
$string['check_embed_details'] = 'من الخطر عدم تحصير إمكانية إدخال أي عنصر إضافي و ذلك لأن المستخدمين المسجلين قد يشنوا هجوم من النوع XSS على مستخدمي خادم الويب الآخرين. فمن الواجب عدم تفعيل هذه الإمكانية في خوادم الويب الخاصة بالإنتاج.';
$string['check_embed_error'] = 'إمكانية إدخال عناصر إضافية الغير المحدودة مفعلة - في ذلك خطورة على أغلب مستخدمي خوادم الويب.';
$string['check_embed_name'] = 'السماح بEMBED و OBJECT';
$string['check_embed_ok'] = 'لا يسمح بامكانية ادخال عناصر إضافية الغير المحدودة';
$string['check_frontpagerole_details'] = 'الدور الإفتراضي للصفحة الأمامية معطاة لكل المستخدمين المسجلين في نشاطات الصفحة الأمامية. يرجى التأكد عدم من السماح لأي قدرات خطرة في هذا الدور. 
من المستحن تكوين دور خاص لهذا السبب باضافة إلى عدم استخدام نوع توارث.';
$string['check_frontpagerole_error'] = 'تم العثور على تعريف على الدور \"$a\" من أدوار صفحة أمامية لم يعرف تعريفا صحيحا';
$string['check_frontpagerole_name'] = 'دور الصفحة الأمامية';
$string['check_frontpagerole_notset'] = 'لم يحدد دور الصفحة الأمامية';
$string['check_frontpagerole_ok'] = 'تعريف دور الصفحة الأمامية صحيح';
$string['check_globals_details'] = 'العناصر الموحدة المسجلة تعتبر اعداد PHP غير آمن للغاية. 
فمن الواجب تحديد <code>register_globals=off</code> في تكوينات ال PHP. يتم التحكم بهذا الإعداد بواسطة تعديل في الملفات التالية الخاص بك <code>php.ini</code> و  ملف تكوينات الApache/IIS و <code>.htaccess</code f';
$string['check_globals_error'] = 'العناصر الموحدة المسجلة يجب ألا تكون مفعلة. الرجاء اصلاح إعدادات الPHP التابعة لخادم الويب على الفور!';
$string['check_globals_name'] = 'عناصر موحدة مسجلة';
$string['check_globals_ok'] = 'عناصر موحدة مسجلة غير مفعلة.';
$string['check_google_details'] = 'إعداد \"الفتح على Google\" تتيح على محركات البحث الدخول على الدورات بواسطة امكانية الدخول كزوار. ليس من الضرورة تفعيل';
$string['check_google_error'] = 'الوصول إلى محكات البحوث متاح لكل المسخدمين عدا الزوار.';
$string['check_google_info'] = 'بامكان محكات البحوث الدخول كزوار.';
$string['check_google_name'] = 'الفتح على Google';
$string['check_google_ok'] = 'الوصول إلى محكات البحوث غير مفعل.';
$string['check_guestrole_details'] = 'الزوار يستخدم دور الزائر و ليس بواسطة حرية الوصول لدى المستخدمين المسجلين الدخول و لا بحرية الوصول المؤقت للزوار. يرجى التأكد عدم من السماح لأي قدرات خطرة في هذا الدور. نوع التوارث الوحيد المعتمد لدور الزائر هو<em>زائر</em>.';
$string['check_guestrole_error'] = 'دور الزائر \"$a\" لم يعرف تعريفا صحيحا';
$string['check_guestrole_name'] = 'دور زائر';
$string['check_guestrole_notset'] = 'لم يحدد دور الزائر';
$string['check_guestrole_ok'] = 'تعريف دور الزائر صحيح';
$string['check_mediafilterswf_details'] = 'من الخطر  تمكين إدخال عناصر swf  تلقائيا و ذلك لأن المستخدمين المسجلين قد يشنوا هجوم من النوع XSS على مستخدمي خادم الويب الآخرين. فمن الواجب عدم تفعيل هذه الإمكانية في خوادم الويب الخاصة بالإنتاج.';
$string['check_mediafilterswf_error'] = 'فلتر وسائل إعلام الFlash مفعل - في ذلك خطورة على أغلب مستخدمي خوادم الويب.';
$string['check_mediafilterswf_name'] = 'تم تفعيل فلتر وسائل إعلام الswf.';
$string['check_mediafilterswf_ok'] = 'لم يتم تفعيل فلتر وسائل إعلام الswf.';
$string['check_noauth_details'] = 'برمجيات <em>اللا توثيق</em> غير مقصود لاستخدامها في مواقع الإنتاج. الرجاء عدم تفعيلها إلا في حال أن الموقع المستخدم هو موقع تنمية تجريبي .';
$string['check_noauth_error'] = 'لا يمكن استخدام برمجيات اللا توثيق في مواقع الإنتاج';
$string['check_noauth_name'] = 'لا توثيق';
$string['check_noauth_ok'] = 'برمجيات اللا توثيق غير مفعلة';
$string['check_openprofiles_details'] = 'بامكان الspammers الاساءة في استخدام امانية فتح صفحات المستخدمين الشخصية. فمن المستحسن تفعيل <code/>إجبار المستخدمين على تسخيل الدخول للصفحات الشخصية</code> أو <code>إجبار المستخدمين على تسخيل الدخول </code> .';
$string['check_openprofiles_error'] = 'بالإمكان الإطلاع على الصفحات الشخصية دون تسجيل الدخول';
$string['check_openprofiles_name'] = 'فتح الصفحات المستخدمين الشخصية';
$string['check_openprofiles_ok'] = 'من الضروري تسجيل الدخول قبل الإطلاع على صفحات المستخدمين الشخصية';
$string['check_passwordpolicy_details'] = 'من المستحسن تحديد قواعد لكلمات السر لأن أسهل طريقة للحصول على دخول غير موثوق هي التحزير. 
لا تجعل المتطلبات شديدة للغاية لأنها تصعب على المستخدمين حفظ كلمات سرهم بالإضافة إلى نسيانها أو كتابتها.';
$string['check_passwordpolicy_error'] = 'لم تحدد قواعد كلمات السر';
$string['check_passwordpolicy_name'] = 'قواعد كلمات السر';
$string['check_passwordpolicy_ok'] = 'قواعد كلمات السر مفعلة';
$string['check_passwordsaltmain_details'] = 'تحديد كلمة سر خاصة (password salt) يقلل من إمكانية سرقتها. 
لتحديد كلمة سر خاصة (password salt) نقوم بإضافة السطر التالي في الملف config.php: \" >
<code>\$CFG->passwordsaltmain = \'ادخل مجموعة كبيرة من الأحرف العشوائية\';</code> \".
 وينبغي أن تكون السلسلة العشوائية مزيجا من الحروف والأرقام والأحرف الأخرى. ينصح بطول سلسلة ما لا يقل عن 40 حرفا.
يرجى الرجوع إلى وثائق target=\"_blank\"> <ahref=\"$a\" وثائق كلمات السر الخاصة  (password salt) \"</a> إذا كنت ترغب في تغيير كلمة السر الخاصة  (password salt). عند تحديدها لا تحذف كلمة السر الخاصة  (password salt) بك وإلا فإنك لن تكون قادرا على تسجيل الدخول إلى موقع الويب الخاص بك!';
$string['check_passwordsaltmain_name'] = 'كلمة سر خاصة (password salt)';
$string['check_passwordsaltmain_ok'] = 'كلمة سر خاصة (password salt) صحيحة';
$string['check_passwordsaltmain_warning'] = 'لم تحدد كلمة سر خاصة (password salt)';
$string['check_passwordsaltmain_weak'] = 'كلمة سر خاصة (password salt) ضعيفة';
$string['check_riskadmin_detailsok'] = 'الرجاء التحقق من قائمة مدراء النظام: $a';
$string['check_riskadmin_detailswarning'] = 'الرجاء التحقق من قائمة مدراء النظام: a->admins\$. من المستحسن تعيين دور مدير في سياق النظام فقط. المستخدمون التاليوون لديهم واجبات دور مدراء (غير مدعمة) في باقي السياقات: a->unsupported\$';
$string['check_riskadmin_name'] = 'مدراء';
$string['check_riskadmin_ok'] = 'تم العثور على $a مدير نظام';
$string['check_riskadmin_unassign'] = '<a href=\"$a->url\">$a->fullname ($a->email) مراجعة تعيين الأدوار</a>';
$string['check_riskadmin_warning'] = 'تم العثور على a->admincount\$ مدير نظام وa-\$>unsupcount تعيينات أدوار المشرف غير معتمدة.';
$string['check_riskbackup_details_overriddenroles'] = 'هذه التجاوزات النشطة تمنح المستخدمين القدرة على تضمين بيانات المستخدم بواسطة النسخ الاحتياطي. يرجى التأكد من هذا التصريح $a ضروري.';
$string['check_riskbackup_details_systemroles'] = 'أدوار النظام التالية تسمح الآن للمستخدمين بإضافة معلومات المستخدمين في نسخ احتياطية. الرجاء جعل الإذن هذا $a إجباري.';
$string['check_riskbackup_details_users'] = 'بسبب الأدوار بالأعلى أو التجاوز المحلي أصبحت حسابات المستخدمين التالية الإذن لإنشاء نسخ إحتياطية تضمن معلومات خاصة من أية مستخدم ملتحق بدوراته. الرجاء التأكد من أنهم (أ) موثوقون و (ب) محمون بكلمات سر قوية: $a';
$string['check_riskbackup_detailsok'] = 'لا دور يسمح صرحيا بإنشاء نسخ إحتياطية لمعلومات المستخدم. و لكن يجب ملاحظة أن المدراء الذين لديهم خاصية \"doanything\" من الأرجح قادرون  على ذلك.';
$string['check_riskbackup_editoverride'] = '<a href=\"$a->url\">$a->name في $a->contextname</a>';
$string['check_riskbackup_editrole'] = '<a href=\"$a->url\">$a->name</a>';
$string['check_riskbackup_name'] = 'نسخة إحتياطية لمعلومات المستخدم';
$string['check_riskbackup_ok'] = 'لا دور يسمح صرحيا بإنشاء نسخ إحتياطية لمعلومات المستخدم.';
$string['check_riskbackup_unassign'] = '<a href=\"$a->url\">$a->fullname ($a->email) in $a->contextname</a>';
$string['check_riskbackup_warning'] = 'تم العثور على a->rolecount\$ دور و a-\$>overridecount تجاوزات و a->usercount\$ مستخدم معه القدرة على إنشاء نسخ إحتياطية لمعلومات المستخدم.';
$string['check_riskxss_details'] = 'RISK_XSS يدل على جميع القدرات الخطيرة التي يستخدمها المستخدمين الموثوقون فقط.
يرجى التحقق من القائمة التالية من المستخدمين وتأكد من أن نثق بهم تماما على هذا الخادم : $a';
$string['check_riskxss_name'] = 'مستخدمي XSS الآمنون';
$string['check_riskxss_warning'] = '.RISK_XSS -  تم العثور على $a مستخدم المطلوب توثيقهم';
$string['check_unsecuredataroot_details'] = 'يجب أن لا يكون الدليل dataroot من الممكن الوصول إليه عبر شبكة الإنترنت. أفضل طريقة للتأكد من أن الدليل لا يمكن الوصول إليه هو استخدام دليل خارج دليل الشبكة العامة. </ P>
<p>إذا قمت بنقل الدليل، فمن الضرورة تحديث  الإعداد <code>\$ CFG -> dataroot </ رمز> في ملف config.php  <code></ رمز> تبعا لذلك.';
$string['check_unsecuredataroot_error'] = 'دليل  dataroot <code>$a</code> في غير موقعه الصحيح و هو معروض على شبكة الإنترنت.';
$string['check_unsecuredataroot_name'] = 'dataroot غير آمن';
$string['check_unsecuredataroot_ok'] = 'يجب ألا يكون دليل dataroot من الممكن الوصول له بواسطة شبكة الانترنت';
$string['check_unsecuredataroot_warning'] = 'دليل  dataroot <code>$a</code> في غير موقعه الصحيح وقد يؤدي ذلك إلى أن تعرض على شبكة الإنترنت.';
$string['configuration'] = 'تكوين';
$string['description'] = 'وصف';
$string['details'] = 'تفاصيل';
$string['issue'] = 'قضية';
$string['reportsecurity'] = 'نظرة عامة عن الأمن';
$string['security:view'] = 'عرض تقرير الأمن';
$string['status'] = 'وضع';
$string['statuscritical'] = 'مهم';
$string['statusinfo'] = 'معلومات';
$string['statusok'] = 'موافق';
$string['statusserious'] = 'جدي';
$string['statuswarning'] = 'تحذير';
$string['timewarning'] = 'جاري معالجة المعلومات... قد يستغرق وقتا طويلا، يرجى التحلي بالصبر';

?>
