require 'spec/expectations'

# START HACK
# # Webrat's Selenium wrongly assumes Rails in available. # We'll just fool it...
module ActionController
  class IntegrationTest
  end
end

def silence_stream(*args)
  yield if block_given?
end
# END HACK

Webrat.configure do |config|
    config.mode = :selenium
    config.application_framework = :external
    config.selenium_server_address = '192.168.2.66'
end

World do
  session = Webrat::SeleniumSession.new
  session.extend(Webrat::Methods)
  session.extend(Webrat::Selenium::Methods)
  session.extend(Webrat::Selenium::Matchers)
  session
end

module Webrat
  def self.start_app_server
  end

  def self.stop_app_server
  end
end
