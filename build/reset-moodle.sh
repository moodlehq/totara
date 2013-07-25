#!/bin/bash

# This accepts three arguments
# 1/ The database server e.g. oak
# 2/ The database type e.g. postgres7

DBSERVER=$1
DBTYPE=$2

echo "Update Jenkins directory permissions"
# when Jenkins updates via apt it resets to 750 which, makes the webroot
# inaccessible. Resetting every build is overkill but does the job
chmod 755 /var/lib/jenkins

DBNAME="jenkins-$JOB_NAME"
/var/lib/jenkins/internal-tools/testing/resetdb.sh $DBSERVER $DBTYPE $DBNAME

# Make sure we have the latest Totara stuff.
git fetch origin

# Get the moodle version out of the version.php file.
HASH=`git rev-parse origin/t2-release-2.4`
# this line gets the version file from the latest patchset of the branch
# then finds the release line
# then replaces the whole line with just the version number (e.g. 2.4.5)
MOODLEVERSION=`git show $HASH:version.php | grep '$release' | sed "s/^[^']*'\([^ ]*\) .*/\1/g"`

echo "Delete old moodledata"
sudo -u www-data php build/reset_cleanmoodledata.php
rmdir ../moodledata/

echo "Re-create moodledata"
mkdir ../moodledata
chmod 777 ../moodledata

echo "Install Moodle ${MOODLEVERSION}"
git fetch moodle # Update the moodle repo for this job.
git checkout "v${MOODLEVERSION}"
sudo -u www-data php /var/lib/jenkins/jobs/${JOB_NAME}/workspace/admin/cli/install.php --non-interactive

# TODO - do we want to put anything in here or are we good with upgrading a fresh/empty install?

git checkout t2-release-2.4

echo "Upgrade to Totara"
sudo -u www-data php /var/lib/jenkins/jobs/${JOB_NAME}/workspace/admin/cli/upgrade.php --non-interactive
