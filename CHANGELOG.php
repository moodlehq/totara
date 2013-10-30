<?php
/*

Totara LMS Changelog

Release 2.5.0 (31st October 2013):
==================================================

Initial release of Totara 2.5

Totara 2.5 introduces the following new features:

* Performance Management
  * Create company wide and personal goals and track progress towards
    meeting those goals.
  * Create custom appraisal forms and assign them to groups of users.
  * Track appraisal progress with summary and detailed reports.
  * Create 360 feedback forms and assign them to groups of users.
  * Allow users to monitor 360 feedback they have received.
    (thanks to GKN and BMI for part funding this work)

* Certifications
  * Ability to create "Certifications", which are Programs that can expire
    after a set time and can be retaken.
  * Manage expiration periods and recertification windows.
  * Supports recertification paths when recertification involves completion
    of a different set of courses to the original certification path.
  * Ability to reset certain activities within courses to support the same
     user taking a course multiple times.
  * A course completion history report which shows previous completion attempts.
  * Course completion import tool for uploading legacy completion data.
    (thanks to BMI for funding this work)

* Audience Visibility
  * Provides an alternative way of managing course and program visibility across
    the whole site.
  * Allows courses and programs to be made visible and accessible to specific
    audiences only.
    (thanks to Kineo US and Kohls for the original patch and Learning Pool for help
    with integration)

* Course catalog changes
  * Changes to the appearance of the course catalog to integrate recent improvements from
    Moodle.

* Manager Delegation
  * Allows a user's manager role to be temporarily delegated to another user.
  * A time limit determines when the temporary assignment is automatically revoked.
    (thanks to Catalyst IT for the original patch)

* Program Progress report source
  * View program completion status and the course completion status of each individual
    course that makes up the program in a single integrated report.
    (thanks to Catalyst IT and Bodo Hoenen from Social Learning Project for the original patch)

* Report builder PDF export
  * All report builder reports now include the option to export to PDF in either
    portrait or landscape mode.
    (thanks to Michael Gwynne from Kineo UK for the original patch)

* Customisable report builder filter names
  * Report creators can customise the names of filters which controls the label
    that appears next to the filter on the report page.

* Relative date support in report builder date filters
  * Report builder date filters now allow relative date ranges such as
   "in the last 3 days".
    (thanks to Jamie Kramer from E-learning Experts for the original patch)

* Instant course and program completion
  * Instead of waiting for the hourly or daily cron, course and program completions
    are now calculated instantly.

* Email notification settings in Totara Sync
  * Administrators can receive emails when there are warnings or errors during
    syncing.

* Experimental Responsive Totara theme for mobile devices
  * A new Totara theme based of the 'bootstrap' base theme designed to scale the
    site to work on any device size.
    This theme is still experimental at this stage, we plan to improve it via 2.5
    point releases and fully support it in Totara 2.6.

* New option to mark face-to-face activity completion based on signup status rather
  than grade. Note: This option also uses the session time as the completion date for
  course and activity completion (rather than the time attendance is marked).

* More minor improvements including:
  * T-11182 New capabilities for managing hierarchy scales.
  * T-11493 New capability for managing write access to idnumber field.
  * T-10930 More fine-grained control over create/update/delete actions within Totara sync.
  * T-11049 Make all program messages optional.
  * T-9833  Improved styling of program management pages.
  * T-11387 Added new web service to store mobile device data for push notifications.

This release updates Totara to be based on Moodle 2.5, which includes the following improvements:

* New admin tool for installing add-ons.
* Transparency and RGB support in the themes colour picker.
* Collapsable form sections to improve the usability of large forms.
* Reduced the size of description fields and simplified the default editor.
* Search the list of users enrolled in a course.
* New assignment settings for handling resubmissions.
* Option to auto-save during quiz attempts.
* Option to drag and drop media files or text onto a course page to create a label.
* Option to display course summary files in course listings.
* View and edit catalog now separated.
* Performance improvements, particularly greater use of the Moodle Universal Cache (MUC).
* Improved security of hashed passwords (Totara contribution to Moodle).
* New user account lockout mechanism.
* Behat test framework integration.
* Progress indicator when dragging files into the filepicker.

For more details on the Moodle changes see:

http://docs.moodle.org/dev/Moodle_2.5_release_notes
http://docs.moodle.org/dev/Moodle_2.5.1_release_notes
http://docs.moodle.org/dev/Moodle_2.5.2_release_notes

See INSTALL.txt for the new system requirements for 2.5.


2.5 Upgrade notes:
==================

2.5 introduces a new, more secure password hashing scheme. If you are upgrading from 2.4 via the web interface ensure
you are logged into you 2.4 site as a site administrator prior to replacing the codebase.

As always make sure you replace the whole code directory rather than copying 2.5 files on top of the 2.4 code. See
UPGRADE.txt for more details.


2.5 API Changes:
================

* Moodle API changes as detailed in http://docs.moodle.org/dev/Moodle_2.5_release_notes#For_developers:_API_changes
* T-11133 Kiwifruit theme will no longer display totara menu bar or breadcrumbs until you are logged in.
* T-11202 Unenrolling users from a course will unenrol them from any future face to face courses they were booked in.
* T-11258 Code changes to the way embedded reports are set up - see comments in the reportbuilder class constructor.
* T-9833  Changes to code to support improved styling of program management. Custom themes may need updating.
* T-11493 Enforcing uniqueness on most 'idnumber' fields (All totara ones plus the user idnumber from Moodle). You
*         will not be able to upgrade to 2.5.0 if you have any duplicates in existing sites.
* T-10878 Removed a number of unused database fields and tables.
*         Removed unused functions organisation_backup() and related functions.
*         Remove unused $exceptiondata argument from insert_exception() and raise_exception() functions.
* T-11182 Added new hierarchy scale capabilities and reworked existing hierarchy capability checks to make them more
*         independent of each other.
* T-10107 New optional arguments in totara_cohort_add_association(), totara_cohort_delete_association() and
*         totara_cohort_get_associations() to support audience visibility.
*         Updated totara_cohort_check_and_update_dynamic_cohort_members() to use progress_trace object instead of
*         boolean verbose flag.
*         Removed unused function totara_print_main_subcategories().
* T-9833  Added optional $fieldset argument to totara_add_icon_picker() to allow icon picker without separate fieldset.
* T-9390  New optional arguments on totara_get_manager() to support more options related to temp managers.
* T-11158 Changed 2nd argument of totara_get_category_item_count() from bool to string to support certifications.
*         Added $certifpath argument to get_total_time_allowance() and get_courseset_groups().
*         Added optional $iscertif and $certifpath arguments to get_content_form_template().
*         Added optional $certifpath argument to course_set and multi_course_set class constructors.
*         New $certificationpath argument to display_edit_assignment_form().
*         Renamed incorrectly named $userpic argument to $user in display_user_message_box().
* T-11182 Add 2 new permission related arguments to customfield_edit_icons().
*         Removed unused 2nd argument from competency_scale_display_table().
* T-11309 Added $type argument to prog_get_programs().
*         Added $type argument and removed two $where arguments from prog_get_programs_search().
* T-11102 Removed unused functions prog_print_programs(), prog_print_program(), prog_print_whole_category_list(),
*         prog_print_category_info(), prog_print_viewtype_selector() and print_program().
* T-11279 get_competency_courses() function visibility changed from private to public.
* T-11049 Add $newprogram boolean argument to prog_messages_manager class constructor.
*
*/
?>
