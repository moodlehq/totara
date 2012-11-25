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
 * Strings for component 'book', language 'ja', branch 'MOODLE_22_STABLE'
 *
 * @package   book
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addafter'] = '章の追加';
$string['book:edit'] = 'ブックの章を編集する';
$string['book:read'] = 'ブックを読む';
$string['book:viewhiddenchapters'] = '非表示のブックの章を表示する';
$string['chapters'] = '章';
$string['chapterscount'] = '章';
$string['chaptertitle'] = '章の題名';
$string['confchapterdelete'] = 'ほんとうにこの章を削除しますか?';
$string['confchapterdeleteall'] = 'ほんとうにこの章とその下にある節を削除しますか?';
$string['content'] = '内容';
$string['customtitles'] = 'カスタムタイトル';
$string['customtitles_help'] = '章題は自動的にTOCのみに表示されます。';
$string['editingchapter'] = '章を編集';
$string['errorchapter'] = 'ブックの章の読み込み中にエラーが発生しました。';
$string['faq'] = 'ブック FAQ';
$string['faq_help'] = '*なぜ2レベルのみですか?*
通常、すべてのブック (書籍)において2レベルで十分であり、3レベルになると貧弱な構造のドキュメントとなってしまいます。ブックモジュールは短めの複数ページの学習コンテンツを作成するために設計されました。さらに長いドキュメントでは、通常PDFフォーマットを使用した方が良いでしょう。PDFを作成する簡単な方法は仮想プリンタを使用する方法です (詳細は次のページをご覧ください:
[PDFCreator] (http://sector7g.wurzel6.de/pdfcreator/index_en.htm),
[PDFFactory] (http://fineprint.com/products/pdffactory/index.html),
[Adobe Acrobat] (http://www.adobe.com/products/acrobatstd/main.html),
, etc.)。
* 学生はブックを編集できますか? *
教師のみブックを作成および編集することができます。学生によるブック編集機能を実装する予定はありませんが、誰かが学生用の機能 (ポートフォリオ?) を開発することでしょう。作成および編集を教師のみに限定する理由は、ブックモジュールを可能な限りシンプルにすることにあります。
* どのようにブックを検索すれば良いのですか? *
現在、印刷ページをブラウザで検索する機能のみ提供されています。現在、グローバルサーチはMoodleフォーラムのみで利用できます。
Iブックを含むリソースすべてにおいて、グローバルサーチ機能が実装されることは素晴らしいと思いませんか? どなたかボランティアで開発しませんか?
* 私のタイトルが1行に収まりません *
あなたのタイトルを変更するか、TOCの幅を変更するようサイト管理者にお尋ねください。モジュール設定ページにて、すべてのブックモジュールに適用される値を変更することができます。';
$string['modulename'] = 'ブック';
$string['modulename_help'] = 'ブックはシンプルな複数ページの学習コンテンツです。';
$string['modulenameplural'] = 'ブック';
$string['navexit'] = 'ブックを終了する';
$string['navnext'] = '次';
$string['navprev'] = '前';
$string['numbering'] = '章の番号付け';
$string['numbering0'] = 'なし';
$string['numbering1'] = '番号';
$string['numbering2'] = '点';
$string['numbering3'] = 'インデント';
$string['numbering_help'] = '* なし - 章および節のタイトルは一切フォーマットされません。あなたが特別なナンバリングスタイルを定義したい場合に使用してください。例えば、文字を章のタイトルに使用する場合: "第一章", "第一章 節",...
* 数字 - 章および節は次のようにナンバリングされます (1, 1.1, 1.2, 2, ...)。
* 黒丸 - 節がインデントされて、黒丸と共に表示されます。
* インデント - 節がインデントされます。';
$string['numberingoptions'] = '利用可能なナンバリングオプション';
$string['numberingoptions_help'] = '新しいブック作成時に利用できるナンバリングオプションを選択してください。';
$string['page-mod-book-x'] = 'すべてのブックモジュールページ';
$string['pluginadministration'] = 'ブック管理';
$string['pluginname'] = 'ブック';
$string['subchapter'] = '節';
$string['toc'] = '目次';
$string['top'] = 'トップ';
