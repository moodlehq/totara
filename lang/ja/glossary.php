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
 * Strings for component 'glossary', language 'ja', branch 'MOODLE_22_STABLE'
 *
 * @package   glossary
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcomment'] = 'コメントを追加する';
$string['addentry'] = '新しいエントリを追加する';
$string['addingcomment'] = 'コメントを追加する';
$string['alias'] = 'キーワード';
$string['aliases'] = 'キーワード';
$string['aliases_help'] = '用語集の各エントリに関連付けられたキーワードリスト (エイリアス) を付加することができます。
**新しい行にそれぞれのエイリアスを入力してください。** (カンマで区切らずに)
エイリアスの単語やフレーズは、エントリを参照する代替手段として使うことができます。例えば、用語集のオートリンクフィルタを使用している場合、エイリアス (同時にエントリ名) がエントリへのオートリンク時に使用されます。';
$string['allcategories'] = 'すべてのカテゴリ';
$string['allentries'] = 'すべて';
$string['allowcomments'] = 'エントリへのコメントを許可する';
$string['allowcomments_help'] = '学生に用語集エントリへのコメント投稿を許可することができます。
この設定を使用するかどうか選択することができます。
教師は常に用語集エントリにコメントを追加することができます。';
$string['allowduplicatedentries'] = '重複エントリを許可する';
$string['allowduplicatedentries_help'] = 'この設定を「Yes」にした場合、同一の用語に対して複数のエントリを作成することができます。';
$string['allowprintview'] = '印刷モードを許可する';
$string['allowprintview_help'] = '学生に用語集の印刷モード使用を許可します。
この機能を有効 (Yes) または無効 (No) にすることができます。
教師は、常に印刷モードを使用することができます。';
$string['andmorenewentries'] = 'および {$a} 件の新しいエントリ';
$string['answer'] = '答え';
$string['approve'] = '承認';
$string['areyousuredelete'] = '本当にこのエントリを削除してもよろしいですか?';
$string['areyousuredeletecomment'] = '本当にこのコメントを削除してもよろしいですか?';
$string['areyousureexport'] = '本当にこのエントリを下記の用語集にエクスポートしてもよろしいですか?';
$string['ascending'] = '昇順';
$string['attachment'] = '添付';
$string['attachment_help'] = '1つまたはそれ以上のファイルを用語集のエントリに添付することができます。このファイルはサーバにアップロードされ、エントリと一緒に保存されます。
この機能は画像やワープロ文書を共有する場合に便利です。
どのような種類のファイルも添付することができますが、Wordドキュメント .doc、イメージ .jpg または .png のような標準的な3文字の接尾辞を使用されることを強くお勧めします。このようにすることで、他の人がファイルをダウンロードした後に、内容を表示しやすくなります。
エントリを編集して新しい添付ファイルを登録する場合、以前のファイルは最新のものと入れ替えられます。
エントリを編集して添付ファイル欄を空白にする場合、以前のファイルはそのままにされます。';
$string['author'] = '著者';
$string['authorview'] = '著者順';
$string['back'] = '戻る';
$string['cantinsertcat'] = 'カテゴリを追加できません。';
$string['cantinsertrec'] = 'レコードを追加できません。';
$string['cantinsertrel'] = '関連カテゴリエントリを追加できません。';
$string['casesensitive'] = '大文字小文字を区別する';
$string['casesensitive_help'] = 'ここでは、エントリにオートリンクする場合、大文字小文字を厳密に区別するかどうか設定します。
例えば、この設定を有効にした場合、「html」という単語がフォーラムに投稿されても、「HTML」という用語集エントリにはリンクされません。';
$string['cat'] = 'カテゴリ';
$string['categories'] = 'カテゴリ';
$string['category'] = 'カテゴリ';
$string['categorydeleted'] = 'カテゴリが削除されました。';
$string['categoryview'] = 'カテゴリ順';
$string['changeto'] = '{$a} に変更する';
$string['cnfallowcomments'] = '用語集のエントリへのコメントをデフォルトで許可します。';
$string['cnfallowdupentries'] = '重複エントリを許可します。';
$string['cnfapprovalstatus'] = '学生による投稿をデフォルトで承認します。';
$string['cnfcasesensitive'] = 'エントリがリンクされる場合、大文字小文字を区別します。';
$string['cnfdefaulthook'] = '用語集が表示される時のデフォルトセクションを選択してください。';
$string['cnfdefaultmode'] = '用語集が最初に表示される時のデフォルトフレームを選択してください。';
$string['cnffullmatch'] = 'エントリがリンクされる場合、ターゲットテキストと文字の大小 (大文字小文字) を合わせます。';
$string['cnflinkentry'] = 'エントリをデフォルトで自動リンクさせます。';
$string['cnflinkglossaries'] = '用語集をデフォルトで自動リンクさせます。';
$string['cnfrelatedview'] = 'オートリンクおよびエントリ表示に使用する表示フォーマットを選択してください。';
$string['cnfshowgroup'] = 'グループ区切りを表示するかどうか指定してください。';
$string['cnfsortkey'] = 'デフォルトの並び替えキーを選択してください。';
$string['cnfsortorder'] = 'デフォルトの並び替え順を選択してください。';
$string['cnfstudentcanpost'] = '学生のエントリ投稿をデフォルトで許可します。';
$string['comment'] = 'コメント';
$string['commentdeleted'] = 'コメントが削除されました。';
$string['comments'] = 'コメント';
$string['commentson'] = 'コメント';
$string['commentupdated'] = 'コメントが更新されました。';
$string['completionentries'] = '学生はエントリを作成する必要がある:';
$string['completionentriesgroup'] = '必須エントリ';
$string['concept'] = '用語';
$string['concepts'] = '用語';
$string['configenablerssfeeds'] = 'すべての用語集に関するRSSフィードを有効にします。あなたはそれぞれの用語集設定において、手動でRSSフィードを有効にする必要があります。';
$string['current'] = '現在の並び替え順: {$a}';
$string['currentglossary'] = '現在の用語集';
$string['date'] = '日付';
$string['dateview'] = '日付順';
$string['defaultapproval'] = 'デフォルトで承認する';
$string['defaultapproval_help'] = 'ここでは学生が新しいエントリを追加した場合、どのように処理するか教師が設定することができます。学生が追加したエントリは、自動的に全員に公開することができます。そうでなければ、教師が各エントリを承認する必要があります。';
$string['defaulthook'] = 'デフォルトフック';
$string['defaultmode'] = 'デフォルトモード';
$string['defaultsortkey'] = 'デフォルトの並び替えキー';
$string['defaultsortorder'] = 'デフォルトの並び替え順';
$string['definition'] = '定義';
$string['definitions'] = '定義';
$string['deleteentry'] = 'エントリの削除';
$string['deletenotenrolled'] = '登録されていないユーザのエントリを削除する';
$string['deletingcomment'] = 'コメントの削除';
$string['deletingnoneemptycategory'] = '空でないカテゴリが削除された場合、関係するエントリも同時に削除されます。エントリを削除したい場合は、手動で行ってください。';
$string['descending'] = '降順';
$string['destination'] = 'インポート先';
$string['destination_help'] = 'エントリをどこにインポートしたいか指定することができます:
* **|現在の用語集:** 現在開いている用語集に新しいエントリが追加されます。
* **|新しい用語集:** 選択されたインポートファイルの情報を元に、新しい用語集が作成され、新しいエントリが追加されます。';
$string['displayformat'] = '表示フォーマット';
$string['displayformat_help'] = '用語集には以下7つの表示フォーマットがあります:
*シンプル、辞書スタイル - 著者は表示されず、添付ファイルはリンクとして表示されます。
*連続 - エントリが編集アイコンとともに分離されずに連続表示されます。
*フル、著者有り - 著者情報とともにフォーラムのように表示されます。添付ファイルはリンクとして表示されます。
*フル、著者なし - 著者情報なしでフォーラムのように表示されます。添付ファイルはリンクとして表示されます。
*百科辞書 - 「フル、著者有り」のように表示されます。イメージは用語集の内部に表示されます。
*エントリリスト - 用語をリンクとして一覧表示します。
*FAQ - それぞれの「用語」および「定義」に対して、自動的に「質問」および「答え」の文字が追加されます。';
$string['displayformatcontinuous'] = '連続、著者なし';
$string['displayformatdictionary'] = 'シンプル、辞書スタイル';
$string['displayformatencyclopedia'] = '百科事典';
$string['displayformatentrylist'] = 'エントリリスト';
$string['displayformatfaq'] = 'FAQ';
$string['displayformatfullwithauthor'] = 'フル、著者有り';
$string['displayformatfullwithoutauthor'] = 'フル、著者なし';
$string['displayformats'] = '表示フォーマット';
$string['displayformatssetup'] = '表示フォーマット設定';
$string['duplicatecategory'] = 'カテゴリを複製する';
$string['duplicateentry'] = 'エントリの重複';
$string['editalways'] = '常に編集を許可する';
$string['editalways_help'] = 'ここでは学生が常にエントリを編集できるか設定することができます。
下記のオプションを選択をすることができます:

