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
 * Strings for component 'tool_unittest', language 'zh_cn', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_unittest
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addconfigprefix'] = '为配置文件添加前缀';
$string['all'] = '全部';
$string['codecoverageanalysis'] = '进行代码覆盖分析。';
$string['codecoveragecompletereport'] = '（查看代码覆盖完整报告）';
$string['codecoveragedisabled'] = '不能在此服务器做代码覆盖测试（缺少xdebug扩展）。';
$string['codecoveragelatestdetails'] = '（{$a->date}，{$a->files}个文件，覆盖了{$a->percentage}）';
$string['codecoveragelatestreport'] = '查看最新代码覆盖完整报告';
$string['confignonwritable'] = '网页服务器不能改写 config.php 文件。要么改变权限，要么用合适的用户帐户编辑它并在 PHP 结束标记前加入以下行：<br />
$CFG->unittestprefix = \'tst_\' // Change tst_ to a prefix of your choice, different from $CFG->prefix';
$string['coveredlines'] = '已覆盖的行';
$string['dbtest'] = '数据库功能性测试';
$string['deletingnoninsertedrecord'] = '尝试删除一行不是这些单元测试用例插入的数据（在表{$a->table}中，id是{$a->id}）';
$string['deletingnoninsertedrecords'] = '试图删除不是这些单元测试（来自表{$a->table}）插入的记录。';
$string['droptesttables'] = '删除测试表';
$string['exception'] = '异常';
$string['executablelines'] = '可执行的行';
$string['fail'] = '失败';
$string['ignorefile'] = '忽略文件中的测试';
$string['ignorethisfile'] = '忽略此测试文件，重新运行测试。';
$string['installtesttables'] = '安装测试表';
$string['moodleunittests'] = 'Moodle单元测试：{$a}';
$string['notice'] = '注意';
$string['onlytest'] = '测试只运行于';
$string['othertestpages'] = '其它测试页面';
$string['pass'] = '通过';
$string['pathdoesnotexist'] = '路径“{$a}”不存在。';
$string['pluginname'] = '单元测试';
$string['prefix'] = '单元测试表前缀';
$string['prefixnotset'] = '未配置单元测试数据库表前缀。填写并提交此表单，把它添加到config.php中。';
$string['reinstalltesttables'] = '重新安装测试表';
$string['retest'] = '重新运行测试。';
$string['retestonlythisfile'] = '只重新运行此测试文件。';
$string['runall'] = '运行来自全部测试文件的测试。';
$string['runat'] = '在{$a}上运行。';
$string['runonlyfile'] = '在此文件中只运行测试';
$string['runonlyfolder'] = '在此目录中只运行测试';
$string['runtests'] = '运行测试';
$string['rununittests'] = '运行单元测试';
$string['showpasses'] = '既显示通过也显示失败。';
$string['showsearch'] = '显示用于测试文件的搜索。';
$string['skip'] = '跳过';
$string['stacktrace'] = '栈跟踪：';
$string['summary'] = '{$a->run}/{$a->total} 测试用例完成：
<strong>{$a->passes}</strong>个通过，<strong>{$a->fails}</strong>个失败和<strong>{$a->exceptions}</strong>个异常。';
$string['tablesnotsetup'] = '单元测试表还未生成。您想现在生成吗？';
$string['testdboperations'] = '测试数据库操作';
$string['testtablescsvfileunwritable'] = '测试表的CSV文件不可写（{$a->filename}）';
$string['testtablesneedupgrade'] = '测试数据表需要升级。您想现在继续进行升级吗？';
$string['testtablesok'] = '测试数据表已经成功安装。';
$string['thorough'] = '运行整个测试（可能会很慢）。';
$string['timetakes'] = '花费时间：{$a}。';
$string['totallines'] = '总行数';
$string['uncaughtexception'] = '未捕获在[{$a->getFile()}:{$a->getLine()}]中发生的异常[{$a->getMessage()}]。测试异常中断。';
$string['uncoveredlines'] = '未覆盖的行';
$string['unittest:execute'] = '执行单元测试';
$string['unittestprefixsetting'] = '单元测试前缀： <strong>{$a->unittestprefix}</strong> （编辑 config.php 来修改此项）.';
$string['unittests'] = '单元测试';
$string['updatingnoninsertedrecord'] = '尝试更新一行不是这些单元测试用例插入的数据（在表{$a->table}中，id是{$a->id}）';
$string['version'] = '使用<a href="http://sourceforge.net/projects/simpletest/">SimpleTest</a> {$a}版。';
