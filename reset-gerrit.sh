#!/bin/sh

echo "Update hudson directory permissions"
# when hudson updates it resets to 750 which, makes the webroot
# inaccessible. Resetting every build is overkill but does the
# job
chmod 755 /var/lib/hudson

echo "Delete config.php";
rm config.php

echo "Drop old database t1-hudsontesting-gerrit";
dropdb t1-hudsontesting-gerrit

echo "Create new database t1-hudsontesting-gerrit";
createdb -O hudson t1-hudsontesting-gerrit

echo "Delete old moodledata";
rm -Rf ../moodledata/

echo "Re-create moodledata";
mkdir ../moodledata
chmod 777 ../moodledata

echo "Reset apache logs";
rm /var/log/sitelogs/totara-gerrit-test-patch/access.log
rm /var/log/sitelogs/totara-gerrit-test-patch/error.log
touch /var/log/sitelogs/totara-gerrit-test-patch/access.log
touch /var/log/sitelogs/totara-gerrit-test-patch/error.log
chmod 666 /var/log/sitelogs/totara-gerrit-test-patch/access.log
chmod 666 /var/log/sitelogs/totara-gerrit-test-patch/error.log

echo "Initialize installation";
/usr/bin/php admin/cliupgrade.php \
      --lang=en_utf8 \
      --webaddr="http://totara-gerrit-test-patch.hudson.brumbies.wgtn.cat-it.co.nz" \
      --moodledir="/var/lib/hudson/jobs/Gerrit-Test-Patch/workspace" \
      --datadir="/var/lib/hudson/jobs/Gerrit-Test-Patch/moodledata" \
      --dbtype="postgres7" \
      --dbname="t1-hudsontesting-gerrit" \
      --dbhost="localhost" \
      --dbuser="hudson" \
      --dbpass="password" \
      --prefix="mdl_" \
      --verbose=3 \
      --sitefullname="Totara" \
      --siteshortname="Totara" \
      --sitesummary="" \
      --sitenewsitems=0 \
      --adminfirstname=Admin \
      --adminlastname=User \
      --adminemail=simonc@catalyst.net.nz \
      --adminusername=admin \
      --adminpassword="passworD1!" \
      --interactivelevel=0

echo "Hit notifications page to complete installation";
python build/complete_upgrade.py http://totara-gerrit-test-patch.hudson.brumbies.wgtn.cat-it.co.nz/

