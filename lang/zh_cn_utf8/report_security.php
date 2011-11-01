<?PHP  // $Id$


//NOTE TO TRANSLATORS: please do not translate yet, we are going to finalise this file sometime in January and backport to 1.9.x ;-)

$string['configuration'] = '设置';
$string['details'] = '详细信息';
$string['description'] = '描述';
$string['issue'] = '问题';
$string['reportsecurity'] = '安全概述';
$string['security:view'] = '查看安全报表';
$string['status'] = '状态';
$string['statuscritical'] = '关键';
$string['statusinfo'] = '信息';
$string['statusok'] = '确定';
$string['statusserious'] = '严重';
$string['statuswarning'] = '警告';
$string['timewarning'] = '数据处理可能需要花费较长时间，请耐心等候...';

$string['check_configrw_details'] = '<p>建议在安装之后更改 config.php 的文件权限，使 web 服务器无法修改此文件。
请注意，这项措施不会显著提高服务器安全，但可能会减缓或限制一般性漏洞。</p>';
$string['check_configrw_name'] = '可写的 config.php';
$string['check_configrw_ok'] = 'PHP 脚本无法修改 config.php。';
$string['check_configrw_warning'] = 'PHP 脚本可修改 config.php。';

$string['check_cookiesecure_details'] = '<p>如果您启用了 https 通信，则建议您同时启用安全 cookie。还应添加从 http 到 https 的永久重定向。</p>';
$string['check_cookiesecure_error'] = '请启用安全 cookie';
$string['check_cookiesecure_name'] = '安全 cookie';
$string['check_cookiesecure_ok'] = '安全 cookie 已启用。';

$string['check_courserole_anything'] = '在此<a href=\"$a\">上下文</a>中禁止使用 \"执行任何操作\"功能。';
$string['check_courserole_details'] = '<p>每个课程都指定了一个默认选课角色。请确保没有为此角色指定有风险的功能。</p>
<p>默认课程角色唯一支持的原有类型是<em>学生</em>。</p>';
$string['check_courserole_error'] = '检测到未正确定义的默认课程角色！';
$string['check_courserole_riskylegacy'] = '在<a href=\"$a->url\">$a->shortname</a> 中检测到有风险的原有类型。';
$string['check_courserole_name'] = '默认角色（课程）';
$string['check_courserole_notyet'] = '仅使用默认课程角色。';
$string['check_courserole_ok'] = '默认课程角色定义正确。';
$string['check_courserole_risky'] = '在<a href=\"$a\">上下文</a>中检测到有风险的功能。';

$string['check_defaultcourserole_anything'] = '在此<a href=\"$a\">上下文</a>中禁止使用\"执行任何操作\"功能。';
$string['check_defaultcourserole_details'] = '<p>选课的默认学生角色指定了课程的默认角色。请确保没有为此角色指定有风险的功能。</p>
<p>默认角色唯一支持的原有类型是<em>学生</em>。</p>';
$string['check_defaultcourserole_error'] = '检测到未正确定义的默认课程角色 \"$a\"！';
$string['check_defaultcourserole_legacy'] = '检测到有风险的原有类型。';
$string['check_defaultcourserole_name'] = '默认课程角色（全局）';
$string['check_defaultcourserole_notset'] = '未设置默认角色。';
$string['check_defaultcourserole_ok'] = '站点默认角色定义正确。';
$string['check_defaultcourserole_risky'] = '在<a href=\"$a\">上下文</a>中检测到有风险的功能。';

$string['check_defaultuserrole_details'] = '<p>所有登录的用户都将获得默认用户角色的功能。请确保没有为此角色指定有风险的功能。</p>
<p>默认用户角色支持的唯一原有类型是<em>认证用户</em>。不得启用课程查看功能。</p>';
$string['check_defaultuserrole_error'] = '默认用户角色 \"$a\"定义不正确！';
$string['check_defaultuserrole_name'] = '所有用户的默认角色';
$string['check_defaultuserrole_notset'] = '未设置默认角色。';
$string['check_defaultuserrole_ok'] = '所有用户的默认角色定义正确。';

$string['check_displayerrors_details'] = '<p>建议不要在生产站点上启用 PHP 设置 <code>display_errors</code>，因为错误消息可能会显示有关您的服务器的敏感信息。</p>';
$string['check_displayerrors_error'] = '已经启用显示错误的 PHP 设置。建议禁用此设置。';
$string['check_displayerrors_name'] = '显示 PHP 错误';
$string['check_displayerrors_ok'] = 'PHP 错误显示已禁用。';

