#!/bin/sh

# This accepts two arguments
# 1/ The base url of the site being tested (including trailing slash)
# 2/ The cucumber test profile (see cucumber.yml)

echo "STEP 1: Generate some test users"
php -f build/generate-users.php

echo "STEP 2: Run simpletests";
python build/simpletests.py $1

echo "Convert to Junit XML";
xsltproc build/simpletest_to_junit.xsl build/logs/simpletest-results.xml > build/logs/xml/TEST-suite.xml

echo "STEP 3: Run cucumber tests (disabled link checker tests)";
cucumber -p $2 --format junit --out build/logs/xml/

if [ $2 = 'pgsql' ]
then
    echo "STEP 4: Generate database performance report"
    mkdir -p build/logs/perf
    cd build/logs/perf
    # only process log info from the nightly database
    sudo pgfouine -database t1-hudsontesting-nightly -file /var/log/postgresql/postgres.log -top 40 -report queries.html=overall,bytype,slowest,n-mosttime,n-mostfrequent,n-slowestaverage -report hourly.html=overall,hourly -report errors.html=overall,n-mostfrequenterrors -format html-with-graphs
    cd -
fi

echo "STEP 5: Run link checker script as a learner";
php build/link_checker $1 learner 'passworD1!'