* **|Yes:** 常にエントリを編集することができます。
* **|No:** 設定された期間内は、エントリを編集することができます。';
$string['editcategories'] = 'カテゴリを編集する';
$string['editentry'] = 'エントリの編集';
$string['editingcomment'] = 'コメントの編集';
$string['entbypage'] = '1ページあたりのエントリ数';
$string['entries'] = 'エントリ';
$string['entrieswithoutcategory'] = 'カテゴリなしのエントリ';
$string['entry'] = 'エントリ';
$string['entryalreadyexist'] = 'エントリがすでに登録されています。';
$string['entryapproved'] = 'エントリが承認されました。';
$string['entrydeleted'] = 'エントリが削除されました。';
$string['entryexported'] = 'エントリが正常にエクスポートされました。';
$string['entryishidden'] = '( このエントリは現在非表示にされています。)';
$string['entryleveldefaultsettings'] = 'エントリレベルのデフォルト設定';
$string['entrysaved'] = 'エントリが保存されました。';
$string['entryupdated'] = 'エントリが更新されました。';
$string['entryusedynalink'] = 'エントリを自動的にリンクさせる';
$string['entryusedynalink_help'] = 'この設定を有効にすると、単語が同一コース内に現れた場合、自動的にリンクされます。この機能は、フォーラムの投稿、内部リソース、週の概要等に適用されます。
特定のテキストをリンクさせたくない場合 (例えばフォーラムの投稿) 、テキストの前後に および  タグを付加してください。
この機能を使用するためには、用語集レベルでオートリンク機能を有効にする必要があります。';
$string['errcannoteditothers'] = 'あなたは他の人のエントリを編集できません。';
$string['errconceptalreadyexists'] = 'この用語はすでに登録されています。この用語集では、重複エントリは許可されていません。';
$string['errdeltimeexpired'] = 'あなたは、このエントリを削除できません。編集期限は終了しました!';
$string['erredittimeexpired'] = 'このエントリの編集期限は終了しました。';
$string['errorparsingxml'] = 'ファイルの構文解析中にエラーが発生しました。有効なXMLシンタックスかどうか確認してください。';
$string['explainaddentry'] = '用語集に新しいエントリを追加します。<br />用語と定義は必須入力項目です。';
$string['explainall'] = 'すべてのエントリを1ページに表示';
$string['explainalphabet'] = 'インデックスを利用して用語集を表示';
$string['explainexport'] = '用語集をエクスポートするには、下記のボタンをクリックしてください。<br />いつでも必要なときに、用語集をこのコースまたは他のコースにインポートすることができます。<p>添付ファイル (例 イメージ) および著者はエクスポートされませんので注意してください。</p>';
$string['explainimport'] = 'インポートするファイルおよび処理のクライテリアを指定してください。<p>実行後、結果を検証してください。</p>';
$string['explainspecial'] = '１文字で始まらないエントリを表示します。';
$string['exportedentry'] = 'エクスポートされたエントリ';
$string['exportentries'] = 'エントリのエクスポート';
$string['exportentriestoxml'] = 'エントリをXMLファイルにエクスポートする';
$string['exportfile'] = 'エントリをファイルにエクスポートする';
$string['exportglossary'] = '用語集のエクスポート';
$string['exporttomainglossary'] = 'メイン用語集へのエクスポート';
$string['filetoimport'] = 'インポートするファイル';
$string['filetoimport_help'] = 'あなたのコンピュータにある、インポートするエントリを含んだXMLファイルを選択してください。';
$string['fillfields'] = '用語と定義は必須入力項目です。';
$string['filtername'] = '用語集オートリンク';
$string['fullmatch'] = '完全一致のみ';
$string['fullmatch_help'] = '「エントリを自動的にリンクさせる」を有効にして、この設定を有効にすると、単語が完全に一致した場合のみリンクされます。
例えば、用語集エントリの「construct」という単語は、内部に同じ単語が含まれた「constructivism」にはリンクされません。';
$string['glossary:approve'] = '未承認のエントリを承認する';
$string['glossary:comment'] = 'コメントを作成する';
$string['glossary:export'] = 'エントリをエクスポートする';
$string['glossary:exportentry'] = '単一エントリをエクスポートする';
$string['glossary:exportownentry'] = 'あなたの単一エントリをエクスポートする';
$string['glossary:import'] = 'エントリをインポートする';
$string['glossary:managecategories'] = 'カテゴリを管理する';
$string['glossary:managecomments'] = 'コメントを管理する';
$string['glossary:manageentries'] = 'エントリを管理する';
$string['glossary:rate'] = 'エントリを評価する';
$string['glossary:view'] = '用語集を表示する';
$string['glossary:viewallratings'] = '個々のユーザから与えられた実評価すべてを表示する';
$string['glossary:viewanyrating'] = 'すべてのユーザが受けた評価合計を表示する';
$string['glossary:viewrating'] = 'あなたが受けた評価合計を表示する';
$string['glossary:write'] = '新しいエントリを作成する';
$string['glossaryleveldefaultsettings'] = '用語集レベルのデフォルト設定';
$string['glossarytype'] = '用語集タイプ';
$string['glossarytype_help'] = '用語集システムでは、コースのメイン用語集に補助的な (サブ) 用語集からエントリをエクスポートすることができます。エントリをエクスポートするためには、どの用語集がメイン用語集であるか指定してください。
注意: 1コースあたり1つのメイン用語集を設定することができます。
Moodle 1.7以前では、教師のみメイン用語集を更新することができます。Moodle 1.7以降では、誰が (メイン用語集を含む) 用語集を編集できるかコントロールしたい場合、ロールのオーバーライドインターフェースを使用してください。';
$string['guestnoedit'] = 'ゲストは、用語集を編集できません。';
$string['importcategories'] = 'カテゴリをインポートする';
$string['importedcategories'] = 'インポートされたカテゴリ';
$string['importedentries'] = 'インポートされたエントリ';
$string['importentries'] = 'エントリのインポート';
$string['importentriesfromxml'] = 'エントリをXMLファイルからインポートする';
$string['includegroupbreaks'] = 'グループ区切りを含む';
$string['isglobal'] = 'これはグローバル用語集ですか?';
$string['isglobal_help'] = '管理者およびケイパビリティ「すべての動作を許可する (site:doanything)」が割り当てられているユーザのみ用語集をグローバルに定義することができます。
グローバル用語集は、すべてのコースに属すること (通常はフロントページ) ができます。
通常のローカル用語集との違いは、グローバル用語集が属している同一コースだけではなく、サイト全体を通してオートリンクされる点にあります。';
$string['letter'] = 'アルファベット';
$string['linkcategory'] = 'このカテゴリを自動的にリンクする';
$string['linkcategory_help'] = 'あなたはカテゴリを自動的にリンクさせるかどうか設定することができます。
注意: カテゴリは文字小文字を区別し、完全一致に基づきリンクされます。';
$string['linking'] = 'オートリンク';
$string['mainglossary'] = 'メイン用語集';
$string['maxtimehaspassed'] = '申し訳ございません、このコメントの最大編集回数 ({$a}) を超えました!';
$string['modulename'] = '用語集';
$string['modulename_help'] = '用語集では参加者が辞書のような定義リストを作成および管理することができます。コースを通して表示される用語および定義に用語集エントリを自動リンクすることができます。';
$string['modulenameplural'] = '用語集';
$string['newentries'] = '新しい用語集エントリ';
$string['newglossary'] = '新しい用語集';
$string['newglossarycreated'] = '新しい用語集が作成されました。';
$string['newglossaryentries'] = '新規用語集エントリ';
$string['nocomment'] = 'コメントが見つかりませんでした。';
$string['nocomments'] = '( このエントリにはコメントがありません。)';
$string['noconceptfound'] = '用語または定義が見つかりませんでした。';
$string['noentries'] = 'このセクションにはエントリがありません。';
$string['noentry'] = 'エントリが見つかりませんでした。';
$string['nopermissiontodelcomment'] = 'あなたは、他のユーザのコメントを削除できません!';
$string['nopermissiontodelinglossary'] = 'あなたは、この用語集にコメントを追加できません!';
$string['nopermissiontoviewresult'] = 'あなたは、自分のエントリの結果のみ閲覧できます。';
$string['notapproved'] = '用語集エントリはまだ承認されていません。';
$string['notcategorised'] = 'カテゴリなし';
$string['numberofentries'] = 'エントリ数';
$string['onebyline'] = '(1行あたり1件)';
$string['page-mod-glossary-edit'] = '用語集エントリ追加/編集ページ';
$string['page-mod-glossary-view'] = '用語集編集ページを表示する';
$string['page-mod-glossary-x'] = 'すべての用語集モジュールページ';
$string['pluginadministration'] = '用語集管理';
$string['pluginname'] = '用語集';
$string['popupformat'] = 'ポップアップフォーマット';
$string['printerfriendly'] = '印刷モード';
$string['printviewnotallowed'] = '印刷モードは許可されていません。';
$string['question'] = '質問';
$string['rejectedentries'] = '拒否されたエントリ';
$string['rejectionrpt'] = '拒否レポート';
$string['resetglossaries'] = 'エントリの削除対象';
$string['resetglossariesall'] = 'すべての用語集からエントリを削除する';
$string['rssarticles'] = '最近の活動のRSS数';
$string['rssarticles_help'] = 'ここではRSSフィードに含まれる記事数を設定します。
ほとんどの用語集では、5から20の間が適切であると思われます。用語集が頻繁に更新される場合は、この値を増やしてください。';
$string['rsssubscriberss'] = '{$a} の用語のRSSフィードを表示する';
$string['rsstype'] = 'この活動のRSSフィード';
$string['rsstype_help'] = 'ここでは、用語集のRSSフィードを利用可にすることができます。
RSSフィードは、2種類の中から選択することができます:

