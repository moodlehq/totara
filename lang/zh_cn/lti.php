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
 * Strings for component 'lti', language 'zh_cn', branch 'MOODLE_22_STABLE'
 *
 * @package   lti
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addserver'] = '添加新的可信服务器';
$string['basiclti_in_new_window'] = '在的活动已在新窗口打开';
$string['basicltiintro'] = '活动描述';
$string['basicltiname'] = '活动名称';
$string['cannot_delete'] = '您不能删除这个工具的配置。';
$string['cannot_edit'] = '您不能编辑这个工具的配置。';
$string['comment'] = '评论';
$string['course_tool_types'] = '课程工具的类型';
$string['courseid'] = '课程编号';
$string['coursemisconf'] = '课程配置错误';
$string['curllibrarymissing'] = '要使用 LTI 必须安装 PHP Curl 库';
$string['custom'] = '定制参数';
$string['custom_config'] = '使用定制的工具配置。';
$string['delete'] = '删除';
$string['delete_confirmation'] = '您确定要删掉这个外部工具的配置吗？';
$string['deletetype'] = '删除外部工具配置';
$string['display_description'] = '启动后显示活动描述';
$string['display_description_help'] = '如果启用，上面设定的活动描述会显示在工具的内容上面。
此描述可以用来提供工具未提供的各种说明，不过这不是必须的。
如果工具是在新窗口中启动，则永远不会显示描述。';
$string['display_name'] = '启动后显示活动名';
$string['display_name_help'] = '如果启用，上面设定的活动名会显示在工具的内容上面。
工具提供商也有可能会显示活动名。此选项可以避免活动名被显示两次。
如果工具是在新窗口中启动，则永远不会显示活动名。';
$string['donot'] = '不发送';
$string['donotaccept'] = '不接受';
$string['donotallow'] = '不允许';
$string['edittype'] = '编辑外部工具配置';
$string['enableemailnotification'] = '发送通知邮件';
$string['external_tool_type'] = '外部工具类型';
$string['failedtoconnect'] = 'Moodle无法与“{$a}”系统通讯';
$string['filter_basiclti_password'] = '必须输入密码';
$string['fixnew'] = '新的配置';
$string['fixold'] = '使用现有的';
$string['force_ssl'] = '强制使用 SSL';
$string['icon_url'] = '图标的网址';
$string['id'] = 'id号';
$string['imsroleadmin'] = '教师,管理员';
$string['imsroleinstructor'] = '教师';
$string['imsrolelearner'] = '学习者';
$string['invalidid'] = 'LTI ID 不正确';
$string['launch_in_moodle'] = '在 moodle 中启动工具';
$string['launch_in_popup'] = '在弹出窗口中启动工具';
$string['modulename'] = '外部工具';
$string['tool_settings'] = '工具设置';
$string['toolsetup'] = '外部工具配置';
$string['toolurl'] = '工具基地址';
$string['toolurl_help'] = '工具基地址用来和启动 URL 匹配，以确定使用正确的工具配置。http(s) 前缀可有可无。
此外，如果外部工具实例中未指定启动 URL，会使用此基地址。





| **基地址** | **匹配** |
||
| tool.com | tool.com, tool.com/quizzes, tool.com/quizzes/quiz.php?id=10, www.tool.com/quizzes |
| www.tool.com/quizzes | tool.com/quizzes, tool.com/quizzes/take.php?id=10, www.tool.com/quizzes |
| quiz.tool.com | quiz.tool.com, quiz.tool.com/take.php?id=10 |
如果同一个域名有两条不同的工具配置，那么会使用匹配度最高的。';
$string['typename'] = '工具名';
$string['typename_help'] = '工具名用来在 Moodle 中区分不同的工具。教师在向课程添加外部工具时会看到工具名。';
