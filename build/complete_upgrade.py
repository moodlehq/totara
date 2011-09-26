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

    # Set max loop
    if count >= 20:
        print 'ERROR: Notifications page appears broken, aborting'
        break

    count += 1
    notif = mech.open(url)
    content = notif.read()

    next_url = None

    # Check for continue button
    if not next_url:
        exp = re.compile('<form action="([^"]+)" method="get"><div><input type="submit" value="Continue"')
        if exp.search(content):
            next_url = exp.search(content).group(1)
            print 'Pressing continue...'

    # Check for major upgrade
    if not next_url:
        exp = re.compile('Upgrading Totara database...')
        if exp.search(content):
            next_url = rooturl + 'admin/index.php?confirmupgrade=1&confirmrelease=1&confirmplugincheck=1'
            print 'Confirming upgrade...'

    # Check for Save Changes button (means we are on the upgradesettings.php page)
    if not next_url:
        exp = re.compile('<input class="form-submit" type="submit" value="Save Changes"')
        if exp.search(content):
            mech.select_form(nr=3)
            mech.submit()
            next_url = rooturl + 'admin/index.php'
            print 'Saving new settings...'

    if not next_url:
        break

    url = next_url

print '(done %d times)' % count
