<?php
// mnet.php - created with Totara langimport script version 1.1

$string['authfail_nosessionexists'] = 'Authorization failed: the mnet session does not exist.';
$string['authfail_sessiontimedout'] = 'Authorization failed: the mnet session has timed out.';
$string['authfail_usermismatch'] = 'Authorization failed: the user does not match.';
$string['editenrolments'] = 'enroll';
$string['enrolcourseenrol_desc'] = 'Enroll/unenroll users from this course using Moodle Network enrollments.
Note that users may have been enrolled in this course via other enrollment
methods if the remote hosts allows them. Such enrollments are listed under
<em>Other enrolled users</em>';
$string['enrolcourses_desc'] = 'Courses offered for remote enrollment by this host.';
$string['enrolments'] = 'enrollments';
$string['mnetenrol'] = 'Enrollments';
$string['remoteenrolhosts_desc'] = 'Enroll and unenroll users from your Moodle installation
on Moodle Hosts that allow you to do so via the Moodle
Network enrollment plugin.';
$string['trustedhostsexplain'] = '<p>The trusted hosts mechanism allows specific machines to execute calls via XML-RPC to any part of the Moodle API. This is available for scripts to control Moodle behavior and can be a very dangerous option to enable. If in doubt, keep it off.</p> <p><strong>This is not needed for any standard MNet feature!</strong> Turn it on only if you know what you are doing.</p> <p>To enable it, enter a list of IP addresses or networks, one on each line. Some examples:</p> Your local host:<br />127.0.0.1<br />Your local host (with a network block):<br />127.0.0.1/32<br />Only the host with IP address 192.168.0.7:<br />192.168.0.7/32<br />Any host with an IP address between 192.168.0.1 and 192.168.0.255:<br />192.168.0.0/24<br />Any host whatsoever:<br />192.168.0.0/0<br />Obviously the last example is <strong>not</strong> a recommended configuration.';

?>
