#!/bin/sh

# Notes on setting up machine this runs on
#
# Apache needs a vserver set up to point to the hudson workspace,
# for selenium to use for testing
#
# First, you need to create a second firefox profile, named "selenium"
# (firefox will on run in one instance per profile)
#
# As the user hudson, you need to turn on xvfb and set it up:
# Xvfb :99 -ac &
# export DISPLAY=:99
#
# In the Hudson selenium config, you then need to load the browser as so:
#

echo "STEP 1: Run simpletests";
python build/simpletests.py

echo "Convert to Junit XML";
xsltproc build/simpletest_to_junit.xsl build/logs/simpletest-results.xml > build/logs/xml/TEST-suite.xml

echo "STEP 2: Run cucumber tests";
cucumber --format junit --out build/logs/xml/

echo "STEP 3: Run language string tests";
php -f build/checklang.php . local idp hierarchy guides customfield

echo "STEP 4: Run help button tests";
php -f build/checkhelp.php . local idp hierarchy guides customfield

# too slow
#echo "Count lines of code";
#sloccount --wide --details . > build/logs/sloccount.sc

# echo "Run pDepend";
# TOO CPU/MEMORY INTENSIVE
# pdepend --jdepend-xml=build/logs/jdepend.xml .

# echo "Run phpcpd";
# nice phpcpd --log-pmd=build/logs/pmd.xml .

#echo "Run phpcs";
#nice phpcs --report=checkstyle . > build/logs/checkstyle.xml
