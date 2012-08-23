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
 * Strings for component 'tool_bloglevelupgrade', language 'zh_cn', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_bloglevelupgrade
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bloglevelupgradedescription'] = '<p>本站已经升级到Moodle 2.0</p>
<p>博客的可见性在2.0中简化了，但您的网站仍在使用某种旧的可见性类型。</p>
<p>为了保留基于课程或基于小组的博客可见性，您必须运行下面的脚本，它会在有用户发布博客的课程里建立一个特殊的“博客”类型的讨论区，并把这些博客条目拷贝到这个特殊讨论区中。</p>
<p>然后，所有博客在网站层面将被完全关闭。此过程中没有博客条目会被删除。</p>
<p>运行此脚本，请访问<a href="{$a->fixurl}">博客等级升级页面</a>。</p>
';
$string['bloglevelupgradeinfo'] = '博客的可见性在2.0中简化了，但您的网站仍在使用某种旧的可见性类型。为了保留基于课程或基于小组的博客可见性，下面的脚本会在有用户发布博客的课程里建立一个特殊的“博客”类型的讨论区，并把这些博客条目拷贝到这个特殊讨论区中。然后，所有博客在网站层面将被完全关闭。此过程中没有博客条目会被删除。';
$string['bloglevelupgradeprogress'] = '转换进度：审核了{$a->userscount}个用户，转换了{$a->blogcount}篇博文。';
$string['pluginname'] = '博客可见性升级';
