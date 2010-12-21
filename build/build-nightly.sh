#!/bin/sh

# This accepts a single argument, which is the base url of the site being tested (including trailing slash)

echo "STEP 1: Run simpletests";
python build/simpletests.py $1

echo "Convert to Junit XML";
xsltproc build/simpletest_to_junit.xsl build/logs/simpletest-results.xml > build/logs/xml/TEST-suite.xml

echo "STEP 2: Run cucumber tests (disabled link checker tests)";
cucumber --format junit --out build/logs/xml/
