<?PHP // $Id: certificate.php,v 3.1.9 2008/01/20

//General functions
$string['modulename'] = '证书';
$string['modulenameplural'] = '证书';
$string['certificatecoursename'] = '课程名称';
$string['certificatename'] = '证书名称';
$string['certificatetitle'] = '证书标题';
$string['certificate:view'] = '查看证书';
$string['certificate:manage'] = '管理证书';
$string['certificate:printteacher'] = '打印教师';
$string['certificate:student'] = '获得证书';

//Adding an instance
$string['intro'] = '简介';
$string['addlinklabel'] = '添加另一个链接的活动选项';
$string['addlinktitle'] = '点击添加另一个链接的活动选项';
$string['issueoptions'] = '问题选项';
$string['textoptions'] = '文本选项';
$string['designoptions'] = '设计选项';
$string['lockingoptions'] = '锁定选项';
$string['certificatetype'] = '证书类型';
$string['emailteachers'] = '向教师发送电子邮件';
$string['emailothers'] = '向其他人发送电子邮件';
$string['savecertificate'] = '保存证书';
$string['deliver'] = '授课';
$string['download'] = '强制下载';
$string['openbrowser'] = '在新窗口中打开';
$string['emailcertificate'] = '电子邮件（必须同时选择保存！）';
$string['border'] = '边界';
$string['borderstyle'] = '边界图片';
$string['borderlines'] = '线';
$string['bordercolor'] = '边界线';
$string['borderblack'] = '黑色';
$string['borderbrown'] = '棕色';
$string['borderblue'] = '蓝色';
$string['bordergreen'] = '绿色';
$string['printwmark'] = '水印图片';
$string['datehelp'] = '日期';
$string['dateformat'] = '日期格式';
$string['receiveddate'] = '接收日期';
$string['courseenddate'] = '课程结束日期（必须设置！）';
$string['gradedate'] = '成绩日期';
$string['printcode'] = '打印代码';
$string['printgrade'] = '打印成绩';
$string['printoutcome'] = '打印成果';
$string['nogrades'] = '无可用成绩';
$string['gradeformat'] = '成绩格式';
$string['gradepercent'] = '百分比成绩';
$string['gradepoints'] = '分数成绩';
$string['gradeletter'] = '分数段';
$string['printhours'] = '打印学时';
$string['printsignature'] = '签名图片';
$string['sigline'] = '线';
$string['printteacher'] = '打印教师姓名';
$string['customtext'] = '自定义文本';
$string['printdate'] = '打印日期';
$string['printseal'] = '印章或徽标图片';
$string['lockgrade'] = '按成绩锁定';
$string['requiredgrade'] = '必需的课程成绩';
$string['coursetime'] = '必需的课程时间';
$string['linkedactivity'] = '已链接的活动';
$string['minimumgrade'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;必需的成绩';
$string['activitylocklabel'] = '已链接的活动/最低成绩 %';
$string['coursetimedependency'] = '课程最低要求分钟';
$string['activitydependencies'] = '相关活动';

//Strings for verification block 
$string['entercode'] = '输入证书代码以便验证：';
$string['validate'] = '验证';
$string['certificate'] = '验证证书代码：';
$string['verifycertificate'] = '验证证书';
$string['notfound'] = '无法验证证书编号。';
$string['back'] = '后退';
$string['to'] = '授予';
$string['course'] = '对于';
$string['date'] = '开启';
$string['grade'] = '评分';

//Certificate view, index, report strings
$string['incompletemessage'] = '为下载您的证书，您首先必须完成所有必需的 '.' 活动。请返回课程完成您的作业。';
$string['awardedto'] = '授予';
$string['issued'] = '已发出';
$string['notissued'] = '未发出';
$string['notissuedyet'] = '尚未发出';
$string['notreceived'] = '您尚未获得此证书';
$string['getcertificate'] = '获得您的证书';
$string['report'] = '报表';
$string['code'] = '代码';
$string['viewed'] = '您获得此证书的时间是：';
$string['viewcertificateviews'] = '查看 $a 发出的证书';
$string['reviewcertificate'] = '查看您的证书';
$string['openwindow'] = '点击下方的按钮，在新浏览器窗口中打开
您的证书。';
$string['opendownload'] = '点击下方的按钮，将您的证书
保存到计算机上。';
$string['openemail'] = '点击下方的按钮，您的证书
将以电子邮件附件的方式发送给您。';
$string['receivedcerts'] = '收到的证书';
$string['errorlockgrade'] = '您目前的 $a->mod ($a->current%%) 成绩，低于获得证书所需的成绩 ($a->needed%%)。';
$string['errorlocksurvey'] = '您需要完成所有课程调查，之后才能获得证书。';
$string['errorlockgradecourse'] = '您目前的课程成绩是 ($a->current%%)，低于获得证书所需的成绩 ($a->needed%%)。';
$string['errorlocktime'] = '您必须首先满足本课程的学习时间要求，之后才能获得证书。';
$string['errorlockmod'] = '您必须首先满足全部课程活动成绩要求，之后才能获得证书。';

//Email text
$string['emailstudenttext'] = '已附上您的 $a->course 证书。';
$string['awarded'] = '已授予';
$string['emailteachermail'] = '
$a->student 已获得 \'$a->course\' 的证书：
\'$a->certificate\'。

您可以在此处查看证书：

    $a->url';
$string['emailteachermailhtml'] = '
$a->student 已获得 \'$a->course\' 的证书：
\'<i>$a->certificate</i>\'。

您可以在此处查看证书：

    <a href=\"$a->url\">证书报表</a>。';

//Names of type folders
$string['typeportrait'] = '纵向';
$string['typeletter_portrait'] = '纵向（信纸）';
$string['typelandscape'] = '横向';
$string['typeletter_landscape'] = '横向（信纸）';
$string['typeunicode_landscape'] = 'Unicode（横向）';
$string['typeunicode_portrait'] = 'Unicode（纵向）';

$string['titledefault'] = '成绩证书';

//Print to certificate strings
$string['grade'] = '成绩';
$string['coursegrade'] = '课程成绩';
$string['credithours'] = '学时';

$string['introlandscape'] = '这是为了证明';
$string['statementlandscape'] = '已完成课程';

$string['introletterlandscape'] = '这是为了证明';
$string['statementletterlandscape'] = '已完成课程';

$string['introportrait'] = '这是为了证明';
$string['statementportrait'] = '已完成课程';
$string['ondayportrait'] = '在今天';

$string['introletterportrait'] = '这是为了证明';
$string['statementletterportrait'] = '已完成课程';

//Certificate transcript strings
$string['notapplicable'] = '无';
$string['certificatesfor'] = '证书';
$string['coursename'] = '课程';
$string['viewtranscript'] = '查看证书';
$string['mycertificates'] = '我的证书';
$string['nocertificatesreceived'] = '尚未获得任何课程证书。';
$string['notissued'] = '未获得';
$string['reportcertificate'] = '报表证书';
$string['certificatereport'] = '证书报表';
$string['printerfriendly'] = '可打印页面';

//Custom strings
$string['field1'] = '机构';
$string['field2'] = '我是';
$string['field3'] = '我接受的培训是';

?>
