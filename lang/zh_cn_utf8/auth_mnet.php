<?php // $Id$ 
$string['sso_idp_name']                = 'SSO(Identity Provider)';
$string['sso_idp_description']         = '发布该服务后，用户浏览到 $a Moodle 站点时无需重新登录。<ul><li><em>依赖性</em>: 您必须<strong>订阅</strong> $a 上的 SSO (Service Provider)服务。</li></ul><br />定义该服务后，用户从 $a 访问到您的 Moodle 站点时无需重新登录。<ul><li><em>依赖性</em>: 同时您必须向 $a <strong>发布</strong> SSO (Service Provider) 服务。</li></ul><br />';

$string['sso_sp_name']                 = 'SSO(Service Provider)';
$string['sso_sp_description']          = '发布该服务后，则允许 $a 上的认证用户访问 您的Moodle 站点时无需重新登录。<ul><li><em>依赖性</em>: 您必须<strong>订阅</strong> $a 上的 SSO (Identity Provider) 服务。</li></ul><br />定义该服务后，用户从 $a 访问到您的 Moodle 站点时无需重新登录。<ul><li><em>依赖性</em>: 同时您必须向 $a <strong>发布</strong> SSO (Identity Provider) 服务。</li></ul><br />';
$string['sso_mnet_login_refused']      = '不允许用户 $a[0] 从 $a[1] 登录。';
?>