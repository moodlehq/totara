<?php
/*

Totara LMS Changelog

Release 2.4.5 (10th July 2013):
==================================================

Security fixes:
    Fixes from MoodleHQ http://docs.moodle.org/dev/Moodle_2.4.5_release_notes

New features:
    T-10392    Allow user to choose Totara Sync delimiter

Improvements:
    T-10724    Added backup and restore for course badges
    T-10854    Added extra checks for when user position is not set
    T-10816    Improved error reporting in Totara Sync
    T-10862    Display more information on Facetoface session timezone on course page

Database Upgrades:
    T-10784    Changed session cost fields to free text in Facetoface

Bug Fixes:
    T-10858    Display badge navigation to users with awardbadge capability
    T-10430    Make discount field optional in Facetoface signup
    T-10857    Fixed javascript error when editing course settings
    T-10615    Fixed error when selecting template 'not required' in new notification form in Facetoface
    T-10518    Fixed misc Learning Plans styles
    T-10853    Fixed MSSQL custom fields rules issues in Dynamic Audiences
    T-10860    Re-add Program links in alert blocks for learners
    T-10735    Display activity name if session display is set to zero in Facetoface
    T-10866    Fixed action selector in Facetoface sessions
    T-10553    Fixed course reminders
    T-10861    Fixed error with 'is enrolled' filter in cached course completion reports
    T-10849    Show courses in alphabetical order in course selector in badges
    T-10855    Show activities full names in exports of activity completion reports
    T-10852    Fixed validation of required custom fields in Facetoface
    T-10842    Fixed completion date for activities still in progress in activity completion report
    T-10843    Fixed error when editing SCORM with activity completion locked
    T-6710     Fixed language strings in Hierarchies custom fields


Release 2.4.4 (25th June 2013):
==================================================

Improvements:
    T-10834    Include users with roles from higher contexts as session trainers in Facetoface
    T-10743    Added course completion enhancements
    T-10702    Show email beside user name when selecting users in dialogs
    T-10825    Timezones are now updated on Totara install and upgrade
    T-10727    Add bulk uploads using ID number, username or userid in Facetoface

Bug Fixes:
    T-10830    Set RTL direction of message body for RTL languages
    T-10829    Fixed non-English event names truncation in Facetoface
    T-10839    Fixed incorrect URL in Facetoface message footer
    T-10838    Fixed Factoface session location in iCal invitations
    T-10836    Fixed ID bug when updating notification template in Facetoface
    T-10815    Fixes page set up to avoid reports export issues in Audiences
    T-10823    Fixed error accessing a course with completion by role configured when a role has been deleted
    T-10826    Fixed error when rule sets are updated in Audiences
    T-10783    Fixed input boxes boundary in Facetoface session form
    T-10686    Fixed exporting of hierarchy frameworks with custom fields
    T-10821    Send notifications to users added to Facetoface sessions through text input
    T-10818    Fixed participants search in Facetoface
    T-9714     Users with create course/program capabilities in a category context can now see category if it is empty
    T-10789    Fixed string formatting in Facetoface notifications
    T-10819    Fixed userfullname variable replacement in event-driven Program messages
    T-10808    Include notifications when duplicating a Facetoface activity
    T-10772    Fixed PHP warning message when saving cohorts, courses, and modules with no tag selected
    T-10812    Fixed internationalisation issues in Facetoface
    T-10804    Fixed issues with filenames names when exporting a report
    T-10525    Fixed PHP strict standards errors in Element Library
    T-10517    Allow creating an audience without the end date


Release 2.4.3 (11th June 2013):
==================================================

New features:
    T-10685    Allow reports to be exported to the file system

Improvements:
    T-10666    Include debugging state for a site with registration data
    T-10702    Show email beside user name when assigning individuals to a program
    T-10743    Add new permission for resetting course completion data

Database Upgrades:
    T-10807    Removed unused image column from badge table

Bug Fixes:
    T-10534    Hidden Learning Plan template cannot be set to default
    T-10802    Added instruction text to Site Notices setting in Facetoface
    T-10792    Only allow managers to approve their own staff for Facetoface sessions
    T-10798    Added end date placeholder for emails in Facetoface
    T-10710    Notification records are now deleted when Facetoface sessions are deleted
    T-10811    Fixed incorrect parameter assignment in course reminder cron
    T-10576    Fixed wording in report builder performance tab help
    T-10806    Added missing session date to booking notifications in Facetoface
    T-10545    Fixed RTL issues in Learning Plans
    T-10805    Fixed automatic assignment of competencies by organisation
    T-10588    Updated help text for "Override user conflicts" in Facetoface
    T-10801    Fixed spacing issue in user profile fields
    T-10799    Fixed RTL language style issue in exceptions reports in Programs
    T-10790    Removed deprecated build_navigation() in Facetoface
    T-10781    Fixed upgrade error in Leaning Plans
    T-10788    Fixed one email per session date in Facetoface
    T-10723    Fixed SCORM screen size issue on mobile devices
    T-10786    Fixed RTL language progress bar direction
    T-9369     Fixed removal of selected courses in competencies and objectives in Learning Plans
    T-10419    Fixed PHP warnings in Learning Plans
    T-10605    Fixed breadcrumbs when editing notifications in Facetoface
    T-5734     Fixed merge issue in course activity display
    T-5734     Fixed incorrect variable name in course/program search


Release 2.4.2 (28th May 2013):
==================================================

New features:
    T-10625    Add activity filters to the main calendar

Improvements:
    T-7702     Hide components from record of learning if they are not relevant to users
    T-10742    Add module requirements to completion progress details page
    T-10773    Add badges block to the course page
    T-10764    Update jQuery and jQuery UI
    T-10750    Add the columns manager firstname and lastname to the base source in Report Builder
    T-10749    New date finished column in Facetoface reports

Database Upgrades:
    T-10782    Fixed upgrade from Moodle 2.4.4
    T-10776    Fixed badgeid foreign key on badge_manual_award table

Bug Fixes:
    T-5734     Fixed undefined variable warning in Report Builder
    T-6710     Fixed hardcoded competency language strings
    T-10511    Fixed breadcrumbs in templates in Learning plans
    T-10778    Fixed MSSQL distinct ntext problem in Program Management cron
    T-10521    Stay on page when toggling blocks editing in Audience Management
    T-10752    Fixed multilang filters issues in course, program, plan, and template names
    T-10621    Fixed internationalisation problem with pre-defined rooms in Facetoface
    T-10763    Allow upgrade to continue after errors when updating language packs
    T-10679    Fixed error in types with names longer than 255 characters in hierarchies
    T-10775    Fixed display of speech bubbles in Chat module for IE7
    T-10771    Missing library error when cancel course restore
    T-10774    Fixed filepicker layout in IE7
    T-10740    Fixed deletion of program assignments from audience tab
    T-10766    Hide positions from users without 'viewposition' capability
    T-10415    Fixed "Clear incorrect responses" option in Quiz
    T-10640    Added warning to messaging system
    T-10754    Fixed ampersands breaking filenames in scorm reports
    T-10761    Fixed hardcoded language string in program breadcrumbs
    T-10696    Stay on course/program category page when toggling blocks editing
    T-10629    Show user profile link when viewing course blogs
    T-10531    Fixed undefined variable in Learning plans
    T-10437    Fixed the message about users awaiting approval in Facetoface
    T-10717    Remove extra addlog() when creating user in Totara Sync
    T-10753    Fixed RTL issues on checkbox and text field combination
    T-10760    Added enclosure for fields with spaces and commas when exporting report in CSV
    T-10616    Make Factoface links style consistent with other links on course page
    T-10682    Show evidence type name in Evidence Record of Learning report
    T-10755    Remove unused code from Facetoface
    T-10585    Fixed help text typos in Learning Plans
    T-10538    Fixed undefined variable in Learning Plans


Release 2.4.1 (14th May 2013):
==================================================

New features:
    T-9460      Add learning plan report source

Improvements:
    T-10193     Set minimum width on tinymce editors
    T-10726     Change the My Team page to be editable, so blocks can be added
    T-10742     Add module requirements to completion progress details page
    T-10316     Show warning message if session is overbooked
    T-10697     Display end dates of the Facetoface sessions over multiple dates
    T-10662     Add firstaccess column to a user report source
    T-10573     Allow embedding media in program summary and endnote
    T-10713     Move changelog into PHP file to prevent version identification via the web
    T-10702     Show email next to user name when enrolling individuals

Bug Fixes:
    T-10663     Allow selected scheduling conflicts doesn't work from bulk uploads
    T-10694     Ensure a table exists before trying to rename it
    T-10416     Fix rules issues in cloned audiences
    T-10669     Fix broken links to course reports
    T-10728     Fix incorrect calculation of recurrence time for recurring courses in programs
    T-10659     Ensure face-to-face signup page checks for date conflicts
    T-10739     Face-to-face session time is shifted by 12 hours in UTC zone
    T-10732     Fix manager unassignment when manager is changed
    T-10708     Fix sessions dates and times display
    T-10680     Hierarchy textarea custom fields break report builder layout in MSSQL
    T-10158     Fix show/hide columns status in reports
    T-10539     Fixed character encoding issues in pdf certificates
    T-10709     Fix for facetoface iCals containing double quotes
    T-10693     Handle missing manager on user import in totara_sync
    T-10689     Set user specified session duration if unknown datetime in Facetoface
    T-10706     Fix fatal error when installing in a non-English language with no predefined config.php
    T-10722     Fix warning message when saving backpack settings without groups
    T-10711     Fix for carriage returns in bulk uploads in Facetoface sessions
    T-10650     Filter by Message Type doesn't work in MySQL for messages report
    T-10515     Remove "Stay on this page" prompt when trying to confirm audience rule changes
    T-10567     Error when trying to cache some reports due to "Column length too big for column"
    T-10373     Redirect to courses page if unable to enrol in a course
    T-10380     Fix status completion required when updating scorm
    T-10705     Fix potential duplicated columns in synclog
    T-10352     Set correct user in createdby field of signup status updates
    T-10361     Show sidebar on Learning plan template component tab
    T-10701     Fix error when upgrading to 2.4.0 if sessions have 'Approval required' unchecked
    T-10507     On programs page, "turn editing on/off" redirects to course page, not program page
    T-10277     Fix the amount of days in a year in programs
    T-9446      Fix facetoface sessions duration output
    T-10660     Face-to-face session
    T-10574     Fix display of images in program description
    T-10670     Prevent Notifications menu item appearing in face-to-face navigation for learner
    T-10490     Fix layout of minimise and dock icons in blocks


Release 2.4.0 (30 April 2013):
==================================================

Initial release of Totara 2.4

2.4 introduces the following new features:

* Open badges support
  * Create and issue verifiable digital achievements
  * Define criteria to automatically issue badges
  * Link to an external "backpack" to import and export badges
  * Badges compliant with Mozilla Open Badges standard

* Major improvements to Face-to-face including:
  * Ability to create and assign rooms to sessions
  * Room, trainer and user conflict management
  * Activity and session wide notifications
  * Notification templates

* Support for user-supplied evidence in Learning plans and Record of Learning
  * Create evidence of learning outside the LMS
  * Link evidence to items within a learning plan
  * Admin can create evidence types to support categorisation of evidence

* Learning plan improvements
  * Ability to allow users to select from multiple learning plan templates
  * Ability to bulk create learning plans for all users within an audience

* External database plugin for Totara Sync
  * Ability to connect to a separate database to sync users, positions and organisations

* Performance settings for Report Builder:
  * Option to cache reports
  * Option to generate reports from a separate reporting database
  * Option to prevent loading of report until filters are applied

This release updates Totara to be based on Moodle 2.4, which includes the following improvements:

* Improvements to file picker (including usability improvements, drag and drop in supported browsers, file aliases)
* Improvements to course editing (including drag and drop to add content in supported browsers, new activity picker, moving blocks, sections and resourses by dragging)
* Repository improvements (including EQUELLA repository support, aliases within repositories, access to server files for more activities)
* A new assignment module
* Improvements to the quiz, SCORM and workshop modules
* Performance improvements (including new 'Moodle Universal Cache')
* Course format plugins
* Improved icon support
* Improved TinyMCE editor integration (including customising the toolbar icons via settings)
* Integration of external calendars (allows streaming of external calendar events into Totara via iCal)
* Full support for unicode filenames in zip archives

For more details on the Moodle changes see:

http://docs.moodle.org/dev/Moodle_2.3_release_notes
http://docs.moodle.org/dev/Moodle_2.4_release_notes

See INSTALL.txt for the new system requirements for 2.4.

API Changes:

* Moodle API changes as detailed in the Moodle release notes
* Report builder activity groups are deprecated. The menu item has been removed from 2.4
  and code will be removed in a subsequent release.

*/
?>
