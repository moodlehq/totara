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

echo "STEP 1: Run Cucumber Link checker tests";
cucumber --tags @nightly --format junit --out build/logs/xml/

# too slow
echo "STEP 2: Count lines of code";
sloccount --wide --details . > build/logs/sloccount.sc

# echo "Run pDepend";
# TOO CPU/MEMORY INTENSIVE
# pdepend --jdepend-xml=build/logs/jdepend.xml .

#echo "STEP 3: Run phpcpd";
#nice phpcpd --log-pmd=build/logs/pmd.xml .

#echo "STEP 4: Run phpcs";
#nice phpcs --report=checkstyle . > build/logs/checkstyle.xml
