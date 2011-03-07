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
echo '/build*
./.git*
./tags
./TAGS
*.swp
*~
./config.php
./cucumber.yml
./webrat*
' > $IGNOREFILE

# set default name for tar file
if [ -z $1 ]
then
    OUTFILE='../out.tar.gz'
else
    OUTFILE=$1
fi

tar -cz -f $OUTFILE --exclude-from $IGNOREFILE .

rm -f $IGNOREFILE

echo 'Output saved to '$OUTFILE



