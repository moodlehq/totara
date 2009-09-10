#!/bin/sh

ADMINPW=`pwgen -s 8`

/usr/bin/php admin/cliupgrade.php \
      --webaddr="http://moodlectl.lynch" \
      --moodledir="/home/francois/code/moodlectl" \
      --datadir="/var/lib/moodledata/moodle-19-moodlectl" \
      --dbtype="postgres7" \
      --dbname="moodle-19-moodlectl" \
      --confirmrelease=yes \
      --agreelicense=yes \
      --verbose=0 \
      --sitefullname="Moodle Test site" \
      --siteshortname="moodletest" \
      --sitesummary="This is just a test site" \
      --sitenewsitems=3 \
      --adminfirstname=Site \
      --adminlastname=Administrator \
      --adminemail=francois@catalyst.net.nz \
      --adminusername=admin \
      --adminpassword=$ADMINPW

echo "Moodle is now installed."
echo
echo "You can login as Site Administrator using:"
echo "  username:  admin"
echo "  password:  $ADMINPW"
