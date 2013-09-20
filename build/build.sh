#!/bin/sh

#
# This file is part of Totara LMS
#
# Copyright (C) 2010-2013 Totara Learning Solutions LTD
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 3 of the License, or
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

echo "STEP 1: Record list of files that changed in this commit";
affectedFiles=$(php -r '
$buildinfo = json_decode(
    file_get_contents(getenv("BUILD_URL") . "/api/json"), true
);
if (isset($buildinfo["changeSet"]["items"][0]["affectedPaths"])) {
    foreach ($buildinfo["changeSet"]["items"][0]["affectedPaths"] as $affectedpath) {
        print $affectedpath."\n";
    }
}'| grep '.php$\|.html$')
step_time "1"

#STEP 2
echo "STEP 2: Run php syntax check";
for FILE in $affectedFiles
do
    ./build/lint.sh ${FILE} | grep -v "No syntax errors detected"
done
step_time "2"

#STEP 3
echo "STEP 3: Run version check"
for FILE in $affectedFiles
do
    case $FILE in
        *version.php)  versionFile="true";;
    esac
done
# Only run if a version file changed
if [ -n "$versionFile" ]
then
    echo "A version file changed!"
    #get the branch variable and split to get the remote and branch variables
    repo=$(php -r '
    $a=json_decode(file_get_contents(getenv("BUILD_URL")."/api/json"),true);
    //Tree structure for Gerrit and Nightly builds is different!
    foreach ($a["actions"] as $key => $val) {
        if (is_array($val) && isset($val["parameters"])) {
            //Gerrit build
            foreach ($val["parameters"] as $index => $value) {
                if (is_array($value) && isset($value["name"]) && $value["name"] == "GERRIT_BRANCH")
{
                    echo "origin/".$value["value"];
                    exit();
                }
            }
        } else {
            //Nightly build
            if (is_array($val) && isset($val["lastBuiltRevision"])) {
                if (isset($val["lastBuiltRevision"]["branch"])) {
                    foreach ($val["lastBuiltRevision"]["branch"] as $key2 => $val2) {
                        if (isset($val["lastBuiltRevision"]["branch"][$key2]["name"])) {
                            echo $val["lastBuiltRevision"]["branch"][$key2]["name"];
                            exit();
                        }
                    }
                }
             }
        }
    }
    ')
    #Did we find the branch in the json tree?
    if [ "$repo" = "" ]
    then
        echo "ERROR: Could not determine branch in tree"
    else
        echo "Repository is ${repo}"
        remote=$(echo ${repo} | cut -d'/' -f1)
        branch=$(echo ${repo} | cut -d'/' -f2)
        for FILE in $affectedFiles
        do
            case $FILE in
                *version.php)  sudo -u www-data php build/version_check.php --filepath=${FILE} --remote=${remote} --branch=${branch};;
            esac
        done
    fi #end if we found repo in tree
fi #end if we have a versionFile
step_time "3"

#STEP 4
echo "STEP 4: Generate some test users"
sudo -u www-data php build/generate_users.php
step_time "4"

#STEP 5
echo "STEP 5: Run PHPUnit";
phpunit --exclude-group=slowtest --log-junit build/logs/xml/TEST-suite.xml
step_time "5"

#STEP 6
echo "STEP 6: Run miscellaneous syntax check (to be combined with Step 4?)";
sudo -u www-data php build/syntax_check.php
step_time "6"

echo "Total Time was: $TOTAL Seconds ($(($TOTAL/60)) Minutes)"
