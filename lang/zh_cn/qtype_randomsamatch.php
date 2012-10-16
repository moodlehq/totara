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
 * Strings for component 'qtype_randomsamatch', language 'zh_cn', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_randomsamatch
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addingrandomsamatch'] = '添加一道随机填空匹配题';
$string['editingrandomsamatch'] = '编辑随机填空匹配题';
$string['nosaincategory'] = '在选择的\'{$a->catname}\'类别中没有填空题。请选择另一个类别，或者在此类别一些试题。';
$string['notenoughsaincategory'] = '在您选择的类别“{$a->catname}”中只有{$a->nosaquestions}道填空题。请选择另一个类别，在此类别中再建几道题或者减少您需要的试题数量。';
$string['randomsamatch'] = '随机填空匹配题';
$string['randomsamatch_help'] = '从学生的角度看，很像匹配题。区别是，名词和短句（问题）列表是从当前类别的填空题中随机抽取的。此类别中必须有足够数量的还未使用的填空题，否则会显示错误信息。';
$string['randomsamatchsummary'] = '很像匹配题，不过是用指定类别中的填空题随机生成的。';
