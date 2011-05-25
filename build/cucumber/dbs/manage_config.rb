require 'fileutils'

def parse_config

  out = Hash.new

  config = File.open(File.dirname(__FILE__) + "/../../../config.php", 'r')
  dbuser = Regexp.new("^\\$[A-Z]+->dbuser\s+=\s'(.+)'")
  dbloc =  Regexp.new("^\\$[A-Z]+->dbhost\s+=\s'(.*)'")
  dbname = Regexp.new("^\\$[A-Z]+->dbname\s+=\s'(.+)'")
  dbpass = Regexp.new("^\\$[A-Z]+->dbpass\s+=\s'(.*)'")
  dbsite = Regexp.new("^\\$[A-Z]+->wwwroot\s+=\s'(.+)'")
  pref = Regexp.new("^\\$[A-Z]+->prefix\s+=\s'(.+)'")

  config.each do |line|
    if (user = dbuser.match(line))
      out['username'] = user[1].nil? ? '' : user[1]
    end
    if (location = dbloc.match(line))
      out['location'] = location[1].nil? ? '' : location[1]
    end
    if (database = dbname.match(line))
      out['name'] = database[1].nil? ? '' : database[1]
    end
    if (pass = dbpass.match(line))
      out['password'] = pass[1]
    end
    if (site = dbsite.match(line))
      out['site_url'] = site[1]
    end
    if (pre = pref.match(line))
      out['prefix'] = pre[1].nil? ? 'mdl_' : pre[1]
    end
  end

  # if dbhost matches postgres socket format, then extract info from
  # dbhost instead
  if out['location'].include?('user=') then
    dbstring = /user=\\'([^']+)\\' password=\\'([^']+)\\' dbname=\\'([^']+)\\/;
    if(res = dbstring.match(out['location']))
      out['username'] = res[1]
      out['password'] = res[2]
      out['name'] = res[3]
      out['location'] = ''
    end
  end
  out
end


