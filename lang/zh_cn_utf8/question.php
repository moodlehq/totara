<?php // $Id$
// question.php - created with Moodle 1.8 dev

$string['adminreport'] = '报告试题库中的可能的问题';
$string['broken'] = '这时一个 \"坏链接\"，它指向一个不存在的文件。';
$string['byandon'] = '<em>$a->user</em>|<em>$a->time</em>';
$string['categorydoesnotexist'] = '该类别不存在';
$string['categorycurrent'] = '当前类别';
$string['categorycurrentuse'] = '使用该类别';
$string['categorymoveto'] = '保存在类别中';
$string['changepublishstatuscat'] = '课程 \"$a->coursename\"中的 <a href=\"$a->caturl\">类别 \"$a->name\"</a> 可将其共享状态从 <strong>$a->changefrom 更改为 $a->changeto</strong>。';
$string['cwrqpfs'] = '从子类别中随机选择试题。';
$string['cwrqpfsinfo'] = '<p>在升级到 Moodle 1.9 后，我们将试题类别分类为
不同的上下文中。您的站点中的一些试题类别和试题将必须更改其共享
状态。在测验中，如果存在从共享和不共享类别中选择的一个或多个 \'随机\'试题
这种少见的情况，则必须采取这种措施（如本站点中的情况）。这是在一个 \'随机\'试题设置为选自
子类别并且一个或多个子类别中存在与
创建问题的父类别不同的共享状态时发生的。</p>
<p>父类别中的\'随机\'试题从以下问题类别中选择试题，
在升级到 Moodle 1.9 时，这些问题类别将其共享状态更改为与\'随机\'试题所在的类别相同的共享状态
。以下类别的共享状态将更改。受到影响的试题将继续
在所有现有测验中保持有效，直至您将其从这些测验中删除。</p>';
$string['cwrqpfsnoprob'] = '由于没有子类别，所以从子类别中随机选择试题受到印象。';
$string['copy']= '从  $a  复制并且更改链接。';
$string['created'] = '已创建';
$string['createdmodifiedheader'] = '创建/上次保存';
$string['defaultfor'] = '默认  $a ';
$string['defaultinfofor'] = '课程：$a 中共享的默认题目类型。';
$string['deletecoursecategorywithquestions'] = '试题库中存在与此课程类别关联的试题。如果您继续，这些试题将被删除。您可能希望首先使用试题库界面移动这些试题。';
$string['donothing']= '不要复制或移动文件或更改链接。';
$string['editingcategory'] = '编辑一个类别';
$string['editingquestion'] = '编辑一道试题';
$string['editthiscategory'] = '编辑该类别';
$string['erroraccessingcontext'] = '无法访问上下文';
$string['errordeletingquestionsfromcategory'] = '从类别 $a 中删除试题出错。';
$string['errorfilecannotbecopied'] = '无法复制文件  $a ';
$string['errorfilecannotbemoved'] = '无法移动文件  $a ';
$string['errorfileschanged'] = '错误！链接到试题的文件已经更改了。';
$string['errormanualgradeoutofrange'] = '试题 $a->name 的成绩 $a->grade 未介于 0 和 $a->maxgrade 之间。分数和批注未保存。';
$string['errormovingquestions'] = '移动 id 为 $a 的试题时出错。';
$string['errorprocessingresponses'] = '处理答案时出错。';
$string['errorsavingcomment'] = '在数据库中保存试题 $a->name 的批注时出错。';
$string['errorupdatingattempt'] = '在数据库中更新试答 $a->id 时出错。';
$string['exportcategory'] = '导出类别';
$string['filecantmovefrom'] = '试题文件无法移动，因为您没有权限将文件从您尝试移动试题的位置删除。';
$string['filecantmoveto'] = '试题文件无法移动或复制，因为您没有权限将文件添加到您尝试将试题移动到的位置。';
$string['filesareasite']= '站点文件区';
$string['filesareacourse']= '课程文件区';
$string['filestomove']= '移动/复制文件到  $a ？';
$string['fractionsnomax'] = '其中的一个答案应该是 100%%，这样这道题才能拿到满分。';
$string['getcategoryfromfile'] = '从文件中获得类别';
$string['getcontextfromfile'] = '从文件中获得上下文';
$string['ignorebroken'] = '忽略坏链接';
$string['invalidcontextinhasanyquestions'] = '向 question_context_has_any_questions 发送了无效的上下文。';
$string['linkedfiledoesntexist'] = '链接文件 $a 不存在';
$string['makechildof'] = '\'$a\'的子文件';
$string['maketoplevelitem'] = '移动至顶层';
$string['missingimportantcode'] = '该试题类型缺少重要代码  $a 。';
$string['modified'] = '最后保存';
$string['move']= '从  $a  移动并更改链接';
$string['movecategory']= '移动类别';
$string['movedquestionsandcategories'] = '已移动试题和试题类别（从 $a->oldplace 到 $a->newplace）。';
$string['movelinksonly']= '仅更改链接指向，不移动或删除文件';
$string['moveqtoanothercontext']= '移动试题至其他上下文中';
$string['moveq']= '移动试题';
$string['movingcategory']= '移动类别';
$string['movingcategoryandfiles']= '确定移动类别 \" $a->name \"和所有子类别至 \" $a->contextto \"吗？<br />已经检测到 $a->urlcount 个文件与 $a->fromareaname相链接，确定要复制或移动至 $a->toareaname 吗？';
$string['movingcategorynofiles']= '确定移动类别 \" $a->name\"和所有子类别至 \" $a->contextto \"吗？';
$string['movingquestions'] = '移动试题和所有文件吗？';
$string['movingquestionsandfiles']= '确定移动试题 \"$a->questions\"至<strong> \" $a->tocontext\"</strong>吗？<br />已经检测到 <strong>$a->urlcount</strong> 个文件与 $a->fromareaname 相链接。确定要复制或移动至 $a->toareaname 吗？';
$string['movingquestionsnofiles']=  '确定移动试题 \"$a->questions\"至<strong> \"$a->tocontext\"</strong>吗？<br />在 \"$a->fromareaname\"中没有任何文件链接到这些试题。';
$string['needtochoosecat'] = '移动这些试题需要选择一种类别或点击 \"取消\"。';
$string['nopermissionadd'] = '无权限在此添加试题。';
$string['nopermissionmove'] = '您没有权限从此处移动试题。必须保存此类别中的试题或将其另存为新试题。';
$string['noprobs'] = '在试题库中未发现试题。';
$string['notenoughdatatoeditaquestion'] = '试题 id、类别 id 和试题类型都没指定。';
$string['notenoughdatatomovequestions'] = '如果想移动您需要提供试题的试题 ID。';
$string['permissionedit'] = '编辑试题';
$string['permissionmove'] = '移动试题';
$string['permissionsaveasnew'] = '以新试题形式保存';
$string['permissionto'] = '有权限做：';
$string['published'] = '共享';
$string['questionaffected'] = '<a href=\"$a->qurl\">试题 \"$a->name\" ($a->qtype)</a> 在该试题类别中，但是正在其他课程的<a href=\"$a->qurl\">测验 \"$a->quizname\"</a> \"$a->coursename\" 中使用。';
$string['questionbank'] = '试题库';
$string['questioncategory'] = '试题类别';
$string['questioncatsfor'] = '$a 的试题类别';
$string['questiondoesnotexist'] = '该试题不存在';
$string['questionsmovedto'] = '使用中的试题已移动到父课程类别中的 "$a"。';
$string['questionsrescuedfrom'] = '从上下文 $a 保存的试题。';
$string['questionsrescuedfrominfo'] = '这些试题（某些可能隐藏）保存时上下文已 $a 被删除，因为某些测验或其他活动仍在使用它们。';
$string['questionuse'] = '在该活动中使用试题';
$string['shareincontext'] = '共享  $a ';
$string['tofilecategory'] = '撰写类别至文件';
$string['tofilecontext'] = '撰写上下文至文件';
$string['unknown'] = '未知';
$string['unknownquestiontype'] = '未知的试题类型： $a ';
$string['unpublished'] = '不共享';
$string['upgradeproblemcategoryloop'] = '升级试题类别时侦测到错误。类别树中存在循环。受影响类别 id 为 $a。';
$string['upgradeproblemcouldnotupdatecategory'] = '无法更新试题类别 $a->name($a->id)。';
$string['upgradeproblemunknowncategory'] = '升级试题类别时检测到问题。类别 $a->id 指向不存在的父项 $a->parent。为修复问题已更改父项。';
$string['yourfileshoulddownload'] = '导出文件即将开始下载。若没有，请<a href=\"$a\">点击此处</a>。为修复问题已更改父项。';
?>
