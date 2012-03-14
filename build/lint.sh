#!/bin/sh
sudo -u www-data php -l "$1"
#Always exit with 0 so that xargs doesn't quit
exit 0
