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
 * Strings for component 'mnet', language 'ar', branch 'MOODLE_22_STABLE'
 *
 * @package   mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['RPC_HTTPS_SELF_SIGNED'] = 'HTTPS موقع ذاتيا';
$string['RPC_HTTPS_VERIFIED'] = 'HTTPS موقع';
$string['RPC_HTTP_PLAINTEXT'] = 'HTTPS غير مشفر';
$string['RPC_HTTP_SELF_SIGNED'] = 'HTTP موقع ذاتيا';
$string['RPC_HTTP_VERIFIED'] = 'HTTP موقع';
$string['aboutyourhost'] = 'حول خادمك';
$string['accesslevel'] = 'مرحلة الاتصال';
$string['addhost'] = 'إضافة مستضيف';
$string['addnewhost'] = 'إضافة مستضيف جديد';
$string['addtoacl'] = 'إضافة على التحكم في الاتصال';
$string['allhosts_no_options'] = 'لا توجد خيارات في النظر على عدة مستضيفين';
$string['allow'] = 'السمح';
$string['authfail_nosessionexists'] = 'فشل في الترخيص: الدورة MNET لا موجودة';
$string['authfail_sessiontimedout'] = 'فشل في الترخيص: انتهى الوقت المؤقت للدورة MNET';
$string['authfail_usermismatch'] = 'فشل في الترخيص: لا يوجد تطابق في المستخدم.';
$string['authmnetdisabled'] = 'البرنامج المساعد للتوثيق في شبكات الاتصال التابعة لموودل غير مفعلة.';
$string['badcert'] = 'هذه ليست شهادة صالحة.';
$string['couldnotgetcert'] = 'لا توجد أي شهادة في <br>{$a}<br/> فقد يكون المضيف عاطل أو غير صحيح التكوين.';
$string['couldnotmatchcert'] = 'هذه لا تطابق الشهادة الحديثة الإصدار من قبل خادم الويب.';
$string['courses'] = 'مقررات دراسية';
$string['courseson'] = 'مقررات دراسية في';
$string['current_transport'] = 'النقل الحالي';
$string['currentkey'] = 'المفتاح العام الحالي';
$string['databaseerror'] = 'ليس بالاستطاعة كتابة التفاصيل على قاعدة البيانات.';
$string['deleteaserver'] = 'حذف خادم الويب';
$string['deletehost'] = 'حذف مستضيف';
$string['deletekeycheck'] = 'هل أنت متأكد من رغبتك في حذف هذا المفتاح؟';
$string['deleteoutoftime'] = 'انتهت مدتك المتاحة و هي ٦٠ ثانية فقط لحذف هذا المفتاح. الرجاء البدء من جديد.';
$string['deleteuserrecord'] = 'SSO ACL: احذف السجلات التابع للمستخدمين \'{$a->user}\' و \'{$a->host}\'';
$string['deletewrongkeyvalue'] = 'لقد حدث خطأ. إذا كنت لا تحاول حذف المفتاح SSL لخادمك ، فمن المحتمل أنك كنت قد ضحية من هجوم ضار. لم يتخذ أي إجراء.';
$string['deny'] = 'أرفض';
$string['description'] = 'وصف';
$string['duplicate_usernames'] = 'فشلنا في إنشاء فهرس على الأعمدة "mnethostid" و "اسم المستخدم" في جدول المستخدم الخاص بك. <br/>هذامن الممكن أن يحدث عندما يكون لديك <ahref="{$a}" target="_blank"> اسمين متشابهين في جدول المستخدم الخاص بك  </ A>. <br/> ترقيتك يجب أن يستمر بالإكمال بنجاح. انقر على الرابط أعلاه وتعليمات حول إصلاح هذه المشكلة سوف تظهر في لك في نافذة جديدة. يمكنك الوصول إليها في نهاية الترقية<br/>.';
$string['enabled_for_all'] = '(تم تفعيل الخدمة لكل المستضيفين)';
$string['enterausername'] = 'الرجاء إدخال اسم مسخدم أو قائمة أسماء مستخدمين مفصولة بفواصل.';
$string['error7020'] = 'عادة يحدث هذا الخطأ إذا كان الموقع عن بعد أنشأت رقم مسجل  لك مع wwwroot خاطئ مثل http://yoursite.com  بدلا من http://www.yoursite.com. فيجب عليك الاتصال بالمسؤول عن الموقع عن بعد بواسطة  الwwwroot الخاص بك (كما هو محدد في ملف config.php) للطلب بتحديث رقمها المسجل لمستضيفك.';
$string['error7022'] = 'لقد تم إرسال هذه الرسالة للموقع عن بعد كرسالة مشفرة بشكل صحيح ولكنها غير موقعة.';
$string['error7023'] = 'لقد حاول الموقع عن بعد فك تشفير الرسالة باستخدام كل ما له من مفاتيح لموقعك إلا أن المفاتيح فشلت جميعا. قد تكون قادر على حل هذه المشكلة عن طريق إعادة إصدار المفاتيح يدويا مع الموقع عن بعد. هذا من غير المحتمل أن يحدث إلا إذا كنت منقطع التواصل مع الموقع عن بعد لبضعة أشهر.';
$string['error7024'] = 'قمت بإرسال رسالة غير مشفرة إلى الموقع عن بعد ولكنه لم يقبل تواصل غير مشفر من موقعك. هذا غير متوقع للغاية لذلك يجب أن تعلن عن مشكلة حين حصولها (بإعطاء أكبر قدر من المعلومات الممكنة حول إصدارات موودل في السؤال ، الخ.)';
$string['error7026'] = 'المفتاح الذي تم توقيعه مع رسالتك يختلف عن المفتاح الذي لدى المضيف عن بعد على ملف الخادم الخاص بك بالإضافة إلى ذلك فقد حاول المضيف عن بعد أيضا جلب مفتاحك الحالي وفشل في القيام بذلك. الرجاء إعادة إصدارالمفتاح يدويا مع المضيف عن بعد والمحاولة مرة أخرى.';
$string['error709'] = 'فشل الموقع عن بعد على الحصول على مفتاح SSL منك.';
$string['expired'] = 'ستنتهي صلاحية هذا المفتاح في';
$string['expires'] = 'صالح حتى';
$string['expireyourkey'] = 'أحذف هذا المفتاح';
$string['expireyourkeyexplain'] = 'مودل تدور المفاتيح الخاصة بك تلقائيا كل 28 يوما (إفتراضيا) ولكن لديك خيار إنهاء صلاحية هذا المفتاح في أي وقت<em>يدويا</ EM>و هذا الخيار مفيد إلا إذا كنت تعتقد أنه قد تم تسوية هذا المفتاح، فسيتم استبدال وعلى الفور تم إنشاؤه تلقائيا.<br/> و حذف هذا المفتاح سوف يجعل من المستحيل على Moodles أخرى التواصل معك إلى أن تتصل يدويا مع كل مدير وتزودهم بمفتاحك الجديد.';
$string['failedaclwrite'] = 'فشلت الكتابة إلى قائمة التحكم الوصول MNET للمستخدم \'{$a}\'.';
$string['findlogin'] = 'العثور على تسجيل دخول';
$string['forbidden-function'] = 'لم تفعل تلك الوظيفة  لRPC.';
$string['forbidden-transport'] = 'أسلوب النقل الذي تحاول إستخدامه غير مسموح.';
$string['forcesavechanges'] = 'إجبار حفظ التغييرات';
$string['helpnetworksettings'] = 'تكوين الاتصالات بين موودل';
$string['hidelocal'] = 'إخفاء المستخدمين المحليين';
$string['hideremote'] = 'إخفاء المستخدمين عن بعد';
$string['host'] = 'مستضيف';
$string['hostcoursenotfound'] = 'المستضيف أو الدورة غير موجود';
$string['hostdeleted'] = 'تم حذف مستضيف';
$string['hostexists'] = 'هناك سجل موجود حاليا لهذا المضيف ونشر موودل  ذو المعرف ب{$a}. <br/>انقر على <em>متابعة</ em> لتعديل هذا السجل.';
$string['hostname'] = 'اسم المستضيف';
$string['hostnamehelp'] = 'اسم المجال المؤهل بالكامل من المضيف عن بعد فعلى سبيل المثال www.example.com';
$string['hostnotconfiguredforsso'] = 'لم يتم تكوين هذا المحور البعيد التابع لمودل موودل للدخول عن بعد.';
$string['hostsettings'] = 'عدادات مستضيف';
$string['http_self_signed_help'] = 'اسمح لجهات الاتصال بواسطة شهادات DIY SSL ذات التوقيع الذاتي على المستضيف عن بعد.';
$string['http_verified_help'] = 'اسمح لجهات الاتصال بواسطة شهادات SSL المتأكد من صحتها بواسطة الPHP على المستضيف عن بعد و ليس بواسطة الhttp (not https).';
$string['https_self_signed_help'] = 'اسمح لجهات الاتصال بواسطة شهادات DIY SSL ذات التوقيع الذاتي بواسطة الPHP على المستضيف عن بعد بواسطة الhttp.';
$string['https_verified_help'] = 'اسمح لجهات الاتصال بواسطة شهادات SSL المتأكد من صحتها بواسطة الPHP على المستضيف عن بعد.';
$string['id'] = 'رقم تعريف';
$string['idhelp'] = 'هذه القيمة تعين تلقائيا و غير قابلة للتغيير';
$string['invalidaccessparam'] = 'معلمة الوصول غير صالح';
$string['invalidactionparam'] = 'معلمة النشاط غير صالح';
$string['invalidhost'] = 'الرجاء إدخال معرف مستضيف صحيح';
$string['invalidpubkey'] = 'هذا المفتاح ليس مفتاح SSL صحيح';
$string['invalidurl'] = 'معلمة الURL غير صالحة';
$string['ipaddress'] = 'عنوان الIP';
$string['is_in_range'] = 'عنوان الIP التالي &nbsp;<code>{$a}</code>&nbsp;  يمثل مستضيف صحيح وموثوق.';
$string['ispublished'] = 'المودل {$a} قد فعل هذه الخدمة لك.';
$string['issubscribed'] = 'المودل {$a} مشترك بهذه الخدمة على مستضيفك';
$string['keydeleted'] = 'لقد تم حذف و تبديل مفتاحك بنجاح';
$string['keymismatch'] = 'المفتاح العام الذي لديك لهذا المستضيف يختلف عن المفتاح العان الذي يصدره';
$string['last_connect_time'] = 'آخر مدة اتصال';
$string['last_connect_time_help'] = 'آخر مدة اتصالك بهذا المستضيف.';
$string['last_transport_help'] = 'طريقة النقل الذي استخدمته في آخر اتصالك بهذا المستضيف';
$string['loginlinkmnetuser'] = '<br/>إذا كنت من مستخدمي شبكة مودل ذوي الاتصال عن بعد فيمكنك href="{$a}"> <a التأكد من عنوان البريد الإلكتروني الخاص بك هنا </ a> و أيضا من الممكن إعادة توجيهك إلى صفحة تسجيل الدخول الخاصة بك. <br/>';
$string['logs'] = 'سجلات';
$string['mnet'] = 'شبكة مودل';
$string['mnet_concatenate_strings'] = 'أضف ( إلى ) 3 سلاسل من الأحرف/الأرقام إلى بعض وأرجع النتيجة';
$string['mnet_session_prohibited'] = 'مستخدمون خادم الويب الخاص بمنزلك لا يسمح لهم التجول حاليا في {$a}.';
$string['mnetdisabled'] = 'شبكة مودل غير مفعلة';
$string['mnetidprovider'] = 'موفر معرف الMNET';
$string['mnetidproviderdesc'] = 'يمكنك استخدام هذا المرفق لاسترداد رابط يمكنك الدخول فيه و ذلك إذا كنت تستطيع توفير عنوان البريد الإلكتروني الصحيح ليتناسب مع اسم المستخدم الذي حاولت سابقا تسجيل الدخول فيه.';
$string['mnetidprovidermsg'] = 'يجب أن تكون قادر على تسجيل الدخول في بمزودك {$a}.';
$string['mnetidprovidernotfound'] = 'عذرا و لكن لا يوجد معلومات إضافية.';
$string['mnetlog'] = 'سجلات';
$string['mnetpeers'] = 'أقران';
$string['mnetservices'] = 'خدمات';
$string['mnetsettings'] = 'إعدادات شبمة مودل';
$string['moodle_home_help'] = 'المسار إلى الصفحة الرئيسية لموودل على المضيف عن بعد على سبيل المثال /moodle/.';
$string['net'] = 'شبكة';
$string['networksettings'] = 'إعدادات الشبكة';
$string['never'] = 'ابداَ';
$string['noaclentries'] = 'لا يمكن الوصول إلى أي معلومات في قائمة السيطرة SSO';
$string['nocurl'] = 'لم يتم تثبيت مكتبة الPHP cURL';
$string['nolocaluser'] = 'لا يوجد سجل محلي للمستخدم عن بعد';
$string['nomodifyacl'] = 'لا يسمح لك التعديل في قائمة تحكم الMNET';
$string['nonmatchingcert'] = 'المعني بالشهادة: <br><em>{$a->subject}</em></br /> لا يطابق المستضيف <br /><br /><em>{$a->host}</em>. الذي هو آت منه.';
$string['nopubkey'] = 'حصل خطأ في استرداد المفتاح العام فربما المستضيف لا يسمح بشبكة مودل أو قد المفتاح غير صحيح.';
$string['nosite'] = 'لم يتم العثور على دورة على مستوى موقع كامل';
$string['nosuchfile'] = 'الملف/الوظيفة {$a} غير موجودة';
$string['nosuchfunction'] = 'لم يتم العثور على وظيفة أو وظيفة ممنوعة في ال RPC.';
$string['nosuchmodule'] = 'وقد وجهت وظيفة بشكل غير صحيح ولم يتم العثور عليها. الرجاء استخدام النمط التالي mod/modulename/lib/functionname';
$string['nosuchpublickey'] = 'عدم القدرة على الحصول على المفتاح العام للتحقق من التوقيع.';
$string['nosuchservice'] = 'خدمة RPC لا تعمل على هذا المستضيف';
$string['nosuchtransport'] = 'لا وجود لوسيلة نقل تحمل المعرف هذا';
$string['notBASE64'] = 'هذه السلسلة ليست على نمط الBase64 Encoded لذلك فهي ليست مفتاحا صحيحا.';
$string['notPEM'] = 'هذه السلسلة ليست على نمط الPEM لذلك فهي لن تعمل.';
$string['not_in_range'] = 'عنوان الIP التالي &nbsp;<code>{$a}</code>&nbsp; لا يمثل مستضيف صحيح و موثوق.';
$string['notpermittedtojump'] = 'ليس لديك الإذن بالبدء بجلسة عمل من بعد من محور موودل هذا.';
$string['notpermittedtoland'] = 'ليس لديك الإذن بالبدء بجلسة عمل';
$string['off'] = 'مغلق';
$string['on'] = 'تشغيل';
$string['permittedtransports'] = 'وسائل نقل مسموحة';
$string['phperror'] = 'منع خطأ PHP داخلي من تتحقق طلبك.';
$string['postrequired'] = 'وظيفة الحذف تحتاج طلب POST';
$string['promiscuous'] = 'غير شرعي';
$string['publickey'] = 'مفتاح شرعي';
$string['publickey_help'] = 'يتم الحصول على المفتاح العام تلقائيا من قبل خادم الويب عن بعد.';
$string['publish'] = 'نشر';
$string['reallydeleteserver'] = 'هل أنت متأكد من رغبتك بحذف خادم الويب؟';
$string['receivedwarnings'] = 'تم تلقي التحذيرات التالية';
$string['recordnoexists'] = 'السجل غير موجود';
$string['reenableserver'] = 'لا - اختر الخيار هذا لإعادة تفعيل خادم الويب هذا.';
$string['registerallhosts'] = 'سجل كل المستضيفين  (<em>Hub mode</em>)';
$string['registerallhostsexplain'] = 'يمكنك اختيار تسجيل جميع المستضيفين الذين يحاولون الاتصال بك تلقائيا.\nهذا يعني أن السجل سيظهر في قائمة مستضيفيك في أي موقع مودل الذي يربط لك و للطلبات بالمفتاح العام الخاص بك.<br/> لديك الخيار أدناه لتكوين الخدمات "لكل المضيفين" والتي من الممكن تفعيل بعض الخدمات هناك وكنت قادر على توفير خدمات إلى أي خادم مودل دون تمييز.';
$string['remotecourses'] = 'دورات عن بعد';
$string['remotehost'] = 'محور عن بعد';
$string['remotehosts'] = 'مستضيفين عن بعد';
$string['requiresopenssl'] = 'شبكات التواصل تتطلب توسعة OpenSSL';
$string['restore'] = 'استعادة';
$string['reviewhostdetails'] = 'مراجعة تفاصيل المستضيف';
$string['reviewhostservices'] = 'مراجعة خدمات المستضيف';
$string['selectaccesslevel'] = 'الرجاء تحديد مستوى الوصول من القائمة.';
$string['selectahost'] = 'الرجاء اختيار مستضيف مودل عن بعد.';
$string['serviceswepublish'] = 'الخدمات التي نوفرها ل{$a}';
$string['serviceswesubscribeto'] = 'الخدمات الموجودة في {$a} المشتتركين بها نحن';
$string['settings'] = 'إعدادات';
$string['showlocal'] = 'إظهار المستخدمين المحليين';
$string['showremote'] = 'إظهار المستخدمين عن بعد';
$string['ssl_acl_allow'] = 'SSO ACL: اسمح بالمستخدمين {$a->user}  إلى {$a->host}';
$string['ssl_acl_deny'] = 'SSO ACL: ارفض المستخدمين {$a->user}  إلى {$a->host}';
$string['ssoaccesscontrol'] = 'تحمم الوصول بSSO';
$string['ssoacldescr'] = 'استخدام هذه الصفحة لمنح/رفض الوصول لمستخدمين معينين من  متستضيفين شبكة مودل عن بعد. هذا وظيفي عند تقديم الخدمات لمستخدمي SSO عن بعد. للسيطرة على قدرة المستخدمين <em>المحلية</ EM> على التجول إلى متستضيفي شبكة مودل الآخرون استخدام نظام الأدوار لمنحهم القدرةmnetlogintoremote <em></ EM> .';
$string['ssoaclneeds'] = 'حتى تعمل الوظيفة هذه يجب أن يكون شبكة اتصال مودل مفعلة لديك بالإضافة إلى البرنامج المساعد شبكة موودل مع مصادقة تمكين السيارات إضافة مستخدمين تمكين.';
$string['strict'] = 'حزم';
$string['subscribe'] = 'إشتراك';
$string['system'] = 'نظام';
$string['testtrustedhosts'] = 'اختبر أية عنوان';
$string['testtrustedhostsexplain'] = 'أدخل عنوان IP للتأكد من أن المستضيف موثوق أم لا';
$string['transport_help'] = 'هذه الخيارات مبنية على المعاملة بالمثل بحيث تمكنك بإجبار مستضيف عن بعد باستخدام شهادة SSL موقعة إذا وقع خادم الويب الخاص بك لديه أيضا شهادة SSL موقعة.';
$string['trustedhosts'] = 'مستضيفوا XML-RPC';
$string['trustedhostsexplain'] = 'آلية الاستضافة الموثوقة تسمح بآلات محددة لتنفيذ المكالمات عبر XML - RPC إلى أي جزء من API المودل. هذا\nمتوفر للمخطوطات للتحكم في سلوك مودل وقد يكون\nخيارا خطير جدا للتمكين. فإذا كنت في شك فابقه غير مفعل.\nو هذا <strong>غير<strong/>لازمة لشبكات مودل.\nو لتفعيل هذا الخيار ما عليك سوى إدخال قائمة عناوين بروتوكول الإنترنت أو الشبكات بحيث أن كل عنوان على كل خط.\nبعض الأمثلة :\nمضيفك المحلي : <br/> <br/> 127.0.0.1\nالمضيف المحلي الخاص بك (مع كتلة الشبكة) : <br/> <br/> فقط 127.0.0.1/32\nالمضيف مع عنوان IP 192.168.0.7 : <br/> <br/> 192.168.0.7/32 أي مضيف مع عنوان IP بين 192.168.0.1 192.168.0.255 و: <br/> <br/> 192.168.0.0/24\nأي مضيف على الإطلاق : <br/> 192.168.0.0 / 0 <br/>\nو من الواضح أن المثال الأخير هو على <strong>غير<strong/> التكوين الموصى بها.';
$string['unknownerror'] = 'حدث خطأ غير معروف أثناء التفاوض.';
$string['usercannotchangepassword'] = 'لا يمكنك تغيير كلمة السر الخاصة بك هنا لأنك أحد المستخدمين عن بعد.';
$string['userchangepasswordlink'] = '<br/>أنت قادر على تغيير كلمة السر الخاصة بك في{$a->wwwroot}/login/change_password.php">{$a->description}</a>';
$string['usersareonline'] = 'تحذير : تسجيل دخول {$a} مستخدم من هذا الخادم إلى موقعك.';
$string['validated_by'] = 'التحقق من صحة ذلك يقام من قبل الشبكة &nbsp;<code>{$a}</code>';
$string['verifysignature-error'] = 'فشل التحقق من صحة التوقيع لحدوث خطأ ما.';
$string['verifysignature-invalid'] = 'فشل التحقق من صحة التوقيع فيبدو أنك لم تقع على هذه الحمولة.';
$string['version'] = 'إصدار';
$string['warning'] = 'تحذير';
$string['wrong-ip'] = 'عنوان IP الخاص بك لا يتطابق مع عنوانك لدينا على الاطلاق.';
$string['xmlrpc-missing'] = 'يجب أن يكون لديك XML - RPC مثبت في بناء PHP الخاص بك لتكون قادر على استخدام هذه الميزة.';
$string['yourhost'] = 'مستضيفك';
$string['yourpeers'] = 'أقرانك';