$string['check_emailchangeconfirmation_details'] = '<p>建议在用户更改其个人资料中的电子邮件地址时要求执行电子邮件确认步骤。若禁用此步骤，垃圾信息发送者就可能会尝试利用服务器发送垃圾信息。</p>
<p>也可以使用身份验证插件锁定电子邮件字段，此处未考虑这种可能性。</p>';
$string['check_emailchangeconfirmation_error'] = '用户可输入任意电子邮件地址。';
$string['check_emailchangeconfirmation_info'] = '用户仅可输入来自允许的域名的电子邮件地址。';
$string['check_emailchangeconfirmation_name'] = '电子邮件更改确认';
$string['check_emailchangeconfirmation_ok'] = '确认用户个人资料中的电子邮件地址更改。';

$string['check_embed_details'] = '<p>无限制的对象嵌入非常危险 - 任意注册用户都可启动对其他服务器用户的 XSS 攻击。应在生产服务器上禁用此设置。</p>';
$string['check_embed_error'] = '已启用无限制的对象嵌入 - 这对大多数服务器非常危险。';
$string['check_embed_name'] = '允许 EMBED 和 OBJECT';
$string['check_embed_ok'] = '不允许无限制的对象嵌入。';

$string['check_frontpagerole_details'] = '<p>所有注册用户都将获得首页活动的默认首页角色。请确保没有为此角色指定有风险的功能。</p>
<p>建议为此目的创建一个特定角色，不使用原有类型的角色。</p>';
$string['check_frontpagerole_error'] = '检测到未正确定义的首页角色 \"$a\"！';
$string['check_frontpagerole_name'] = '首页角色';
$string['check_frontpagerole_notset'] = '未设置首页角色。';
$string['check_frontpagerole_ok'] = '首页角色定义正确。';

$string['check_globals_details'] = '<p>Register Globals 被视为高度不安全的 PHP 设置。</p>
<p>必须在 PHP 配置中设置 <code>register_globals=off</code>。此设置通过编辑您的 <code>php.ini</code>、Apache/IIS 配置或 <code>.htaccess</code> 文件加以控制。</p>';
$string['check_globals_error'] = '必须禁用 Register Globals。请立即修复服务器 PHP 设置！';
$string['check_globals_name'] = 'Register Globals';
$string['check_globals_ok'] = 'Register Globals 已禁用。';

$string['check_google_details'] = '<p>“向 Google 开放”设置使搜索引擎能够以访客身份进入课程。如果不允许访客登录，则启用此设置无意义。</p>';
$string['check_google_error'] = '允许搜索引擎访问，但访客访问已禁用。';
$string['check_google_info'] = '搜索引擎可以作为访客进入。';
$string['check_google_name'] = '向 Google 开放';
$string['check_google_ok'] = '搜索引擎访问未启用。';

$string['check_guestrole_details'] = '<p>访客角色用于访客，而非登录用户和临时访客课程访问。请确保没有为此角色指定有风险的功能。</p>
<p>访客角色支持的唯一原有角色是<em>访客</em>。</p>';
$string['check_guestrole_error'] = '访客角色 \"$a\" 定义不正确！';
$string['check_guestrole_name'] = '访客角色';
$string['check_guestrole_notset'] = '未设置访客角色。';
$string['check_guestrole_ok'] = '访客角色定义正确。';

$string['check_mediafilterswf_details'] = '<p>自动 swf 嵌入非常危险 - 任意注册用户都可启动对其他服务器用户的 XSS 攻击。请在生产服务器上禁用此设置。</p>';
$string['check_mediafilterswf_error'] = '已启用 Flash 媒体过滤器 - 这对大多数服务器非常危险。';
$string['check_mediafilterswf_name'] = '已启用 .swf 媒体过滤器';
$string['check_mediafilterswf_ok'] = '未启用 Flash 媒体过滤器。';

$string['check_noauth_details'] = '<p><em>无身份验证</em>的插件并非用于生产站点。除非在开发测试站点中，否则请禁用它。</p>';
$string['check_noauth_error'] = '无身份验证的插件不得在生产站点中使用。';
$string['check_noauth_name'] = '无身份验证';
$string['check_noauth_ok'] = '无身份验证的插件已禁用。';

$string['check_openprofiles_details'] = '<p>垃圾信息发送者可能会滥用打开的用户个人资料。建议启用<code>强制用户登录后才能查看个人资料</code>或<code>强制用户登录</code>。</p>';
$string['check_openprofiles_error'] = '任何人都可查看用户个人资料，而无需登录。';
$string['check_openprofiles_name'] = '打开用户个人资料';
$string['check_openprofiles_ok'] = '需要在查看用户个人资料之前进行登录。';

