require 'rspec/expectations'

Webrat.configure do |config|
  config.mode = :mechanize
end

World do
  session = Webrat::Session.new
  session.extend(Webrat::Methods)
  session.extend(Webrat::Matchers)
  session
end
