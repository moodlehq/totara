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
 * Strings for component 'chat', language 'ja', branch 'MOODLE_22_STABLE'
 *
 * @package   chat
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['ajax'] = 'Ajaxバージョン';
$string['autoscroll'] = 'オートスクロール';
$string['beep'] = 'ビープ';
$string['cantlogin'] = 'チャットルームに入室できませんでした!';
$string['chat:chat'] = 'チャットルームにアクセスする';
$string['chat:deletelog'] = 'チャットログを削除する';
$string['chat:exportparticipatedsession'] = 'あなたが参加した参加チャットセッションをエクスポートする';
$string['chat:exportsession'] = 'すべてのチャットセッションをエクスポートする';
$string['chat:readlog'] = 'チャットログを表示する';
$string['chat:talk'] = 'チャットで会話する';
$string['chatintro'] = 'イントロダクションテキスト';
$string['chatname'] = 'チャットルーム名';
$string['chatreport'] = 'チャットセッション';
$string['chattime'] = '次回のチャットタイム';
$string['configmethod'] = 'Ajaxチャットメソッドでは、サーバが定期的に更新する、Ajaxベースのチャットインターフェースを提供します。ノーマルチャットメソッドでは、クライアントが定期的にサーバにアクセスして内容を更新します。このメソッドは設定を必要とせず、どこでも動作します。しかし、チャット参加者が多くなった場合、サーバに大きな負荷がかかります。Chatサーバデーモンを使用する場合、Unixのシェルアクセスが必要です。また、Chatサーバデーモンにより軽快なチャット環境を提供することができます。';
$string['confignormalupdatemode'] = 'チャットルームは、通常HTTP 1.1の<em>Keep-Alive</em>機能を使用して、効果的に更新されます。 しかし、この方法はサーバに対して非常に負荷がかかります。さらに進歩した方法は、チャットルームの更新に<em>Stream</em>を使用するものです。<em>Stream</em>を使用する方法 (chatdメソッドに似ています) は、 <em>Keep-Alive</em>機能の使用より優れていますが、あなたのサーバではサポートされていない場合があります。';
$string['configoldping'] = 'ユーザの応答がなくなってから、どのくらいの時間 (秒数) で退室したとみなしますか? これは単に上限であり、通常の退室は非常に速く検出されます。小さな値を設定する場合、さらにサーバに対して負荷がかかります。ノーマルメソッドを使用している場合、2* chat_refresh_room より小さな値を<strong>設定しないでください</strong>。';
$string['configrefreshroom'] = 'どのくらいのタイミング (秒数) でチャットルームをリフレッシュしますか? この値を小さくすれば、チャットルームはレスポンスが良いように見えますが、多くの人がチャットをする場合、サーバにかかる負荷が高くなります。あなたが<em>Stream</em>更新を使用している場合、高いリフレッシュ頻度を設定することができます -- 2を試してみてください。';
$string['configrefreshuserlist'] = 'どのくらいのタイミング (秒数) でユーザリストをリフレッシュしますか?';
$string['configserverhost'] = 'サーバデーモンが稼動しているホスト名';
$string['configserverip'] = '上記ホスト名に合致するIPアドレス';
$string['configservermax'] = '最大クライアント数';
$string['configserverport'] = 'デーモンに使用するサーバのポート';
$string['currentchats'] = 'アクティブ・チャットセッション';
$string['currentusers'] = '現在のユーザ';
$string['deletesession'] = 'このセッションを削除する';
$string['deletesessionsure'] = '本当にこのセッションを削除してもよろしいですか?';
$string['donotusechattime'] = 'チャット時間を公開しない';
$string['enterchat'] = 'チャットルームに入室する';
$string['entermessage'] = 'あなたのメッセージを入力してください。';
$string['errornousers'] = 'ユーザが見つかりませんでした!';
$string['explaingeneralconfig'] = 'これらの設定は、<strong>常に</strong>使用されます。';
$string['explainmethoddaemon'] = 'これらの設定は、chat_methodに「Chatサーバデーモン」を選択した場合<strong>のみ</strong>影響します。';
$string['explainmethodnormal'] = 'これらの設定は、chat_methodに「ノーマルメソッド」を選択した場合<strong>のみ</strong>影響します。';
$string['generalconfig'] = '一般設定';
$string['idle'] = 'アイドル';
$string['inputarea'] = '入力エリア';
$string['invalidid'] = 'チャットルームが見つかりませんでした!';
$string['list_all_sessions'] = 'すべてのセッションを表示する';
$string['list_complete_sessions'] = '完了したセッションのみ表示する';
$string['listing_all_sessions'] = 'すべてのセッションを表示しています。';
$string['messagebeepseveryone'] = '{$a} が全員にビープします!';
$string['messagebeepsyou'] = '{$a} があなたにビープしました!';
$string['messageenter'] = '{$a} が入室しました。';
$string['messageexit'] = '{$a} が退室しました。';
$string['messages'] = 'メッセージ';
$string['messageyoubeep'] = 'あなたは {$a} を呼び出しました。';
$string['method'] = 'Chatメソッド';
$string['methodajax'] = 'Ajaxメソッド';
$string['methoddaemon'] = 'Chatサーバデーモン';
$string['methodnormal'] = 'ノーマルメソッド';
$string['modulename'] = 'チャット';
$string['modulename_help'] = 'チャットモジュールでは参加者がウェブを通してリアルタイムに同時ディスカッションを実施できます。これはお互いに異なる理解を得ること、およびトピックを議論することに役立ちます。チャットルームの利用は非同期のフォーラムの利用とは大きく異なります。';
$string['modulenameplural'] = 'チャット';
$string['neverdeletemessages'] = 'メッセージを削除しない';
$string['nextsession'] = '次のスケジュールセッション';
$string['no_complete_sessions_found'] = '終了したセッションは、見つかりませんでした。';
$string['nochat'] = 'チャットが見つかりませんでした。';
$string['noguests'] = 'ゲストは、このチャットを利用できません。';
$string['nomessages'] = 'メッセージがありません。';
$string['nopermissiontoseethechatlog'] = 'あなたにはこのチャットログを閲覧するためのパーミッションがありません。';
$string['normalkeepalive'] = 'KeepAlive';
$string['normalstream'] = 'Stream';
$string['noscheduledsession'] = 'スケジュールセッションがありません。';
$string['notallowenter'] = 'あなたはチャットルームへの入室を許可されていません。';
$string['notlogged'] = 'あなたはログインしていません!';
$string['oldping'] = '切断タイムアウト';
$string['page-mod-chat-x'] = 'すべてのチャットモジュールページ';
$string['pastchats'] = '過去のチャットセッション';
$string['pluginadministration'] = 'チャット管理';
$string['pluginname'] = 'チャット';
$string['refreshroom'] = 'チャットルームをリフレッシュする';
$string['refreshuserlist'] = 'ユーザリストをリフレッシュする';
$string['removemessages'] = 'すべてのメッセージを削除する';
$string['repeatdaily'] = '毎日同じ時間に';
$string['repeatnone'] = '繰り返しなし - 指定した時間にのみ公開する';
$string['repeattimes'] = 'セッションの繰り返し';
$string['repeatweekly'] = '毎週同じ時間に';
$string['saidto'] = '&gt;';
$string['savemessages'] = 'セッションの保存期間';
$string['seesession'] = 'このセッションを見る';
$string['send'] = '送信';
$string['sending'] = '送信中';
$string['serverhost'] = 'サーバ名';
$string['serverip'] = 'サーバIP';
$string['servermax'] = '最大ユーザ';
$string['serverport'] = 'サーバポート';
$string['sessions'] = 'チャットセッション';
$string['sessionstart'] = 'チャットセッション開始日時: {$a}';
$string['strftimemessage'] = '%H:%M';
$string['studentseereports'] = 'すべての人が過去のセッションを閲覧できる';
$string['studentseereports_help'] = '「No」にした場合、mod/chat:readlogケイパビリティが割り当てられたユーザのみチャットログを閲覧することができます。';
$string['talk'] = '会話';
$string['updatemethod'] = '更新方法';
$string['updaterate'] = '更新レート:';
$string['userlist'] = 'ユーザリスト';
$string['usingchat'] = 'チャットを使用する';
$string['usingchat_help'] = 'チャットモジュールにはチャットを若干快適にするための機能があります。

**スマイリー**
: Moodleのどこでも入力できる笑顔 (エモーティコン) は、ここでも入力することができ、正しく表示されます。例えば、 :-) のように表示されます。
**リンク**
: インターネットアドレスは自動的にリンクに変換されます。
**感情**
: 行を"/me" または ":" で始めることで感情を表現できます。例えば、あなたの名前がKimの場合、":laughs!" または "/me laughs!"と入力することで、「Kimが笑っている!」状態を全員が見ることができます。
**ビープ**
: 名前の隣にある「ビープ」をクリックすることで、他の人にサウンドを送ることができます。「beep all」と入力することで、チャット中の全員に一斉にビープできる便利な機能もあります。
**HTML**
: あなたがHTMLコードを知っているのでしたら、イメージを挿入したり、音を鳴らしたり、色やサイズの異なるテキストを作成することができます。';
$string['viewreport'] = '過去のチャットセッションを表示する';
