<?php
/*

Totara LMS Changelog

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

Database Upgrades:


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
