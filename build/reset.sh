#!/bin/sh

# .git/hooks/post-checkout must by symbolicly linked to this file

# Warning! It appears when an update to this file is checked out,
# the hook runs the previous version. So it takes an extra build
# to run the new reset file

echo "Delete config.php";
rm config.php

echo "Drop old database mdl19-hudsontesting";
dropdb mdl19-hudsontesting

echo "Create new database mdl19-hudsontesting";
createdb -O hudson mdl19-hudsontesting

echo "Delete old moodledata";
rm -Rf ../moodledata/

echo "Re-create moodledata";
mkdir ../moodledata
chmod 777 ../moodledata

echo "Reset apache logs";
rm ../moodle_error.log
touch ../moodle_error.log
chmod 777 ../moodle_error.log

echo "Initialize installation";
/usr/bin/php admin/cliupgrade.php \
      --lang=en_utf8 \
      --webaddr="http://hudson.spastk.wgtn.cat-it.co.nz" \
      --moodledir="/var/lib/hudson/jobs/Totara/workspace" \
      --datadir="/var/lib/hudson/jobs/Totara/moodledata/" \
      --dbtype="postgres7" \
      --dbname="mdl19-hudsontesting" \
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
      --adminemail=aaronb@catalyst.net.nz \
      --adminusername=admin \
      --adminpassword="passworD1!" \
      --interactivelevel=0


echo "Hit notifications page to complete installation";
wget -O - http://hudson.spastk.wgtn.cat-it.co.nz/admin/index.php
