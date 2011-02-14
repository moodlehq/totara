#!/bin/sh

echo "Update hudson directory permissions"
# when hudson updates it resets to 750 which, makes the webroot
# inaccessible. Resetting every build is overkill but does the
# job
chmod 755 /var/lib/hudson

echo "Delete config.php";
rm config.php

echo "Drop old database t1-hudsontesting";
DROPDB="DROP database \`t1-hudsontesting\`;"
mysql -u hudson -e "$DROPDB"

echo "Create new database t1-hudsontesting";
CREATEDB="CREATE database \`t1-hudsontesting\`;"
mysql -u hudson -e "$CREATEDB"

echo "Delete old moodledata";
rm -Rf ../moodledata/

echo "Re-create moodledata";
mkdir ../moodledata
chmod 777 ../moodledata

echo "Reset apache logs";
sudo /usr/local/bin/clear_apache_logs.sh totara-mysql

echo "Initialize installation";
/usr/bin/php admin/cliupgrade.php \
      --lang=en_utf8 \
      --webaddr="http://totara-mysql.hudson.brumbies.wgtn.cat-it.co.nz" \
      --moodledir="/var/lib/hudson/jobs/Totara-MySQL/workspace" \
      --datadir="/var/lib/hudson/jobs/Totara-MySQL/moodledata" \
      --dbtype="mysql" \
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
python build/complete_upgrade.py http://totara-mysql.hudson.brumbies.wgtn.cat-it.co.nz/