$string['check_passwordpolicy_details'] = '<p>建议设置一项密码规则，因为密码猜测往往是获得未经授权的访问的最简单的方法。
不要使要求过度严格，因为这可能会导致用户无法记住其密码，因而遗忘密码或者写下密码。</p>';
$string['check_passwordpolicy_error'] = '未设置密码规则。';
$string['check_passwordpolicy_name'] = '密码规则';
$string['check_passwordpolicy_ok'] = '已启用密码规则。';

$string['check_passwordsaltmain_name'] = '密码 salt';
$string['check_passwordsaltmain_warning'] = '未设置任何密码 salt';
$string['check_passwordsaltmain_ok'] = '密码 salt 正确';
$string['check_passwordsaltmain_weak'] = '密码 salt 较弱';
$string['check_passwordsaltmain_details'] = '<p>设置密码 salt 能极大地降低密码被窃的风险。</p>
<p>要设置密码 salt，请在您的 config.php 文件中添加以下代码行：</p>
<code>\$CFG->passwordsaltmain = \'此处有些随机长度的字符串具有很多个字符\';</code>
<p>由字符组成的随机字符串应为字母、数字和其他字符的组合。建议采用长度为至少 40 个字符的字符串。</p>
<p>如果您希望更改密码 salt，请参考<a href=\"$a\" target=\"_blank\">密码 salting 文档</a>。在设置密码 salt 之后，除非无法登录站点，否则切勿删除密码 salt！</p>';
$string['check_riskadmin_detailsok'] = '<p>请检查以下系统管理员列表：</p>$a';
$string['check_riskadmin_detailswarning'] = '<p>请检查以下系统管理员列表：</p>$a->admins
<p>建议仅在系统上下文中分配管理员角色。以下用户在其他上下文中具有（不支持的）管理角色分配：</p>$a->unsupported';
$string['check_riskadmin_name'] = '管理员';
$string['check_riskadmin_ok'] = '找到 $a 服务器管理员。';
$string['check_riskadmin_unassign'] = '<a href=\"$a->url\">$a->fullname ($a->email) 查看角色分配</a>';
$string['check_riskadmin_warning'] = '找到 $a->admincount 服务器管理员和 $a->unsupcount 不支持的管理角色分配。';
$string['check_riskadmin_name'] = '管理员';

$string['check_riskbackup_name'] = '用户数据备份';
$string['check_riskbackup_warning'] = '找到 $a->rolecount 角色、$a->overridecount 覆盖和具有备份用户数据的功能的 $a->usercount 用户。';
$string['check_riskbackup_details_systemroles'] = '<p>以下系统角色目前允许在备份中包含用户数据。请确保此权限是必要的。</p> $a';
$string['check_riskbackup_details_overriddenroles'] = '<p>这些活动覆盖为用户提供了在备份中包含用户数据的功能。请确保此权限是必要的。</p> $a';
$string['check_riskbackup_details_users'] = '<p>由于上述角色或本地覆盖，因而以下用户目前有能力实现包含选修其课程的任意用户的隐私数据的备份。请确保他们是 (a) 可信任的并且 (b) 由强密码保护：</p> $a';
$string['check_riskbackup_editrole'] = '<a href=\"$a->url\">$a->name</a>';
$string['check_riskbackup_editoverride'] = '<a href=\"$a->url\">$a->name in $a->contextname</a>';
$string['check_riskbackup_unassign'] = '<a href=\"$a->url\">$a->fullname ($a->email) in $a->contextname</a>';
$string['check_riskbackup_ok'] = '不允许任何角色显式备份用户数据';
$string['check_riskbackup_detailsok'] = '不允许任何角色显式备份用户数据。但请注意，具有\"执行任何操作\"功能的管理员依然有可能能够执行此操作。';

$string['check_riskxss_details'] = '<p>RISK_XSS 表示仅有可信任的用户可使用的全部危险功能。</p>
<p>请检查以下用户列表，并确保您在此服务器上完全信任他们：</p><p>$a</p>';
$string['check_riskxss_name'] = 'XSS 可信任的用户';
$string['check_riskxss_warning'] = 'RISK_XSS - 发现必须信任的 $a 用户。';

$string['check_unsecuredataroot_details'] = '<p>数据根目录不可通过 web 访问。确保目录不可访问的最佳方法就是使用公共 web 目录以外的目录。</p>
<p>如果您移动了目录，则需要相应地更新 <code>config.php</code> 中的 <code>\$CFG->dataroot</code> 设置。</p>';
$string['check_unsecuredataroot_error'] = '您的数据根目录 <code>$a</code> 位于错误的位置，并且对 web 公开！';
$string['check_unsecuredataroot_name'] = '不安全的数据根';
$string['check_unsecuredataroot_ok'] = '数据根目录不可通过 web 访问。';
$string['check_unsecuredataroot_warning'] = '您的数据根目录 <code>$a</code> 位于错误的位置，可能对 web 公开。';
?>
