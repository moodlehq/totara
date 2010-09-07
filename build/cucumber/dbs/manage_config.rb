require 'fileutils'

def parse_config

  out = Hash.new

  config = File.open(File.dirname(__FILE__) + "/../../../config.php", 'r')
  dbuser = Regexp.new('^\$[A-Z]+->dbuser\s+=\s\'(.+)\'');
  dbloc =  Regexp.new('^\$[A-Z]+->dbhost\s+=\s\'(.*)\'');
  dbname = Regexp.new('^\$[A-Z]+->dbname\s+=\s\'(.+)\'');
  dbpass = Regexp.new('^\$[A-Z]+->dbpass\s+=\s\'(.*)\'');
  dbsite = Regexp.new('^\$[A-Z]+->wwwroot\s+=\s\'(.+)\'');
  pref = Regexp.new('^\$[A-Z]+->prefix\s+=\s\'(.+)\'');

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

  out
end

# save old config and create new one using dbname as
# dbtype parameter
def load_config(dbname)
  # save original config.php
  @orig_config = File.dirname(__FILE__) + "/../../../config.php"
  @old_config = @orig_config + ".old"
  FileUtils.mv @orig_config, @old_config

  File.open(@orig_config,'w+') do |newfile|
    File.open(@old_config) do |oldfile|
      oldfile.each do |line|
        newfile.puts line.gsub(/\s*\$CFG\->dbtype.*$/i, "$CFG->dbtype    = \'#{dbname}\';")
      end
    end
  end
end

# restore the original config.php
def restore_config
  @orig_config = File.dirname(__FILE__) + "/../../../config.php"
  @old_config = @orig_config + ".old"
  FileUtils.mv @old_config, @orig_config
end

