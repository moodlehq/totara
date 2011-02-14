#!/bin/sh

echo "Update hudson directory permissions"
# when hudson updates it resets to 750 which, makes the webroot
# inaccessible. Resetting every build is overkill but does the
# job
chmod 755 /var/lib/hudson

echo "Delete config.php";
rm config.php

echo "Drop old database t1-hudsontesting";
dropdb t1-hudsontesting

echo "Create new database t1-hudsontesting";
createdb -O hudson t1-hudsontesting

echo "Delete old moodledata";
rm -Rf ../moodledata/

echo "Re-create moodledata";
mkdir ../moodledata
chmod 777 ../moodledata

echo "Reset apache logs";
rm /var/log/sitelogs/totara-integration/access.log
rm /var/log/sitelogs/totara-integration/error.log
touch /var/log/sitelogs/totara-integration/access.log
touch /var/log/sitelogs/totara-integration/error.log
chmod 666 /var/log/sitelogs/totara-integration/access.log
chmod 666 /var/log/sitelogs/totara-integration/error.log

echo "Initialize installation";
/usr/bin/php admin/cliupgrade.php \
      --lang=en_utf8 \
      --webaddr="http://totara-integration.hudson.brumbies.wgtn.cat-it.co.nz" \
      --moodledir="/var/lib/hudson/jobs/Totara-Integration/workspace" \
      --datadir="/var/lib/hudson/jobs/Totara-Integration/moodledata" \
      --dbtype="postgres7" \
      --dbname="t1-hudsontesting" \
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
python build/complete_upgrade.py http://totara-integration.hudson.brumbies.wgtn.cat-it.co.nz/
