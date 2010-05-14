#!/bin/sh

echo "Drop old database mdl19-hudsontesting";
dropdb mdl19-hudsontesting

echo "Create new database mdl19-hudsontesting";
createdb -O hudson mdl19-hudsontesting

echo "Restore baseline.pgdump";
pg_restore -Fc -O -U hudson -w -d mdl19-hudsontesting build/baseline.pgdump

echo "Delete old moodledata";
rm -Rf ../moodledata/

echo "Re-create moodledata";
mkdir ../moodledata
chmod 777 ../moodledata

echo "Reset apache logs";
rm ../moodle_error.log
touch ../moodle_error.log
chmod 777 ../moodle_error.log

echo "Copy config.php into workspace";
cp build/config.php config.php

echo "Run simpletests";
wget -O build/logs/simpletest-results.xml http://hudson.spastk.wgtn.cat-it.co.nz/admin/report/unittest/xml.php

echo "Convert to Junit XML";
xsltproc build/simpletest_to_junit.xsl build/logs/simpletest-results.xml > build/logs/TEST-suite.xml

echo "Count lines off code";
sloccount --wide --details . > build/logs/sloccount.sc
