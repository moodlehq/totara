#!/bin/sh

#
# This file is part of Totara LMS
#
# Copyright (C) 2010-2012 Totara Learning Solutions LTD
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
# @author Aaron Barnes <aaron.barnes@totaralms.com>
# @package totara
# @subpackage build
#
# This accepts one argument:
# 1/ The base url of the site being tested (including trailing slash)

# Step timer function
step_time () {
    if [ -z $TOTAL ]; then TOTAL=0; fi
    STEPTIME=$((`date +%s`-$TOTAL-$TIME))
    echo "STEP $1: Finished $STEPTIME Seconds ($(($STEPTIME/60)) Minutes)"
    TOTAL=$(($TOTAL+$STEPTIME))
}

#STEP 1
TIME=`date +%s`
echo "STEP 1: Run php syntax check";
find . \( -name '*.php' -o -name '*.html' \) -print0 | xargs -0 -n1 -P4 ./build/lint.sh | grep -v "No syntax errors detected"
step_time "1"

#STEP 2
echo "STEP 2: Generate some test users"
sudo -u www-data php build/generate_users.php
step_time "2"

#STEP 3
echo "STEP 3: Run simpletests";
sudo -u www-data php build/simpletests.php --format=xunit > build/logs/xml/TEST-suite.xml
step_time "3"

#STEP 4
echo "STEP 4: Run cucumber tests";
cucumber --tags ~@nightly -p pgsql2 --format junit --out build/logs/xml/
step_time "4"

#STEP 5
echo "STEP 5: Run code scanner";
echo "php -f m2scanner // TODO"
step_time "5"

#STEP 6
echo "STEP 6: Run miscellaneous syntax check (to be combined with Step 4?)";
sudo -u www-data php build/syntax_check.php
step_time "6"

echo "Total Time was: $TOTAL Seconds ($(($TOTAL/60)) Minutes)"
