<?php
/*

Totara LMS Changelog

Release 2.5.0 (24th October 2013):
==================================================

Initial release of Totara 2.5

Totara 2.5 introduces the following new features:

* Performance Management
  * Create company wide and personal goals and track progress towards
    meeting those goals.
  * Create custom appraisal forms and assign them to groups of users
  * Track appraisal progress with summary and detailed reports
  * Create 360 feedback forms and assign them to groups of users
  * Allow users to monitor 360 feedback they have received
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
    (thanks to Kineo US and Kohls for the original patch)

* Course catalog changes
  * Changes to the appearance of the course catalog to integrate recent improvements from
    Moodle.

* Manager Delegation
  * Allows a user's manager role to be temporarily delegated to another user.
  * A time limit can be set after which the temporary assignment is automatically
    revoked.
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
   "in the last 3 days"
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


This release updates Totara to be based on Moodle 2.5, which includes the following improvements:

* New admin tool for installing add-ons.
* Transparency and RGB support in the themes colour picker.
* Collapsable form sections to improve the usability of large forms.
* Reduced the size of description fields and simplified the default editor
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

See INSTALL.txt for the new system requirements for 2.5.

API Changes:

* Moodle API changes as detailed in http://docs.moodle.org/dev/Moodle_2.5_release_notes#For_developers:_API_changes
* Kiwifruit theme will no longer display totara menu bar or breadcrumbs until you are logged in.
* Unenrolling users from a course will unenrol them from any future face to face courses they were booked in.
* Code changes to the way embedded reports are set up - see comments in the reportbuilder class constructor.

*/
?>
