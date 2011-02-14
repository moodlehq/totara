#!/bin/sh

echo "Update hudson directory permissions"
# when hudson updates it resets to 750 which, makes the webroot
# inaccessible. Resetting every build is overkill but does the
# job
chmod 755 /var/lib/hudson

echo "Delete config.php";
rm config.php

echo "Drop old database t1-hudsontesting-10";
dropdb t1-hudsontesting-10

echo "Create new database t1-hudsontesting-10";
createdb -O hudson t1-hudsontesting-10

echo "Delete old moodledata";
rm -Rf ../moodledata/

echo "Re-create moodledata";
mkdir ../moodledata
chmod 777 ../moodledata

echo "Reset apache logs";
rm /var/log/sitelogs/totara-10/access.log
rm /var/log/sitelogs/totara-10/error.log

echo "Initialize installation";
/usr/bin/php admin/cliupgrade.php \
      --lang=en_utf8 \
      --webaddr="http://totara-10.hudson.brumbies.wgtn.cat-it.co.nz" \
      --moodledir="/var/lib/hudson/jobs/Totara-1.0/workspace" \
      --datadir="/var/lib/hudson/jobs/Totara-1.0/moodledata" \
      --dbtype="postgres7" \
      --dbname="t1-hudsontesting-10" \
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
python build/complete_upgrade.py http://totara-10.hudson.brumbies.wgtn.cat-it.co.nz/
