#!/bin/sh

# This accepts two arguments
# 1/ The database server e.g. oak
# 2/ The database type e.g. postgres7

echo "Update Jenkins directory permissions"
# when Jenkins updates via apt it resets to 750 which, makes the webroot
# inaccessible. Resetting every build is overkill but does the job
chmod 755 /var/lib/jenkins

echo "Delete config.php"
rm config.php

DBNAME="jenkins-$JOB_NAME"
/var/lib/jenkins/internal-tools/testing/resetdb.sh $1 $2 $DBNAME

echo "Delete old moodledata"
rm -Rf ../moodledata/

echo "Re-create moodledata"
mkdir ../moodledata
chmod 777 ../moodledata

echo "Initialize installation"
php admin/cliupgrade.php \
      --lang=en_utf8 \
      --webaddr="http://jobs.test.totaralms.com/$JOB_NAME" \
      --moodledir="/var/lib/jenkins/jobs/$JOB_NAME/workspace" \
      --datadir="/var/lib/jenkins/jobs/$JOB_NAME/moodledata" \
      --dbtype="$2" \
      --dbname="$DBNAME" \
      --dbhost="$1" \
      --dbuser="jenkins" \
      --dbpass="password" \
      --prefix="tst_" \
      --verbose=3 \
      --sitefullname="$JOB_NAME" \
      --siteshortname="$JOB_NAME" \
      --sitesummary="" \
      --sitenewsitems=0 \
      --adminfirstname=Admin \
      --adminlastname=User \
      --adminemail=developers@totaralms.com \
      --adminusername=admin \
      --adminpassword="passworD1!" \
      --interactivelevel=0

echo "Hit notifications page to complete installation"
python build/complete_upgrade.py http://jobs.test.totaralms.com/$JOB_NAME/
