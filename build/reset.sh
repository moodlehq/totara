#!/bin/sh

# .git/hooks/post-checkout must by symbolicly linked to this file

echo "Drop old database mdl19-hudsontesting";
dropdb mdl19-hudsontesting

echo "Create new database mdl19-hudsontesting";
createdb -O hudson mdl19-hudsontesting

echo "Restore baseline.pgdump";
nice pg_restore -Fc -O -U hudson -w -d mdl19-hudsontesting build/baseline.pgdump

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
