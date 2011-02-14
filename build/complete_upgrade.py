# Run simpletests as an admin
import mechanize, sys, re

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

print 'Hit notifications page'
url = rooturl+'admin/index.php'
count = 0
while 1:
    count += 1
    notif = mech.open(url)
    content = notif.read()

    exp = re.compile('<form action="([^"]+)" method="get"><div><input type="submit" value="Continue"')
    continue_btn = exp.search(content)

    if not continue_btn:
        break

    url = continue_btn.group(1)

print '(done %d times)' % count
