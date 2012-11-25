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
 * Strings for component 'mnet', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['RPC_HTTPS_SELF_SIGNED'] = 'HTTPS (self-signed)';
$string['RPC_HTTPS_VERIFIED'] = 'HTTPS (signed)';
$string['RPC_HTTP_PLAINTEXT'] = 'HTTP unencrypted';
$string['RPC_HTTP_SELF_SIGNED'] = 'HTTP (self-signed)';
$string['RPC_HTTP_VERIFIED'] = 'HTTP (signed)';
$string['aboutyourhost'] = 'เกี่ยวกับเซิร์ฟเวอร์ของคุณ';
$string['accesslevel'] = 'ระดับการเข้าถึง';
$string['addhost'] = 'เพิ่มโฮสต์';
$string['addnewhost'] = 'เพิ่มพื้นที่ใหม่';
$string['addtoacl'] = 'เพิ่มไปยังการควบคุมการเข้าถึง';
$string['allhosts_no_options'] = 'ตัวเลือกขณะนี้ยังไม่มีเมื่อดูหลายครอบครัว';
$string['allow'] = 'ให้';
$string['authfail_nosessionexists'] = 'อนุมัติล้มเหลว: เซสชั่น Mnet ไม่อยู่';
$string['authfail_sessiontimedout'] = 'อนุมัติล้มเหลว: เซสชั่น Mnet ได้หมดเวลา';
$string['authfail_usermismatch'] = 'อนุมัติล้มเหลว: ผู้ใช้ไม่ตรงกับ';
$string['authmnetdisabled'] = 'ระบบเครือข่าย Moodle <em> รับรองความถูกต้องปลั๊กอิน </div> ถูกปิดการใช้งาน <strong> </strong>';
$string['badcert'] = 'นี้ไม่ได้ใบรับรองที่ถูกต้อง';
$string['couldnotgetcert'] = 'ใบรับรองที่ <br /> {$a} ไม่มี <br /> โฮสต์อาจจะลงหรือการกำหนดค่าไม่ถูกต้อง';
$string['couldnotmatchcert'] = 'นี้ไม่ตรงกับใบรับรองที่เผยแพร่ในขณะนี้โดยเว็บเซิร์ฟเวอร์';
$string['courses'] = 'หลักสูตร';
$string['courseson'] = 'หลักสูตรเกี่ยวกับ';
$string['current_transport'] = 'การขนส่งปัจจุบัน';
$string['currentkey'] = 'คีย์สาธารณะปัจจุบัน';
$string['databaseerror'] = 'ไม่สามารถเขียนรายละเอียดไปยังฐานข้อมูล';
$string['deleteaserver'] = 'ลบเซิร์ฟเวอร์';
$string['deletehost'] = 'ลบโฮสต์';
$string['deletekeycheck'] = 'คุณจะแน่ใจจริงๆว่าคุณต้องการลบคีย์นี้?';
$string['deleteoutoftime'] = 'หน้าต่าง 60-สองของคุณสำหรับการลบคีย์นี้ได้หมดอายุแล้ว กรุณาเริ่มต้นอีกครั้ง';
$string['deleteuserrecord'] = 'ACL SSO: ลบระเบียนสำหรับผู้ใช้ \'{$a->user}\' จาก {$a->host}';
$string['deletewrongkeyvalue'] = 'เกิดข้อผิดพลาด หากคุณไม่ได้พยายามที่จะลบคีย์ SSL ของเซิร์ฟเวอร์ของคุณก็เป็นไปได้ที่คุณได้รับเรื่องของการโจมตีที่เป็นอันตราย การกระทำไม่มีการได้รับการถ่าย';
$string['deny'] = 'ปฏิเสธ';
$string['description'] = 'คำอธิบาย';
$string['duplicate_usernames'] = 'เราล้มเหลวในการสร้างดัชนีในคอลัมน์ "mnethostid" และ "ชื่อ" ในตารางผู้ใช้ของคุณ. <br /> นี้อาจเกิดขึ้นเมื่อคุณมี <a href="{$a}" target="_blank"> ชื่อที่ซ้ำกันในผู้ใช้ของคุณ ตาราง </a> <br. /> อัพเกรดของคุณยังควรดำเนินการเสร็จเรียบร้อยแล้ว คลิกที่ลิงค์ข้างต้นและคำแนะนำเกี่ยวกับการแก้ไขปัญหาที่เกิดขึ้นนี้จะปรากฏในหน้าต่างใหม่ คุณสามารถเข้าร่วมเพื่อที่ในตอนท้ายของการปรับรุ่น. <br />';
$string['enabled_for_all'] = '(บริการนี้ได้รับการเปิดใช้งานสำหรับครอบครัวทั้งหมด)';
$string['enterausername'] = 'กรุณาใส่ชื่อผู้ใช้หรือรายการชื่อผู้ใช้ที่คั่นด้วยเครื่องหมายจุลภาค';
$string['error7020'] = 'ข้อผิดพลาดนี้ตามปกติจะเกิดขึ้นหากยังไซต์ระยะไกลได้สร้างระเบียนสำหรับคุณด้วย wwwroot ผิดเช่น http://yoursite.com แทน http://www.yoursite.com คุณควรติดต่อผู้ดูแลระบบของไซต์ระยะไกลที่มี wwwroot ของคุณ (ตามที่ระบุไว้ใน config.php) ขอให้เธอเพื่อปรับปรุงการบันทึกของเธอสำหรับโฮสต์ของคุณ';
$string['error7022'] = 'ข้อความที่คุณส่งไปยังไซต์ระยะไกลถูกเข้ารหัสอย่างถูกต้อง แต่ไม่ได้ลงชื่อ นี่คือที่ไม่คาดคิดที่ดี; คุณอาจจะยื่นข้อบกพร่องว่านี้เกิดขึ้น (ให้ข้อมูลเท่าที่เป็นไปได้เกี่ยวกับรุ่น Moodle ในคำถามอื่น ๆ';
$string['error7023'] = 'ไซต์ระยะไกลได้พยายามที่จะถอดรหัสข้อความของคุณกับคีย์ทั้งหมด แต่ก็มีในบันทึกสำหรับเว็บไซต์ของคุณ พวกเขาได้ล้มเหลวทั้งหมด คุณอาจจะสามารถที่จะแก้ไขปัญหานี้ด้วยตนเองอีก keying กับไซต์ระยะไกล นี้ไม่น่าจะเกิดขึ้นได้ถ้าคุณไม่เคยออกจากการสื่อสารกับไซต์ระยะไกลในไม่กี่เดือน';
$string['error7024'] = 'คุณส่งข้อความเข้ารหัสไปยังไซต์ระยะไกล แต่ยังไซต์ระยะไกลจะไม่รับการสื่อสาร unencrypted จากเว็บไซต์ของคุณ นี่คือที่ไม่คาดคิดที่ดี; คุณอาจจะยื่นข้อบกพร่องว่านี้เกิดขึ้น (ให้ข้อมูลเท่าที่เป็นไปได้เกี่ยวกับรุ่น Moodle ในคำถามอื่น ๆ';
$string['error7026'] = 'ที่สำคัญว่าข้อความของคุณได้ลงนามกับความแตกต่างจากคีย์ที่รีโมทโฮสต์ที่มีในไฟล์สำหรับเซิร์ฟเวอร์ของคุณ นอกจากพื้นที่ห่างไกลความพยายามที่จะเรียกคีย์ปัจจุบันของคุณและล้มเหลวที่จะทำเช่นนั้น กรุณาตนเองอีกครั้งสำคัญกับพื้นที่ห่างไกลและลองอีกครั้ง';
$string['error709'] = 'ไซต์ระยะไกลล้มเหลวในการขอรับกุญแจ SSL จากคุณ';
$string['expired'] = 'คีย์นี้ได้สิ้นสุดลงเมื่อ';
$string['expires'] = 'มีผลจนถึง';
$string['expireyourkey'] = 'ลบคีย์นี้';
$string['expireyourkeyexplain'] = 'Moodle โดยอัตโนมัติหมุนกุญแจของคุณทุก 28 วัน (โดยปริยาย) แต่คุณมีตัวเลือกในการ <em> ด้วยตนเอง </div> หมดอายุคีย์นี้ได้ตลอดเวลา นี้จะเป็นประโยชน์ถ้าคุณเชื่อว่าคีย์นี้ได้รับการโจมตี ทดแทนจะได้รับการสร้างขึ้นโดยอัตโนมัติทันที. <br /> การลบคีย์นี้จะทำให้ไปไม่ได้สำหรับ Moodles อื่น ๆ ที่จะสื่อสารกับคุณจนกว่าคุณด้วยตนเองติดต่อผู้ดูแลและให้พวกเขามีคีย์ใหม่ของคุณ';
$string['failedaclwrite'] = 'ล้มเหลวในการเขียนเพื่อการเข้าถึง MNET รายการควบคุมสำหรับผู้ใช้ \'{$a}\'';
$string['findlogin'] = 'ค้นหาเข้าสู่ระบบ';
$string['forbidden-function'] = 'ที่ทำงานไม่ได้รับการเปิดใช้งานสำหรับ RPC';
$string['forbidden-transport'] = 'วิธีการขนส่งที่คุณกำลังพยายามที่จะใช้ไม่ได้รับอนุญาต';
$string['forcesavechanges'] = 'บังคับให้บันทึกการเปลี่ยนแปลง';
$string['helpnetworksettings'] = 'การกำหนดค่าการสื่อสารระหว่าง Moodle';
$string['hidelocal'] = 'ซ่อนผู้ใช้ในท้องถิ่น';
$string['hideremote'] = 'ซ่อนผู้ใช้ระยะไกล';
$string['host'] = 'โฮส';
$string['hostcoursenotfound'] = 'hostหรือหลักสูตรไม่พบ';
$string['hostdeleted'] = 'โฮสถูกลบแล้ว';
$string['hostexists'] = 'ระเบียนที่มีอยู่แล้วสำหรับโฮสต์ที่และการใช้งาน Moodle ที่มี ID คลิก /> <br {$a}. เมื่อ <em> ดำเนินต่อไป </div> เพื่อแก้ไขระเบียนที่';
$string['hostname'] = 'ชื่อโฮสต์';
$string['hostnamehelp'] = 'ชื่อโดเมนได้อย่างเต็มที่ผ่านการรับรองจากพื้นที่ห่างไกลเช่น www.example.com';
$string['hostnotconfiguredforsso'] = 'Hub Moodle ระยะไกลนี้ไม่ได้กำหนดค่าสำหรับการเข้าสู่ระยะไกล';
$string['hostsettings'] = 'การตั้งค่าโฮสต์';
$string['http_self_signed_help'] = 'อนุญาตการเชื่อมต่อโดยใช้ลงนามด้วยตนเองรับรอง DIY SSL บนพื้นที่ห่างไกล';
$string['http_verified_help'] = 'อนุญาตการเชื่อมต่อโดยใช้หนังสือรับรองการตรวจสอบ SSL ใน PHP ในพื้นที่ห่างไกล แต่กว่า http (ไม่ HTTPS)';
$string['https_self_signed_help'] = 'อนุญาตการเชื่อมต่อโดยใช้ลงนามด้วยตนเอง DIY SSL ใน PHP ในพื้นที่ห่างไกลผ่าน HTTP';
$string['https_verified_help'] = 'อนุญาตการเชื่อมต่อโดยใช้หนังสือรับรองการตรวจสอบ SSL ในพื้นที่ห่างไกล';
$string['id'] = 'ID';
$string['idhelp'] = 'ค่านี้จะถูกกำหนดโดยอัตโนมัติและไม่สามารถเปลี่ยนแปลงได้';
$string['invalidaccessparam'] = 'ดัชนีชี้วัดการเข้าถึงที่ไม่ถูกต้อง';
$string['invalidactionparam'] = 'ดัชนีี้วัดการกระทำที่ไม่ถูกต้อง';
$string['invalidhost'] = 'คุณจะต้องให้ระบุโฮสต์ที่ถูกต้อง';
$string['invalidpubkey'] = 'ที่สำคัญไม่ได้เป็นคีย์ SSL ที่ถูกต้อง';
$string['invalidurl'] = 'พารามิเตอร์ URL ไม่ถูกต้อง';
$string['ipaddress'] = 'ที่อยู่ IP';
$string['is_in_range'] = '<code> ที่อยู่ IP ที่ {$a} </code> หมายถึงโฮสต์คนที่ถูกต้อง';
$string['ispublished'] = 'Moodle {$a} ได้เปิดใช้งานบริการนี้สำหรับคุณ';
$string['issubscribed'] = 'Moodle {$a} จะสมัครใช้บริการนี้บนโฮสต์ของคุณ';
$string['keydeleted'] = 'ที่สำคัญของคุณถูกลบประสบความสำเร็จและถูกแทนที่';
$string['keymismatch'] = 'กุญแจสาธารณะที่คุณจะถือสำหรับโฮสต์นี้จะแตกต่างจากคีย์สาธารณะมันอยู่ในขณะนี้สำนักพิมพ์';
$string['last_connect_time'] = 'เวลาเชื่อมต่อครั้ง';
$string['last_connect_time_help'] = 'ทุกครั้งที่คุณเชื่อมต่อล่าสุดที่จะเป็นเจ้าภาพนี้';
$string['last_transport_help'] = 'การขนส่งที่คุณใช้สำหรับการเชื่อมต่อล่าสุดที่จะเป็นเจ้าภาพนี้';
$string['loginlinkmnetuser'] = '<br /> ถ้าคุณเป็น Moodle เครือข่ายผู้ใช้ระยะไกลและ href="{$a}"> <a สามารถยืนยันที่อยู่อีเมลของคุณที่นี่ </a> คุณสามารถเปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบของคุณ. <br />';
$string['logs'] = 'logs';
$string['mnet'] = 'ระบบเครือข่าย Moodle';
$string['mnet_concatenate_strings'] = 'CONCATENATE (ถึง) 3 สายและส่งผล';
$string['mnet_session_prohibited'] = 'ผู้ใช้งานจากเซิร์ฟเวอร์ที่บ้านของคุณไม่ได้รับอนุญาตขณะที่จะเดินเตร่ไป {$a}';
$string['mnetdisabled'] = 'Moodle Network is <strong>disabled</strong>.';
$string['mnetidprovider'] = 'ผู้ให้บริการ MNET ID';
$string['mnetidproviderdesc'] = 'คุณสามารถใช้สถานที่นี้เพื่อดึงเชื่อมโยงที่คุณสามารถเข้าสู่ระบบที่ถ้าคุณสามารถให้ที่อยู่อีเมลที่ถูกต้องเพื่อให้ตรงกับชื่อผู้ใช้ก่อนหน้านี้คุณพยายามที่จะเข้าสู่ระบบด้วย';
$string['mnetidprovidermsg'] = 'คุณควรจะสามารถเข้าสู่ระบบที่ {$a} ให้บริการของคุณ';
$string['mnetidprovidernotfound'] = 'ขออภัยที่ไม่มีข้อมูลเพิ่มเติมได้ที่อาจจะพบ';
$string['mnetlog'] = 'บันทึกการใช้งาน';
$string['mnetpeers'] = 'เครื่องลูกข่าย';
$string['mnetservices'] = 'บริการ';
$string['mnetsettings'] = 'การตั้งค่าระบบเครือข่ายของ Moodle';
$string['moodle_home_help'] = 'เส้นทางไปที่หน้าแรกของ Moodle ในพื้นที่ห่างไกลเช่น / Moodle /';
$string['net'] = 'ระบบเครือข่าย';
$string['networksettings'] = 'การตั้งค่าเครือข่าย';
$string['never'] = 'ไม่เคย';
$string['noaclentries'] = 'รายการนี้ไม่มีอยู่ในรายการควบคุมการเข้าถึง SSO';
$string['nocurl'] = 'PHP ม้วนห้องสมุดไม่ได้ติดตั้ง';
$string['nolocaluser'] = 'ไม่มีการบันทึกในท้องถิ่นที่มีอยู่สำหรับผู้ใช้ระยะไกล';
$string['nomodifyacl'] = 'คุณยังไม่ได้รับอนุญาตให้ปรับเปลี่ยน MNET เข้าถึงรายการควบคุม';
$string['nonmatchingcert'] = 'เรื่องของใบรับรอง: <br /> <em> {$a->subject} </em> <br /> ไม่ตรงกับโฮสต์มันมาจาก: <br /> <em> {$a->host} </em >';
$string['nopubkey'] = 'มีปัญหาในการเรียกคีย์สาธารณะ. <br /> บางทีเจ้าภาพไม่อนุญาตให้เครือข่าย Moodle หรือคีย์ไม่ถูกต้อง';
$string['nosite'] = 'ไม่พบหลักสูตรระดับไซต์';
$string['nosuchfile'] = 'ไฟล์ / ฟังก์ชั่น {$a} ไม่อยู่';
$string['nosuchfunction'] = 'ไม่สามารถระบุตำแหน่งการทำงานของฟังก์ชั่นหรือต้องห้ามสำหรับ RPC';
$string['nosuchmodule'] = 'ฟังก์ชั่นที่ถูกอย่างไม่ถูกต้องและไม่สามารถอยู่ กรุณาใช้\nรูปแบบ mod modulename / lib / / ฟังก์ชั่น';
$string['nosuchpublickey'] = 'ไม่สามารถที่จะได้รับกุญแจสาธารณะสำหรับตรวจสอบลายเซ็น';
$string['nosuchservice'] = 'บริการ RPC ไม่ได้ทำงานอยู่บนโฮสต์นี้';
$string['nosuchtransport'] = 'การขนส่งที่มี ID อยู่ที่ไม่มี';
$string['notBASE64'] = 'สายนี้ไม่ได้อยู่ในรูปแบบที่เข้ารหัส Base64 มันไม่สามารถเป็นคีย์ที่ถูกต้อง';
$string['notPEM'] = 'คีย์นี้ไม่ได้อยู่ในรูปแบบ PEM มันจะไม่ทำงาน';
$string['not_in_range'] = '<code> ที่อยู่ IP ที่ {$a} </code> ไม่ได้เป็นตัวแทนของโฮสต์คนที่ถูกต้อง';
$string['notpermittedtojump'] = 'คุณไม่ได้รับสิทธิ์ที่จะเริ่มต้นเซสชันระยะไกลจากนี้ฮับ Moodle';
$string['notpermittedtojumpas'] = 'คุณไม่สามารถเริ่มต้นเซสชันระยะไกลในขณะที่คุณถูกบันทึกไว้ในฐานะผู้ใช้อื่น';
$string['notpermittedtoland'] = 'คุณไม่ได้รับอนุญาตให้เริ่มเซสชั่นจากระยะไกล';
$string['off'] = 'ปิด';
$string['on'] = 'เปิด';
$string['permittedtransports'] = 'การขนส่งที่อนุมัติ';
$string['phperror'] = 'ข้อผิดพลาดภายใน PHP ป้องกันไม่ให้เกิดการร้องขอของคุณจะถูกเติมเต็ม';
$string['postrequired'] = 'ฟังก์ชั่นลบต้องใช้คำขอ POST';
$string['promiscuous'] = 'สำส่อน';
$string['publickey'] = 'คีย์สาธารณะ';
$string['publickey_help'] = 'คีย์สาธารณะจะได้รับโดยอัตโนมัติจากเซิร์ฟเวอร์ระยะไกล';
$string['publish'] = 'สาธารณะ';
$string['reallydeleteserver'] = 'คีย์สาธารณะจะได้รับโดยอัตโนมัติจากเซิร์ฟเวอร์ระยะไกล';
$string['receivedwarnings'] = 'คำเตือนต่อไปนี้ได้รับ';
$string['recordnoexists'] = 'บันทึกไม่ได้อยู่';
$string['reenableserver'] = 'ตัวเลข - เลือกตัวเลือกเพื่อเปิดใช้งานเซิร์ฟเวอร์นี้';
$string['registerallhosts'] = 'สมัครสมาชิกครอบครัวทั้งหมด (<em> โหมด Hub </em>)';
$string['registerallhostsexplain'] = 'คุณสามารถเลือกที่จะลงทะเบียนโฮสต์ทั้งหมดที่พยายามเชื่อมต่อให้คุณโดยอัตโนมัติ\nซึ่งหมายความว่าบันทึกจะปรากฏในรายการครอบครัวของคุณสำหรับเว็บไซต์ Moodle ใด ๆ ที่เชื่อมต่อกับคุณและขอคีย์สาธารณะของคุณ. <br /> คุณมีตัวเลือกด้านล่างนี้เพื่อกำหนดค่าบริการสำหรับ \'ทุกครอบครัว\' และโดยการเปิดใช้บริการบางอย่างมีคุณ สามารถที่จะให้บริการไปยังเซิร์ฟเวอร์ Moodle ใดกราด';
$string['remotecourses'] = 'หลักสูตรระยะไกล';
$string['remotehost'] = 'Hub ระยะไกล';
$string['remotehosts'] = 'โฮสต์ระยะไกล';
$string['requiresopenssl'] = 'ระบบเครือข่ายจำเป็นต้องมีการขยาย OpenSSL';
$string['restore'] = 'ฟื้นฟู';
$string['reviewhostdetails'] = 'ตรวจทานรายละเอียดของโฮสต์';
$string['reviewhostservices'] = 'จากบริการโฮสต์';
$string['selectaccesslevel'] = 'โปรดเลือกระดับการเข้าถึงข้อมูลจากรายการ';
$string['selectahost'] = 'กรุณาเลือกโฮสต์ Moodle ระยะไกล';
$string['serviceswepublish'] = 'บริการที่เราเผยแพร่ไปยัง {$a}';
$string['serviceswesubscribeto'] = 'บริการเกี่ยวกับ {$a} ที่เราสมัครเป็นสมาชิก';
$string['settings'] = 'การตั้งค่า';
$string['showlocal'] = 'แสดงผู้ใช้ในประเทศ';
$string['showremote'] = 'แสดงผู้ใช้ระยะไกล';
$string['ssl_acl_allow'] = 'SSO ACL: Allow user {$a->user} from {$a->host}';
$string['ssl_acl_deny'] = 'SSO ACL: Deny user {$a->user} from {$a->host}';
$string['ssoaccesscontrol'] = 'การควบคุมการเข้าถึง SSO';
$string['ssoacldescr'] = 'ใช้เพจนี้เพื่อให้ / ปฏิเสธการเข้าถึงผู้ใช้ที่เฉพาะเจาะจงจากครอบครัวเครือข่าย Moodle ระยะไกล นี่คือการทำงานเมื่อคุณจะนำเสนอบริการ SSO ผู้ใช้ระยะไกล หากต้องการควบคุม <em> ท้องถิ่นของคุณ </em> ความสามารถของผู้ใช้ที่จะเดินเตร่ไปยังโฮสต์เครือข่าย Moodle อื่น ๆ ที่ใช้ระบบบทบาทที่จะกำหนดให้พวกเขา <em> mnetlogintoremote </div> ขีดความสามารถ';
$string['ssoaclneeds'] = 'สำหรับฟังก์ชั่นนี้ในการทำงานคุณจะต้องมีระบบเครือข่าย Moodle เกี่ยวบวกปลั๊กอิน Moodle การตรวจสอบเครือข่ายที่เปิดใช้งานกับผู้ใช้รถยนต์ที่เพิ่มเปิดการใช้งาน';
$string['strict'] = 'เข้มงวด';
$string['subscribe'] = 'สมัครสมาชิก';
$string['system'] = 'ระบบ';
$string['testtrustedhosts'] = 'ทดสอบที่อยู่';
$string['testtrustedhostsexplain'] = 'ป้อนที่อยู่ IP เพื่อดูว่ามันเป็นโฮสต์คน';
$string['transport_help'] = 'ตัวเลือกเหล่านี้ซึ่งกันและกันดังนั้นคุณจะสามารถบังคับให้พื้นที่ห่างไกลที่จะใช้ลงนามในใบรับรอง SSL หากเซิร์ฟเวอร์ของคุณยังมีใบรับรอง SSL ลงนาม';
$string['trustedhosts'] = 'โฮสต์ XML-RPC';
$string['trustedhostsexplain'] = '<p> กลไกครอบครัวคนช่วยให้เครื่องที่เฉพาะเจาะจงเพื่อ\nดำเนินการโทรผ่านทาง XML-RPC เพื่อเป็นส่วนหนึ่งของ Moodle API ใด ๆ นี้\nสามารถใช้ได้สำหรับสคริปต์ในการควบคุมพฤติกรรม Moodle และสามารถ\nเป็นตัวเลือกที่อันตรายมากที่จะเปิดใช้งาน ถ้าสงสัยให้มันปิด. </p>\n<p> นี้เป็น <strong> ไม่ </strong> ที่จำเป็นสำหรับระบบเครือข่าย Moodle. </p>\n<p> ต้องการเปิดใช้งานมันให้ใส่รายการของที่อยู่ IP หรือเครือข่าย,\nหนึ่งในแต่ละบรรทัด\nตัวอย่างบางส่วน: </p> โฮสต์ท้องถิ่นของคุณ: 127.0.0.1 <br /> <br /> พื้นที่ท้องถิ่นของคุณ (ที่มีบล็อกของเครือข่าย): <br /> IP 127.0.0.1/32 <br /> เฉพาะโฮสต์ด้วย 192.168.0.7 ที่อยู่: <br /> <br /> 192.168.0.7/32 โฮสต์ใด ๆ ที่มีที่อยู่ IP ระหว่าง 192.168.0.1 และ 192.168.0.255: <br /> <br /> 192.168.0.0/24 โฮสต์ใด ๆ : <br /> 192.168.0.0 / 0 <br /> แน่นอนตัวอย่างล่าสุดคือ <strong> ไม่ </strong> กำหนดค่าที่แนะนำ';
$string['unknownerror'] = 'ข้อผิดพลาดที่ไม่รู้จักเกิดขึ้นในระหว่างการเจรจาต่อรอง';
$string['usercannotchangepassword'] = 'คุณไม่สามารถเปลี่ยนรหัสผ่านของคุณที่นี่ตั้งแต่คุณเป็นผู้ใช้ระยะไกล';
$string['userchangepasswordlink'] = '<br /> คุณอาจจะสามารถเปลี่ยนรหัสผ่านของคุณที่ <a href="{$a->wwwroot}/login/change_password.php"> {$a->description}</a> ผู้ให้บริการ';
$string['usersareonline'] = 'คำเตือน: {$a} ผู้ใช้จากเซิร์ฟเวอร์ที่กำลังล็อกอินไปยังเว็บไซต์ของคุณ';
$string['validated_by'] = 'มันจะตรวจสอบโดยเครือข่าย: <code> {$a} </code>';
$string['verifysignature-error'] = 'ตรวจสอบลายเซ็นล้มเหลว เกิดข้อผิดพลาด';
$string['verifysignature-invalid'] = 'ตรวจสอบลายเซ็นล้มเหลว ปรากฏว่าน้ำหนักบรรทุกที่นี้ไม่ได้ลงนามโดยคุณ';
$string['version'] = 'รุ่น';
$string['warning'] = 'คำเตือน';
$string['wrong-ip'] = 'ที่อยู่ IP ของคุณไม่ตรงกับที่อยู่ที่เรามีในบันทึก';
$string['xmlrpc-missing'] = 'คุณต้องมี XML-RPC ที่ติดตั้งใน PHP ของคุณสร้างเพื่อให้สามารถใช้คุณลักษณะนี้';
$string['yourhost'] = 'โฮสต์ของคุณ';
$string['yourpeers'] = 'เพื่อนของคุณ';
