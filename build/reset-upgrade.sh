#!/bin/sh

# This accepts three arguments
# 1/ The database server e.g. oak
# 2/ The database type e.g. postgres7
# 3/ The database name to upgrade from e.g. bak-jenkins-Totara-1.0

DBSERVER=$1
DBTYPE=$2
DBUPNAME=$3

echo "Update Jenkins directory permissions"
# when Jenkins updates via apt it resets to 750 which, makes the webroot
# inaccessible. Resetting every build is overkill but does the job
chmod 755 /var/lib/jenkins

DBNAME="jenkins-$JOB_NAME"
/var/lib/jenkins/internal-tools/testing/resetupgradedb.sh $DBSERVER $DBTYPE $DBUPNAME $DBNAME

echo "Delete old moodledata"
sudo -u www-data php build/reset_cleanmoodledata.php
rmdir ../moodledata/

echo "Re-create moodledata"
mkdir ../moodledata
chmod 777 ../moodledata

echo "Hit notifications page to complete upgrade"
python build/complete_upgrade.py http://jobs.test.totaralms.com/$JOB_NAME/
