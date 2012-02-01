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
# This accepts two arguments
# 1/ The base url of the site being tested (including trailing slash)
# 2/ The cucumber test profile (see cucumber.yml)

echo "STEP 1: Run php syntax check";
php build/lint.php

echo "STEP 2: Generate some test users"
php build/generate-users.php

echo "STEP 3: Run simpletests";
php build/simpletests.php --format=xunit > build/logs/xml/TEST-suite.xml

echo "STEP 4: Run cucumber tests (disabled link checker tests)";
cucumber -p $2 --format junit --out build/logs/xml/

if [ $2 = 'pgsql' ]
then
    echo "STEP 5: Generate database performance report"
    mkdir -p build/logs/perf
    cd build/logs/perf
    # only process log info from the nightly database
    sudo pgfouine -database t1-hudsontesting-nightly -file /var/log/postgresql/postgres.log -top 40 -report queries.html=overall,bytype,slowest,n-mosttime,n-mostfrequent,n-slowestaverage -report hourly.html=overall,hourly -report errors.html=overall,n-mostfrequenterrors -format html-with-graphs
    cd -
fi

echo "STEP 6: Run link checker script as a learner";
php build/link_checker.php $1 learner 'passworD1!'


