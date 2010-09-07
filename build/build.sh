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

echo "Run simpletests";
python build/simpletests.py

echo "Convert to Junit XML";
nice xsltproc build/simpletest_to_junit.xsl build/logs/simpletest-results.xml > build/logs/xml/TEST-suite.xml

echo "Count lines of code";
nice sloccount --wide --details . > build/logs/sloccount.sc

# echo "Run pDepend";
# TOO CPU/MEMORY INTENSIVE
# pdepend --jdepend-xml=build/logs/jdepend.xml .

#echo "Run phpDoc";
#nice phpdoc -t build/docs/ --directory local/ -ti 'Test Job Docs' --parseprivate on --undocumentedelements on --output HTML:Smarty:PHP

# echo "Run phpcpd";
# nice phpcpd --log-pmd=build/logs/pmd.xml .

#echo "Run phpcs";
#nice phpcs --report=checkstyle . > build/logs/checkstyle.xml
