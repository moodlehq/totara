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

echo "STEP 1: Run php syntax check";
php build/lint.php

echo "STEP 2: Generate some test users"
sudo -u www-data php build/generate_users.php

echo "STEP 3: Run simpletests";
sudo -u www-data php build/simpletests.php --format=xunit > build/logs/xml/TEST-suite.xml

echo "STEP 4: Run cucumber tests";
cucumber --tags ~@nightly -p pgsql2 --format junit --out build/logs/xml/

echo "STEP 5: Run code scanner";
echo "php -f m2scanner // TODO"

echo "STEP 6: Run miscellaneous syntax check (to be combined with Step 4?)";
sudo -u www-data php build/syntax_check.php
