#!/bin/bash

#
# Script to pack a totara git branch ready for distribution
#
# Removes temp files, build directory, config file, etc and
# generates a single gzipped tar file
#
# First argument is name for output file, if none provided,
# ../out.tar.gz is used
#
# Operates on the current directory so best run from moodle
# root with:
#
# ./build/pack-totara.sh [optional output filename]
#

IGNOREFILE='/tmp/pack-totara'`date +%s`
echo './build*
./.git*
./tags
./TAGS
*.swp
*~
./config.php
./cucumber.yml
./webrat*
' > $IGNOREFILE

# try and figure out the totara version
VERSION=`grep '\$TOTARA->version\s*=' version.php | sed "s/^[^']*'\(.*\)'[^']*$/\1/g" | sed 's/[^0-9A-Za-z.]//g'`
if [[ $VERSION = '' ]]
then
    # just use 'totara' if that didn't work
    VERSION='totara';
else
    VERSION="totara-$VERSION";
fi

# set default name for tar file
if [ -z $1 ]
then
    OUTFILE="../$VERSION.tar.gz"
else
    OUTFILE=$1
fi


tar -cz --transform="s|^./|./$VERSION/|g" -f $OUTFILE --exclude-from $IGNOREFILE .

rm -f $IGNOREFILE

echo 'Output saved to '$OUTFILE



