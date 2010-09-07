# Run simpletests

import mechanize

print 'Open login page'
rooturl = 'http://brumbies.wgtn.cat-it.co.nz/totara-hudson/'
mech = mechanize.Browser()
mech.open(rooturl+'login/index.php')

print 'Login as admin'
mech.select_form(nr=1)
mech["username"] = "admin"
mech["password"] = "passworD1!"
mech.submit()

print 'Run unit tests'
tests = mech.open(rooturl+'admin/report/unittest/xml.php')
results = tests.read()

print 'Write to file'
f = file('build/logs/simpletest-results.xml', 'w')
f.write(results) # write to a test file
f.close()
