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
 * Strings for component 'install', language 'ar', branch 'MOODLE_22_STABLE'
 *
 * @package   install
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['admindirerror'] = 'مجلد الإدارة المحدد غير صحيح';
$string['admindirname'] = 'مجلد الإدارة';
$string['admindirsetting'] = 'القليل جداً من شركات استضافة الويب تستخدم /admin كعنوان URL للوصول إلى لوحة التحكم أو أي شيء آخر. لسوء الحظ هذا يتعارض مع المكان الافتراضي لصفحات إدارة مودل. يمكنك حل هذه المشكلة بإعادة تسمية مجلد الإدارة admin، ثم وضع هذا الاسم الجديد هنا. مثلاً: <br /> <br /><b>moodleadmin</b><br /> <br />';
$string['admindirsettinghead'] = 'أعداد دليل المدير';
$string['admindirsettingsub'] = 'القليل جداً من شركات استضافة الويب تستخدم /admin كعنوان URL للوصول إلى لوحة التحكم أو أي شيء آخر. لسوء الحظ هذا يتعارض مع المكان الافتراضي لصفحات إدارة مودل. يمكنك حل هذه المشكلة بإعادة تسمية مجلد الإدارة admin، ثم وضع هذا الاسم الجديد هنا. مثلاً: <br /> <br /><b>moodleadmin</b><br /> <br />';
$string['availablelangs'] = 'حزم اللغة المتوفره';
$string['caution'] = 'تحذير';
$string['chooselanguage'] = 'اختر اللغة';
$string['chooselanguagehead'] = 'اختر اللغة';
$string['chooselanguagesub'] = 'الرجاء حدد لغة للتثبيت. هذه اللغة ستستخدم أيضاً كاللغة الافتراضية للموقع، لكن يمكنك تغييرها لاحقا.';
$string['cliadminpassword'] = 'كلمة سر جديدة  للمدير';
$string['cliadminusername'] = 'اسم المستخدم المدير';
$string['clialreadyinstalled'] = 'الملف config.php موجود مسبقاً، يرجى استخدام admin/cli/upgrade.php إن كنت تريد تحديث موقعك.';
$string['cliinstallfinished'] = 'تم التنصيب بنجاح.';
$string['compatibilitysettings'] = 'أفحص إعدادات الـ PHP';
$string['compatibilitysettingshead'] = 'أفحص إعدادات الـ PHP';
$string['compatibilitysettingssub'] = 'يجب أن يتجاوز الخادم لديك الاختبارات لتشغيل مودل بشكل صحيح';
$string['configfilenotwritten'] = 'مثبت سكريب لم يستطع إنشاء ملف config.php يحتوي على إعداداتك المختارة تلقائيا، من المحتمل أن يكون سبب ذلك أن دليل مودل غير قادر على الكتابة. تستطيع نسخ الركز التالي في ملف config.php يدويا ضمن الدليل الأصل لمودل';
$string['configfilewritten'] = 'تم انشاء ملف config.php بنجاح';
$string['configurationcomplete'] = 'تمت عملية الإعداد';
$string['configurationcompletehead'] = 'تمت عملية الإعداد';
$string['configurationcompletesub'] = 'حاول مودل حفظ تكوينك في ملف الأصل من تحميلك لمودل';
$string['database'] = 'قاعدة بيانات';
$string['databasecreationsettings'] = 'تحتاج الآن لتكوين إعدادات قاعدة البيانات\nحيث يتم تخزين معظم بيانات مودل. تنشأ عذع القاعدة تلقائيا بواسطة المثبت و اختيار الإعدادات المحددة بالاسفل\n\n<br />\n<br /> <br />\n<b>Type:</b> fixed to "mysql" by the installer<br />\n<b>Host:</b> fixed to "localhost" by the installer<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> fixed to "root" by the installer<br />\n<b>Password:</b> your database password<br />\nبادئة اختيارية تستخدم في جميع اسماء الجداول <b>Tables Prefix:</b>';
$string['databasecreationsettingshead'] = 'تحتاج الآن لتكوين إعدادات قاعدة البيانات\nحيث يتم تخزين معظم بيانات مودل. تنشأ عذع القاعدة تلقائيا بواسطة المثبت و اختيار الإعدادات المحددة بالاسفل';
$string['databasecreationsettingssub'] = 'b>Type:</b> fixed to "mysql" by the installer<br />\n<b>Host:</b> fixed to "localhost" by the installer<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> fixed to "root" by the installer<br />\n<b>Password:</b> your database password<br />\nبادئة اختيارية تستخدم في جميع اسماء الجداول <b>Tables Prefix:</b>';
$string['databasehead'] = 'إعدادات قاعدة البيانات';
$string['databasehost'] = 'مستضيف قاعدة البيانات';
$string['databasename'] = 'اسم قاعدة البيانات';
$string['databasepass'] = 'كلمة سر قاعدة البيانات';
$string['databasesettings'] = 'تحتاج الآن لتكوين إعدادات قاعدة البيانات\nحيث يتم تخزين معظم بيانات مودل. لا بد من إنشاء  قاعدة البيانات هذه و إنشاء اسم المستخدم و كلمة مرور للدخول إليها.\n\n<br />\n<br /> <br />\n<b>Type:</b> mysql or postgres7<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\nبادئة اختيارية تستخدم في جميع اسماء الجداول <b>Tables Prefix:</b>';
$string['databasesettingshead'] = 'تحتاج الآن لتكوين إعدادات قاعدة البيانات\nحيث يتم تخزين معظم بيانات مودل. لا بد من إنشاء  قاعدة البيانات هذه و إنشاء اسم المستخدم و كلمة مرور للدخول إليها.';
$string['databasesettingssub'] = '<b>Type:</b> mysql or postgres7<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\n<b>Tables Prefix:</b>';
$string['databasesettingssub_mssql'] = '<b>Type:</b> SQL*Server (non UTF-8) <b><strong class="errormsg">Experimental! (not for use in production)</strong></b><br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\nبادئة  تستخدم في جميع اسماء الجداول <b>Tables Prefix:</b> (إلزامية)';
$string['databasesettingssub_mssql_n'] = '<b>Type:</b> SQL*Server (UTF-8 enabled)<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\nبادئة  تستخدم في جميع اسماء الجداول  <b>Tables Prefix:</b> (إلزامي)';
$string['databasesettingssub_mysql'] = '<b>Type:</b> MySQL<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\nبادئة  تستخدم في جميع اسماء الجداول<b>Tables Prefix:</b> (اختياري)';
$string['databasesettingssub_mysqli'] = '<b>Type:</b> Improved MySQL<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\nبادئة  تستخدم في جميع اسماء الجداول <b>Tables Prefix:</b> (اختياري)';
$string['databasesettingssub_oci8po'] = '<b>Type:</b> Oracle<br />\n<b>Host:</b> not used, must be left blank<br />\n<b>Name:</b> given name of the tnsnames.ora connection<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\nبادئة  تستخدم في جميع اسماء الجداول <b>Tables Prefix:</b> (إلزامي)';
$string['databasesettingssub_odbc_mssql'] = '<b>Type:</b> SQL*Server (over ODBC) <b><strong class="errormsg">Experimental! (not for use in production)</strong></b><br />\n<b>Host:</b> given name of the DSN in the ODBC control panel<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\nبادئة  تستخدم في جميع اسماء الجداول <b>Tables Prefix:</b> (إلزامي)';
$string['databasesettingssub_postgres7'] = '<b>Type:</b> PostgreSQL<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\nبادئة  تستخدم في جميع اسماء الجداول <b>Tables Prefix:</b> (إلزامي)';
$string['databasesettingswillbecreated'] = '<b>Note:</b> سيحاول المثبت إنشاء قاعدة بيانات تلقائيا إذا لم يكن موجود';
$string['databaseuser'] = 'مستخدم قاعدة البيانات';
$string['dataroot'] = 'مجلد البيانات';
$string['datarooterror'] = 'إعداد المعلومات غير صحيح';
$string['datarootpublicerror'] = '\'دليل البيانات\' المحدد يمكن الوصل له مباشرة عبر الويب, لابد أن تختار دليل مختلف';
$string['dbconnectionerror'] = 'لم يتم التوصيل بقاعدة البيانات المحددة. تأكد من إعدادات قاعدة البيانات.';
$string['dbcreationerror'] = 'خطاء في إنشاء قاعدة البيانات. لم يم انشاء قاعدة البيانات المسماه في الأعدادات المعطاه.';
$string['dbhost'] = 'الخادم المضيف';
$string['dbpass'] = 'كلمة مرور';
$string['dbprefix'] = 'مقدمة الجداول';
$string['dbtype'] = 'نوع';
$string['dbwrongencoding'] = 'قاعدة البيانات المختارة تعمل بترميز غير موصى به ({$a}). بدلا من ذلك، يفضل استخدام ترميز (UTF-8) لقاعدة البيانات. على أي حال، يمكنك تجاوز هذا الاختبار باختيار "تخطي الاختبار بترميز DB" الموجود بالأسفل، لكن من الممكن أن تواجه المشاكل في المستقبل';
$string['dbwronghostserver'] = 'يجب أن تتبع قوانين "المضيف" كما هو مشروح بالأعلى';
$string['dbwrongnlslang'] = 'يجب أن تكون بيئة المتغير NLS_LANG في خادم الويب تسخدم حروف AL32UTF8. راجع مستندات php لضبط OCI8 بالطريقة الصحيحة';
$string['dbwrongprefix'] = 'يجب اتباع قوانين "مقدمة الجداول" كما هو مشروح بالأعلى';
$string['directorysettings'] = '<p> يجب تأكيد المواقع التي تثبت مودل </p>\n<p><b>عناوين ويب:</b>\nحدد عنوان ويب كامل حيث يمكن الوصول إلى مودل. إذا كان موقع ويب يمكنه الوصول لعدد من URLs ثم اختر أكثرهم بساطة الذي سيتخدمها طلابك. لا تستخدم الشرطة المائلة</p>.\n\n<p><b>دليل مودل:</b>\nحدد مسار الدليل الكامل لهذا التثبيت تأكد من أن حالة الأحرف العلوية/السفلية صحيحة  </p>\n\n<p><b>دليل البيانات:</b>\nتحتاج مكان بحيث يستطيع مودل حفظ الملفات المرفوعة. هذا الدليل يجب أن يكون خادم ويب المستخدم قابل للقراءة والكتابة، لكن لا يجب الوصول مباشرة إليها عبر الويب </p>';
$string['directorysettingshead'] = 'الرجاء تأكيد مكان تثبت مودل';
$string['directorysettingssub'] = '<p><b>عناوين ويب:</b>\nحدد عنوان ويب كامل حيث يمكن الوصول إلى مودل. إذا كان موقع ويب يمكنه الوصول لعدد من URLs ثم اختر أكثرهم بساطة الذي سيتخدمها طلابك. لا تستخدم الشرطة المائلة\n\n<br />\n<br />\n<p><b>دليل مودل:</b>\nحدد مسار الدليل الكامل لهذا التثبيت تأكد من أن حالة الأحرف العلوية/السفلية صحيحة\n\n<br />\n<br />\n<p><b>دليل البيانات:</b>\nتحتاج مكان بحيث يستطيع مودل حفظ الملفات المرفوعة. هذا الدليل يجب أن يكون خادم ويب المستخدم قابل للقراءة والكتابة، لكن لا يجب الوصول مباشرة إليها عبر الويب';
$string['dirroot'] = 'مجلد مودل';
$string['dirrooterror'] = 'إعدادّّّ"الدليل" غير صحيح. حاول إعادة الإعداد';
$string['download'] = 'تنزيل';
$string['downloadlanguagebutton'] = 'تحميل "{$a}" حزمة اللغة';
$string['downloadlanguagehead'] = 'تنزيل حزمة اللغة';
$string['downloadlanguagenotneeded'] = 'يمكن متابعة عملية التثبيت باستخدام حزمة اللغة الافتراضية, "{$a}"';
$string['downloadlanguagesub'] = 'تلمك الخيار الآن لتحميل حزمة لغة والاستمرار في عملية تثبيت هذه اللغة.<br /><br /> إذا لم تستطع تحميل حزمة اللغة، عملية التثبيت ستكمل باللغة الانجليزية. (عندما تكتمل عملية التحميل، سيكون لك فرصة لتحميل وتثبيت حزم لغات إضافية)';
$string['doyouagree'] = 'هل أنت موافق؟ (نعم/لا):';
$string['environmenthead'] = 'يتم فحص البيئة';
$string['environmentsub'] = 'سنقوم بفحص عناصر نظامك إذا تطابق متطلبات نظام التشغيل';
$string['errorsinenvironment'] = 'خطأ في البيئة!';
$string['fail'] = 'فشل';
$string['fileuploads'] = 'تحميل ملف';
$string['fileuploadserror'] = 'هذا يجب أن يكون نشط';
$string['fileuploadshelp'] = '<p> يبدو أن الخادم لديك قام بتعطيل التحديث</p>\n\n<p> مودل مازال قادر على التثبيت, لكن بدون الخاصية، لن تكون قادر على رفع ملقات المقرر أو صور المستخدم الشخصية </p>\n\n<p>لتمكين رفع الملفات تستطيع (أو المسؤول عن نظامك) تحرير ملف php.ini من نظامك لتغيير الاعدادات لـ\n<b>رفع الملفات</b> إلى\'1\'.</p>';
$string['gdversion'] = 'أصدار جي دي';
$string['gdversionerror'] = 'مكتبة GD يجب أن تكون موجودة لتحرير وإنشاء الصور';
$string['gdversionhelp'] = '<p>يبدو أن الخادم لديك لم يقم بتثبيت GD </p>\n\nGD <p>هي مكتبة مطلوبة بواسطة PHP ليسمح مودل بتعديل الصور (كأيقونات الملف الشخصي للمستخدم) وإنشاء صور جديدة (كإنشاء سجل الرسوم البيانية). مودل سيعمل بدون GD هذه الخصائص لن تكون متوفرة لك أنت فقط </p>\n\n<p>لإضافة GD إلى php تحت Unix, إجمع php باستخدام معامل gd   </p>\n\n<p>  تحت النوافذ عادة ما تستطيع تحرير php.ini ومرجع السطر الذي لايحوي تعليق </p>';
$string['globalsquotes'] = 'معالجة غير آمنة لGlobals';
$string['globalsquoteserror'] = 'قم بإصلاح إعدادت php: عطل  register_globals أو مكن magic_quotes_gpc';
$string['globalsquoteshelp'] = '<p>Combination of disabled Magic Quotes GPC and enabled Register Globals both at the same time is not recommended.</p>\n\n<p>The recommended setting is <b>magic_quotes_gpc = On</b> and <b>register_globals = Off</b> in your php.ini</p>\n\n<p>If you don\'t have access to your php.ini, you might be able to place the following line in a file\ncalled .htaccess within your Moodle directory:</p>\n<blockquote><div>php_value magic_quotes_gpc On</div></blockquote>\n<blockquote><div>php_value register_globals Off</div></blockquote>';
$string['inputdatadirectory'] = 'مجلد البيانات';
$string['inputwebadress'] = 'عنوان الويب:';
$string['inputwebdirectory'] = 'مجلد مودل';
$string['installation'] = 'تثبيت';
$string['langdownloaderror'] = 'لسوء الحظ، اللغة "{$a}" لم تثبت. عملية التثبيت ستستمر باللغة الانجليزية';
$string['langdownloadok'] = 'تم تثبيت اللغة "{$a}" بنجاح. عملية التثبيت ستستمر بنفس اللغة';
$string['magicquotesruntime'] = 'وقت تشغيل الاقتباسات';
$string['magicquotesruntimeerror'] = 'هذا يجب ان يكون معطل';
$string['magicquotesruntimehelp'] = '<p>يجب إيقاف وقت تشغيل الاقتباسات لوظائف مودل</p>\n\n<p>في الوضع الافتراضي يكون معطل اطلع على الاعدادت  <b>وقت تشغيل الاقتباسات</b> في  ملفphp.ini  لديك  </p>\n\n<p>إذا كنت لا تملك إذن الوصول لـphp.ini، من المحتمل أن يتم وضع السطر التالي في ملف يسمى htaccess بداخل دليل مودل </p>\n\n<blockquote><div>php_value magic_quotes_runtime Off</div></blockquote>';
$string['memorylimit'] = 'حد الذاكرة';
$string['memorylimiterror'] = 'ذاكرة الـ PHP صغيرة جداً... من المحتل ستواجه بعض المشاكل لاحقاً';
$string['memorylimithelp'] = '<p>حد ذاكرةphp لخادمك تم ضبطها لـ {$a} حاليا</p>\n\n<p> قد يسبب ذلك مشاكل في الذكرة لمودل لاحق، وخصوصا إذا كان لديك العديد من الوحدات الممكنة أو العديد من المستخدمين </p>\n\n<p>نوصي أن يكون تكوين php بحد أعلى مكن، مثل 40M. هنام عدة طرق للقيام بذلك ،يمكنك المحاولة:</p>\n<ol>\n\n<li>إذا كنت قادر على ، إعادة ترجمة PHP بـ <i> مكن حد الذاكرة</i>\n\nسيمح ذلك لمودل بضبك حد الذاكرة ذاتيا</li>\n\n<li>إذا تم وصولك لملف php.ini  الخاص بك، تستطيع تغيير إعداد <b>حد الذاكرة</b> هناك طلب من المسؤول القيام بذلك </li>\n\n<li> في بعض خوادم php تستطيع إنشاء ملف .htaccess في دليل مودل محتويا على هذا السطر:\n\n<blockquote><div>php_value memory_limit 40M</div></blockquote>\n\np>لكن بعض الخوادم تمنع <b> جميع</b>  صفحات PHP من العمل\n(سترى أخطاء عندما تنظر إلى الصفحات)لذلك  ملف .htaccess يحب أن يحذف <li/>\n\n</ol>';
$string['mssql'] = 'خادم*  (mssql)SQL';
$string['mssql_n'] = 'خادم* SQL بترميز UTF-8 يدعم (mssql_n)';
$string['mssqlextensionisnotpresentinphp'] = 'لم يتم تكوين PHP بامتداد MSSQL لذا يمكن التواصل بخادم* SQL. الرجاء تحديد ملف php.ini الخاص بك أو أعد ترجمة PHP';
$string['mysql'] = 'MySQL (mysql)';
$string['mysqlextensionisnotpresentinphp'] = 'لم يتم تكوين PHP بامتداد MySQL لذا يمكن التواصل بخادم* MySQL. الرجاء تحديد ملف php.ini الخاص بك أو أعد ترجمة PHP';
$string['mysqli'] = 'MySQL (mysqli) معدل';
$string['mysqliextensionisnotpresentinphp'] = 'لم يتم تكوين PHP بامتداد MySQL لذا يمكن التواصل بخادم* MySQL. الرجاء تحديد ملف php.ini الخاص بك أو أعد ترجمة PHP. امتداد MySQLi ليس متوفر PHP4';
$string['oci8po'] = 'Oracle (oci8po)';
$string['ociextensionisnotpresentinphp'] = 'لم يتم تكوين PHP بامتداد oci8po لذا يمكن التواصل Oracle. الرجاء تحديد ملف php.ini الخاص بك أو أعد ترجمة PHP';
$string['odbc_mssql'] = 'SQL*Server over ODBC (odbc_mssql)';
$string['odbcextensionisnotpresentinphp'] = 'لم يتم تكوين PHP بامتداد ODBC لذا يمكن التواصل خادم* SQL.الرجاء تحديد ملف php.ini الخاص بك أو أعد ترجمة PHP';
$string['pass'] = 'اجتياز';
$string['paths'] = 'مسارات';
$string['pathshead'] = 'تأكيد المسارات';
$string['pgsqlextensionisnotpresentinphp'] = 'لم يتم تكوين PHP بامتداد PGSQL  لذا يمكن التواصل PostgreSQL.الرجاء تحديد ملف php.ini الخاص بك أو أعد ترجمة PHP';
$string['phpversion'] = 'أصدار PHP';
$string['phpversionhelp'] = '<p> يتطلب مودل على الاقل الأصدار 4.3.0 لـ PHP </p>
<p> انت تستخدم الأصدار {$a} </p>
<p> يجب عليك ترقية PHP أو الانتقال إلى مستظيف أخر لديه أصدار اجد لـ PHP.</p>
في حالة وجود إصدار 5.0 فما بعد يمكنك الرجوع إلى إصدار 4.4 فما بعد';
$string['postgres7'] = 'PostgreSQL (postgres7)';
$string['releasenoteslink'] = 'لمعلومات عن إصدار مودل , الرجاء الاطلاع على الملاحظات المشورة في {$a}';
$string['safemode'] = 'وضع الامان';
$string['safemodeerror'] = 'من الممكن ان مودل يواجه مشاكل عندما يكون وضع الامان نشط';
$string['sessionautostart'] = 'البدء الآلي للجلسة';
$string['sessionautostarterror'] = 'يجب أن يكون هذا معطل';
$string['sessionautostarthelp'] = '<p> يتطلب مودل لدعم الجلسات وبدونها لا يستطع العمل.</p>
<p>.يمكن تمكين الجلسات من خلال ملف php.in ...ابحث عن session.auto_start  </p>';
$string['skipdbencodingtest'] = 'تخطى اختبار تشفير قاعدة البيانات';
$string['upgradingqtypeplugin'] = 'تحديث إضافة سؤال/نوع';
$string['welcomep10'] = '{$a->installername} ({$a->installerversion}';
$string['welcomep20'] = 'أنت تشاهد هذه الصفحة لأنك ثبت و شغلت الحزمة <strong>{$a->packname} {$a->packversion}</strong> بنجاح على جهازك. مبروك!';
$string['welcomep30'] = 'هذا الاصدار من <strong>{$a->installername}</strong> يحتوي على التطبيقات لإنشاء بيئة <strong>Moodle</strong> ستعمل، بالاسم:';
$string['welcomep40'] = 'تحتوي الحزمة أيضا على <strong>Moodle {$a->moodlerelease} ({$a->moodleversion})</strong>.';
$string['welcomep50'] = 'استخدام التطبيقات في هذهالحزمة يحكمها التراخيص مخصصة. الحزمة الكاملة <strong>{$a->installername}</strong> هي <a href="http://www.opensource.org/docs/definition_plain.html">open source</a> وتوزع تحت تراخيص <a href="http://www.gnu.org/copyleft/gpl.html">GPL</a>';
$string['welcomep60'] = 'الصفحات التالية ستقودك من خلال بعض الخطوات السهلة لتكوين وإعداد <strong> مودل</strong> على جهازك. يمكنك قبول الإعدادت الافتراضية, أو تعديلهم على حسب احتياجك (اختياري)';
$string['welcomep70'] = 'انقر زر " التالي " باظلسفل لمتابعة إعداد <strong> مودل </strong>.';
$string['wwwroot'] = 'WWW';
$string['wwwrooterror'] = 'إعداد \'WWW\' غير صحيح';
