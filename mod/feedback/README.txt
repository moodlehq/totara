Feedback-Module
===============
Overview
--------
The Feedback-Module is intended to create individual surveys in an easy way.

This module consists of two parts
a) the "activity" feedback (required)
b) the "sideblock" feedback (optional)

The activity is the main part an can run without the block. Here you can create, fill out or analyse the surveys.
The sideblock is an optional part. It works as a bridge between different courses and
an central placed feedback-activity. So you can create one feedback on the main site of moodle and then publish
it in many courses.

Requirements
------------
Moodle 1.8.x or later

Installation 
------------
   The zip-archive includes the same directory hierarchy as moodle
   So you only have to copy the files to the correspondent place.
   copy the folder feedback.zip/mod/feedback --> moodle/mod/feedback
   and the folder feedback.zip/blocks/feedback --> moodle/blocks/feedback
   The langfiles normaly can be left into the folder mod/feedback/lang.
   The only exception is the feedback-block. The langfile is block_feedback.php and
   have to be copied into the correspondent lang folder of moodle/moodledata.
   All languages should be encoded with utf8.

After it you have to run the admin-page of moodle (http://your-moodle-site/admin)
in your browser. You have to loged in as admin before.
The installation process will be displayed on the screen.
That's all.

using the block-feature
-----------------------
   1. create one or more new feedback-activitys on the moodle main-site
   2. go into some course and enable the feedback-block. This block now shows the feedbacks from the main-site.
   3. login as student and go into the course where the feedback-block is enabled
   4. fill out the feedback chosen from block
   5. login as admin and look at the feedback you created above
   6. now you can analyse the answers over the courses

good luck