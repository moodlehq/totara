# Run simpletests as an admin
import mechanize, sys

# Get base url from arguments
if len(sys.argv) != 2:
    print 'Incorrect number of arguments, expects one'
    sys.exit(2)

rooturl = sys.argv[1]

# Run tests
print 'Root url: %s' % rooturl

print 'Open login page'
mech = mechanize.Browser()
mech.open(rooturl+'login/index.php')

print 'Login as admin'
mech.select_form(nr=1)
mech["username"] = "admin"
mech["password"] = "passworD1!"
mech.submit()

print 'Run unit tests and write to file'
mech.retrieve(rooturl+'admin/report/unittest/xml.php', 'build/logs/simpletest-results.xml')
