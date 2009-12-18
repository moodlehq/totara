-----------------------------------------------------------------------------
Face-to-face module for Moodle
Copyright (C) 2007-2009 Catalyst IT (http://www.catalyst.net.nz)

This program is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the Free
Software Foundation, either version 3 of the License, or (at your option)
any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <http://www.gnu.org/licenses/>.
-----------------------------------------------------------------------------


Description
------------

Face-to-face activities are used to keep track of in-person trainings which
require advance booking.

Each activity is offered in one or more identical sessions.  These sessions
can be given over multiple days.

Reminder messages are sent to users and their managers a few days before the
session is scheduled to start.  Confirmation messages are sent when users
sign-up for a session or cancel.


Requirements
-------------

* Moodle 1.9


Installation
-------------

1- Unpack the module into your moodle install in order to create a
   mod/facetoface directory.

2- Visit the /admin/index.php page to trigger the database installation.

3- (Optional) Change the default options in the activity modules
   configuration.


Integration with the course page
---------------------------------

To display the session dates directly on the course page, add the following
code to the print_section() function in course/lib.php:

--- /home/francois/code/cvs/moodle18/course/lib.php 2007-10-05 20:19:29.000000000 +1300
+++ course/lib.php  2007-11-06 21:14:08.000000000 +1300
@@ -1382,6 +1382,10 @@
                         echo "</span>";
                     }

+                } elseif ($mod->modname == 'facetoface') {
+                    include_once($CFG->dirroot.'/mod/facetoface/lib.php');
+                    echo facetoface_print_coursemodule_info($mod);
+
                 } else { // Normal activity

                     //Accessibility: for files get description via icon.

Bugs/patches
-------------

Feel free to send bug reports (and/or patches!) to the current maintainer:

  Francois Marier <francois@catalyst.net.nz>


Changes
--------

(see the ChangeLog.txt file)
