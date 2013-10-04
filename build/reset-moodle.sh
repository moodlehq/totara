#!/bin/bash

# This accepts three arguments
# 1/ The database server e.g. oak
# 2/ The database type e.g. postgres7
# 3/ The branch name e.g. t2-release-2.5

echo "Update Jenkins directory permissions"
# when Jenkins updates via apt it resets to 750 which, makes the webroot
# inaccessible. Resetting every build is overkill but does the job
chmod 755 /var/lib/jenkins

if [ -e config.php ]
then
    echo "Delete config.php"
    rm config.php
fi

DBNAME="jenkins-$JOB_NAME"
/var/lib/jenkins/internal-tools/testing/resetdb.sh $1 $2 $DBNAME

echo "Delete old moodledata"
sudo -u www-data php build/reset_cleanmoodledata.php
rmdir ../moodledata/

echo "Re-create moodledata"
mkdir ../moodledata
chmod 777 ../moodledata

echo "Allow creation of config.php"
chmod 777 .

echo "Initialize installation"

# Convert to type required by moodle cli install
if [ $2 = 'postgres7' ]
then
    DBTYPE='pgsql'
elif [ $2 = 'mysql' ]
then
    DBTYPE='mysqli'
elif [ $2 = 'mssql_n' ]
then
    DBTYPE='mssql'
else
    DBTYPE="$2"
fi

BRANCHNAME=$3

# Make sure we have the latest Totara stuff.
git fetch origin

# Get the moodle version out of the version.php file.
HASH=`git rev-parse origin/${BRANCHNAME}`
# this line gets the version file from the latest patchset of the branch
# then finds the release line
# then replaces the whole line with just the version number (e.g. 2.4.5)
MOODLEVERSION=`git show $HASH:version.php | grep '$release' | sed "s/^[^']*'\([^ ]*\) .*/\1/g"`

echo "Install Moodle ${MOODLEVERSION}"
git fetch moodle # Update the moodle repo for this job.
git checkout "v${MOODLEVERSION}"

sudo -u www-data php admin/cli/install.php \
    --chmod=755 \
    --lang=en_utf8 \
    --wwwroot="http://jobs.test.totaralms.com/$JOB_NAME" \
    --dataroot="/var/lib/jenkins/jobs/$JOB_NAME/moodledata" \
    --dbtype="$DBTYPE" \
    --dbname="$DBNAME" \
    --dbhost="$1" \
    --dbuser="jenkins" \
    --dbpass="password" \
    --prefix="tst_" \
    --fullname="$JOB_NAME" \
    --shortname="$JOB_NAME" \
    --adminuser=admin \
    --adminpass="passworD1!" \
    --non-interactive \
    --agree-license \
    --allow-unstable

echo "Appending test variables to config.php"
sudo chown jenkins config.php
echo >> config.php
echo "\$CFG->phpunit_prefix = 'unt_';" >> config.php;
echo "\$CFG->phpunit_dataroot = '/var/lib/jenkins/jobs/$JOB_NAME/phpunit_dataroot';" >> config.php;

# TODO - do we want to put anything in here or are we good with upgrading a fresh/empty install?

git checkout ${BRANCHNAME}
git reset --hard origin/${BRANCHNAME}

echo "Upgrade to Totara"
sudo -u www-data php /var/lib/jenkins/jobs/${JOB_NAME}/workspace/admin/cli/upgrade.php --non-interactive

echo "Initialize phpunit environment"
php admin/tool/phpunit/cli/init.php
