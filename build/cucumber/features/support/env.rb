# RSpec
require 'rspec/expectations'

# Webrat
require 'webrat'

# Tableish for manipulating HTML tables
# # Requires cucumber-rails gem
require 'cucumber/web/tableish'

# Lengthen timeout
require 'net/http'

# config.php management
require File.dirname(__FILE__) + '/../../dbs/manage_config.rb'
# cross-db database code
require File.dirname(__FILE__) + '/../../dbs/generic.rb'
# record templates
require File.dirname(__FILE__) + '/record_templates.rb'

require 'test/unit/assertions'
World(Test::Unit::Assertions)

# Helper method for running shell commands
def run(command, verbose = false, message = nil)
  if verbose then
    puts "#{message}"
    puts command
    result = `#{command}`
    puts result
    return result
  else
    `#{command}`
  end
end

# Lengthen timeout in Net::HTTP
module Net
    class HTTP
        alias old_initialize initialize

        def initialize(*args)
            old_initialize(*args)
            @read_timeout = 3*60     # 3 minutes
        end
    end
end

params = parse_config
@@test_database_location = params['location']
@@test_database_name = params['name']
@@test_database_username = params['username']
@@test_database_password = params['password']
$site_url = params['site_url']
$prefix = params['prefix'];

module NavigationHelpers
  @@site_url = $site_url
  @@prefix = $prefix
end

