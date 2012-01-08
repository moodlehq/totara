<?php // $Id: enrol_ldap.php,v 1.1 2006/10/04 21:23:31 koenr Exp $ 

$string['description'] = '<p>You can use an LDAP server to control your enrollments.  
                          It is assumed your LDAP tree contains groups that map to 
                          the courses, and that each of thouse groups/courses will 
                          have membership entries to map to students.</p>
                          <p>It is assumed that courses are defined as groups in 
                          LDAP, with each group having multiple membership fields 
                          (<em>member</em> or <em>memberUid</em>) that contain a unique
                          identification of the user.</p>
                          <p>To use LDAP enrollment, your users <strong>must</strong> 
                          to have a valid  idnumber field. The LDAP groups must have 
                          that idnumber in the member fields for a user to be enrolled 
                          in the course.
                          This will usually work well if you are already using LDAP 
                          Authentication.</p>
                          <p>Enrollments will be updated when the user logs in. You
                           can also run a script to keep enrollments in synch. Look in 
                          <em>enrol/ldap/enrol_ldap_sync.php</em>.</p>
                          <p>This plugin can also be set to automatically create new 
                          courses when new groups appear in LDAP.</p>';
$string['enrol_ldap_search_sub'] = 'Search group memberships from subcontexts.';
$string['enrol_ldap_student_settings'] = 'Student enrollment settings';
$string['enrol_ldap_teacher_settings'] = 'Teacher enrollment settings';
$string['enrol_ldap_course_settings'] = 'Course enrollment settings';
$string['enrol_ldap_student_contexts'] = 'List of contexts where groups with student
                                          enrollments are located. Separate different 
                                          contexts with \';\'. For example: 
                                          \'ou=courses,o=org; ou=others,o=org\'';
$string['enrol_ldap_student_memberattribute'] = 'Member attribute, when users belongs
                                          (is enrollled) to a group. Usually \'member\'
                                          or \'memberUid\'.';
$string['enrol_ldap_teacher_contexts'] = 'List of contexts where groups with teacher
                                          enrollments are located. Separate different 
                                          contexts with \';\'. For example: 
                                          \'ou=courses,o=org; ou=others,o=org\'';
$string['enrol_ldap_autocreate'] = 'Courses can be created automatically if there are
                                    enrollments to a course  that doesn\'t yet exist 
                                    in Snap.';
                                    
?>
