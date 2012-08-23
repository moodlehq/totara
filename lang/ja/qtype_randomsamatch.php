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
 * Strings for component 'qtype_randomsamatch', language 'ja', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_randomsamatch
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addingrandomsamatch'] = 'ランダム記述組み合わせ問題の追加';
$string['editingrandomsamatch'] = 'ランダム記述組み合わせ問題の編集';
$string['nosaincategory'] = 'あなたが選択したカテゴリ「 {$a->catname} 」には、記述問題がありません。いくつかの記述問題を含んだ異なるカテゴリを選択してください。';
$string['notenoughsaincategory'] = 'あなたが選択したカテゴリ「 {$a->catname} 」には、{$a->nosaquestions} 問の問題のみ含まれています。異なるカテゴリを選択して、さらに問題を含むようにするか、あなたが設定した選択問題数を減らしてください。';
$string['randomsamatch'] = 'ランダム記述組み合わせ';
$string['randomsamatch_help'] = '学生の視点からは、これは組み合わせ問題のように見えます。違いは組み合わせのための名称または記述 (問題) が現在のカテゴリ内からランダムに取得される点です。未使用の十分な記述問題をカテゴリ内に入れる必要があります。そうでない場合、エラーメッセージが表示されます。';
$string['randomsamatchsummary'] = '組み合わせ問題と似ていますが、特定のカテゴリ内の記述問題をランダムに取得して作成されます。';