* **|著者有り:** すべての記事に関して著者名を含むRSSフィードが生成されます。
* **|著者なし:** すべての記事に関して著者名を含まないRSSフィードが生成されます。';
$string['searchindefinition'] = '全文検索する';
$string['secondaryglossary'] = 'サブ用語集';
$string['showall'] = 'すべてのリンクを表示する';
$string['showall_help'] = 'ここでは、ユーザが用語集を閲覧する方法をカスタマイズすることができます。用語集は、常に閲覧および検索することができますが、下記の3つのオプションを設定することもできます:
**特別リンクを表示する** @、#のような特別な文字を表示するかどうか設定します。
**アルファベットを表示する** アルファベットで閲覧するかどうか設定します。
**すべてのリンクを表示する** すべてのエントリを一度に表示するかどうか設定します。';
$string['showalphabet'] = 'アルファベットを表示する';
$string['showalphabet_help'] = 'ここでは、ユーザが用語集を閲覧する方法をカスタマイズすることができます。用語集は、常に閲覧および検索することができますが、下記の3つのオプションを設定することもできます:
**特別リンクを表示する** @、#のような特別な文字を表示するかどうか設定します。
**アルファベットを表示する** アルファベットで閲覧するかどうか設定します。
**すべてのリンクを表示する** すべてのエントリを一度に表示するかどうか設定します。';
$string['showspecial'] = '特別リンクを表示する';
$string['showspecial_help'] = 'ここではユーザが用語集を閲覧する方法をカスタマイズすることができます。用語集は、常に閲覧および検索することができますが、下記の3つのオプションを設定することもできます:
**特別リンクを表示する** @、#のような特別な文字を表示するかどうか設定します。
**アルファベットを表示する** アルファベットで閲覧するかどうか設定します。
**すべてのリンクを表示する** すべてのエントリを一度に表示するかどうか設定します。';
$string['sortby'] = '並び替え';
$string['sortbycreation'] = '作成日時';
$string['sortbylastupdate'] = '最終更新日時';
$string['sortchronogically'] = '日付順の並び替え';
$string['special'] = '特別';
$string['standardview'] = 'アルファベット順';
$string['studentcanpost'] = '学生のエントリ追加を許可する';
$string['totalentries'] = 'エントリ合計';
$string['usedynalink'] = 'エントリを自動的にリンクする';
$string['usedynalink_help'] = 'この設定を「Yes」にすると、同一コースを通して、用語集に使用されている用語が使用された場合、自動的に用語集とリンクされます。オートリンクされる対象は、フォーラムの投稿、内部のリソース、週の概要等におよびます。
用語集とのリンクを有効にしても、それぞれのエントリに自動的にリンクされるわけではありませんので注意してください - オートリンクするよう個々のエントリに設定する必要があります。
特定のテキストをリンクさせたくない場合 (例えばフォーラムの投稿)、テキストの前後に  および  タグを付加してください。
カテゴリ名もオートリンクされますので注意してください。';
$string['waitingapproval'] = '承認待ち';
$string['warningstudentcapost'] = '(用語集がメイン用語集では無い場合に適用)';
$string['withauthor'] = '用語 (著者有り)';
$string['withoutauthor'] = '用語 (著者なし)';
$string['writtenby'] = '作成';
$string['youarenottheauthor'] = 'あなたはこのコメントの投稿者ではありません。コメントの編集は許可されません。';
