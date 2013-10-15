<?php
/*

Totara LMS Changelog

Release 2.4.12 (15th October 2013):
==================================================

Improvements:
    T-11363    Improved formatting of session times in face-to-face block report
    T-5879     Fixed spelling/grammar for teammembers string (en lang pack)

Bug Fixes:
    T-11410    Fixed custom textarea user profile fields not being displayed on the sign-up page
    T-11468    Fixed serious issue causing loss of program completion dates when assignments saved when using imported language
    T-11470    Restricted unauthorised access for learners in program details page


Release 2.4.11 (1st October 2013):
==================================================

New Features:
    T-10421    Added additional registration check/site version message

Improvements:
    T-11218    Improved readability in course/program categories when using mymobile totara theme
    T-11086    Refactored program assignment code to reduce POST vars
    T-11240    Added time modified column/filter to report builder user reports

Bug Fixes:
    T-11227    Fixed warning in Totara upgrade function
    T-11226    Fixed plans showing up under required learning header for mylearning pages
    T-11219    Included library file for hierarchy fields in Reportbuilder
    T-11230    Fixed completion language string in Learning Plans
    T-11285    Made constant names less general in the utils library
    T-11304    Fixed javascript problem when selecting organisation/position filters in My Reports
    T-11299    Fixed display of empty completion dates in program completion reports
    T-11253    Added support for audience rules that have outdated criteria
    T-11256    Fixed capacity of waitlist for facetoface sessions when overbooking is turned off
    T-10607    Added ajax updates to attendee tab in facetoface sessions
    T-11310    Fixed cron error when syncing audiences into course groups
    T-10904    Fixed display of tags while editing wiki pages


Release 2.4.10 (17th September 2013):
==================================================

Security issues:
    Fixes from MoodleHQ http://docs.moodle.org/dev/Moodle_2.4.6_release_notes
    T-10913    Added caching of external badges to avoid object injections in badges/external.php

Improvements:
    T-9250     Use totara_get_manager() in Face-to-face notifications
    T-9390     Use totara_get_staff() in the totara statistics block
    T-10342    Added column to display unobscured email address for users with "moodle/site:viewuseridentity" permissions
    T-11183    Added user "Time created" column option to reportbuilder user reports
    T-11207    Temporarily hide fusion grade export until we fix google plugins

Bug Fixes:
    T-10892    Added conflict message when session trainers are displayed in a drop-down list
    T-11198    Changed calendar date format for Totara date pickers to 4 digit years
    T-11195    Fixed issue with registration fallback method
    T-11201    Fixed status for multi-date session in Facetoface
    T-11181    Fixed wording of enrol link in my settings block
    T-11184    Fixed Dynamic Audience rule assignments based on country and language
    T-11188    Fixes around badge capabilities and navigation
    T-11194    Removed unused en_us files in lang/en_us
    T-11197    Fixed HTML tags showing in the subject of some facetoface messages


Release 2.4.9 (3rd September 2013):
==================================================

Improvements:
    T-11130    Program Course Sets: Set 'or' groups to use max not min time required
    T-11129    Program Course Sets: Added programs total time required to the description on content and assignment tabs
    T-10869    Badge name and description can now be edited in active or locked badges
    T-11143    Included idnumber for positions and organisations in user report source
    T-11151    Added triggers for user create/update events in Totara Sync

Bug Fixes:
    T-11113    Fixed deletion of associated program assignments when a user is deleted
    T-10827    Fixed collection of extrafields for grouped columns in Reportbuilder
    T-10876    Fixed folder/file picker modal popup widths in IE7
    T-11041    Fixed course reminder emails and recipients
    T-11139    Fixed learning plans manager approval process when competencies have linked courses
    T-9873     Added ajax update for and/or options on dynamic audiences rules tab
    T-10577    Removed text help from Evidence and changed the message description in record of learning
    T-11082    Fixed the format of system messages when using special characters
    T-10442    Fixed audience emails not using users email preference settings
    T-11134    Fixed ROL tabs not showing for the manager under certain circumstances
    T-11127    Fixed creation of manager relationships with Totara Sync
    T-10779    Changed the language string for Face to face conflict messages
    T-11150    Fixed position assignment data getting reset in Totara Sync
    T-11142    Fixed name column when exporting file in My Team tab
    T-10939    Fixed TinyMCE images in f2f description and session description
    T-11153    Fixed rules based on custom checkboxes to use default value when null
    T-11152    Improved session status display for user
    T-11155    Fixed incorrect foreign key reference in install.xml
    T-5734     Fixed string encoding/formatting on learning plans view component page
    T-6080     Updated affected files code to handle no changes and make it a bit clearer


Release 2.4.8 (20th August 2013):
==================================================

Improvements:
    T-10960    Improved error messages when field character length limit is exceeded in Totara Sync
    T-10929    Added custom field mappings for user sources in Totara Sync
    T-10921    Send decline notification when manager declines user session request in Facetoface
    T-10935    Improved Facetoface session status display for learners
    T-10404    Expanded options for text input fields in dynamic audience rules
    T-10997    Added suspended user field to the list of fields that can be imported via Totara Sync
    T-11040    Modified plugin settings load order to better support local plugins
    T-11020    Added suppress email setting to bulk user uploads in Facetoface

Bug Fixes:
    T-11068    Fixed the error message when trying to enrol an audience to a course multiple times
    T-10894    Fixed sending emails to a 3rd party in Facetoface
    T-10281    Created a queue for program assignment messages to avoid duplicate emails to users
    T-10714    Fixed display of images in course, program, and plan description columns in reports
    T-11090    Fixed the repaginate button and style issues in quiz module
    T-10319    Added a check for duplicated idnumbers/usernames/emails when importing users in Totara Sync
    T-11091    Removed entries in prog_pos_assignment table when deleting a position
    T-11083    Fixed overlapping page elements in Kiwifruit theme
    T-11059    Fixed error with plain text messages being sent as html messages
    T-11056    Replaced deprecated live() function in MyMobile Totara theme
    T-11022    Fixed activity completion and course progress reports headers display in Internet Explorer 8
    T-10533    Fixed error when creating a wiki page using the same tag twice
    T-11060    Fixed "records shown" language string in tasks and alerts embedded reports
    T-11061    Fixed managers not getting Factoface session requests in their tasks
    T-11058    Updated facetoface cron to use mtrace rather than echo
    T-10919    Fixed empty emails being sent out when messaging system is used
    T-10824    Fixed badge image url breaking when slasharguments is not supported
    T-5734     Fixed string encoding issue in session signup form
    T-5734     Fixed undefined variable warnings in Totara Task and Alert blocks


Release 2.4.7 (6th August 2013):
==================================================

Improvements:
    T-10927    Various performance improvements for Facetoface bookings

Bug Fixes:
    T-10926    Fixed issues with participants being completely removed when when approval setting is changed within a facetoface activity
    T-10917    Fixed issue with text editor alignment when editing section name and summary
    T-10931    Fixed alignment of report filters in Report builder
    T-10932    Cached reports are now scheduled for the closest day. Cache status is displayed in user date/time taking into account user timezone
    T-10925    Fixed rebuild_course_cache() warning when upgrading from Moodle to Totara
    T-10835    Fixed issue with syncing menu of choice custom fields in Totara Sync
    T-10938    Fixed saving advanced option for filters in Report builder
    T-10936    Format of reports exported to csv is now consistent with reports saved to the file system
    T-10937    Make page footer links clickable for the Kiwifruit theme
    T-10916    Fixed label alignment issue with completion checkboxes in Courses


Release 2.4.6 (23rd July 2013):
==================================================

Improvements:
    T-10584    Room capacity and session capacity fields in Facetoface are now synchronised and validated
    T-10903    Add admin and user config setting to Alerts/Tasks block to show/hide empty block
    T-10890    Improved loading speed of Facetoface add attendees dialog for large sites
    T-10880    Facetoface iCal invitation now includes session information
    T-10889    Added new button to allow the addition of courses related to a competency in a Learning Plan

Bug Fixes:
    T-10923    Add user profile fields to filter options in reports
    T-10908    Fixed 'Class not found' error when calling require_login function
    T-10915    Allow manager to approve their staff Facetoface sessions without enrolling into the course
    T-10922    Display edit user position form even with no position hierarchies
    T-10900    Notify session trainers on assignment/unassignment and remove trainer records when session is deleted
    T-10901    Fixed cURL expectation failed error when trying to connect to Mozilla backpack
    T-10883    Fixed MSSQL issues when saving dynamic cohort rules with custom profile fields
    T-10902    Fixed toggle All/None in embedded alert/task reports
    T-10879    SCORM package file is now optional to allow external AICC URL
    T-10877    Allow selecting predefined rooms with enabled room conflicts in Facetoface
    T-10887    Add links to "Learning plans" and "Record of learning" to the user profile pages
    T-10906    Fixed display of user status (active, deleted, and suspended) in Reports
    T-10856    Fixed default tables collation for cached reports in MySQL
    T-10886    Re-add Accept/Reject buttons to manager tasks generated by Facetoface
    T-10758    Added "Please select another user" to a conflict message in Facetoface
    T-10888    Optimisation to reduce redundant calls to source constructor in embedded reports
    T-10899    Fixed export timeout in reports with completion status column
    T-10893    Added check for http and https in badge backpack connection
    T-10891    When editing report, "General" tab now uses sourcetitle for report source name
    T-10875    Remove unresolved exceptions when users are unassigned from a Program


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
