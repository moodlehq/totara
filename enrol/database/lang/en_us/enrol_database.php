<?php
// enrol_database.php - created with Totara langimport script version 1.1

$string['autocreate'] = 'Courses can be created automatically if there are enrollments to a course that doesn\'t yet exist in Snap.';
$string['description'] = 'You can use a external database (of nearly any kind) to control your enrollments. It is assumed your external database contains a field containing a course ID, and a field containing a user ID. These are compared against fields that you choose in the local course and user tables.';
$string['remote_fields_mapping'] = 'Enrollment (remote) database fields.';
$string['student_coursefield'] = 'The name of the field in the student enrollment table that we expect to find the course ID in.';
$string['student_r_userfield'] = 'The name of the field in the remote student enrollment table that we expect to find the user ID in.';
$string['student_table'] = 'The name of the table where student enrollments are stored.';
$string['teacher_coursefield'] = 'The name of the field in the teacher enrollment table that we expect to find the course ID in.';
$string['teacher_r_userfield'] = 'The name of the field in the remote teacher enrollment table that we expect to find the user ID in.';
$string['teacher_table'] = 'The name of the table where teacher enrollments are stored.';

?>
