require File.expand_path(File.join(File.dirname(__FILE__), "..", "support", "paths"))

# Commonly used webrat steps
# http://github.com/brynary/webrat

Given /^Debug$/ do
  puts response_body
  filepath = '/tmp/webrat_debug.html'
  File.open(filepath, "w") do |file|
    file.puts response_body
  end
  raise "Debugged! Current URL: #{current_url}\nResponse saved: #{filepath}"
end

Given /^I am on(?: the)? (.+) page$/ do |page_name|    # assign the variable in second parenthesis to page_name
  visit get_path(page_name)
end

Given /^I am on(?: the)? (.+) page with editing on$/ do |page_name|
  url = get_path(page_name)
  if url.include? '?' then
    visit url+'&edit=on'
  else
    visit url+'?edit=on'
  end
end

# for checking pages that may contain 404 errors
Then /^visiting the (.+) page should show "(.+)"$/ do |page_name, message|
  begin
    visit get_path(page_name)
    assert_match /#{Regexp.escape message}/m, response_body
  rescue Mechanize::ResponseCodeError => ex
    assert_match /#{Regexp.escape message}/m, ex.page.parser.inner_html
  end
end

When /^I press "([^\"]*)"$/ do |button|
  click_button(button)
end

# ?: makes parenthesis group without saving the result (don't create a backreference)
When /^I follow|click(?: the)* "([^\"]*)"(?: link)*$/ do |link|
  click_link(link)
end

# debug version of above
#When /^DEBUG I follow|click(?: the)* "([^\"]*)"(?: link)*$/ do |link|
#  save_and_open_page
#  url=find_link(link)
#  Webrat.Logging.logger("URL : ",url,"\n")
#  click_link(link)
#  save_and_open_page
#end

# ?: makes parenthesis group without saving the result (don't create a backreference)
#When /^I follow|click(?: the)* "([^\"]*)"(?: link)* and save the page$/ do |link|
#  click_link(link)
#  filename = "/tmp/webrat-#{Time.now.to_i}.html"
#
#  File.open(filename, "w") do |f|
#    f.write response_body
#  end
#end

When /^I fill in "([^\"]*)" with "([^\"]*)"$/ do |field, value|
  fill_in(field, :with => value)
end

When /^I select "([^\"]*)" from "([^\"]*)"$/ do |value, field|
  select(value, :from => field)
end

# Use this step in conjunction with Rail's datetime_select helper. For example:
# When I select "December 25, 2008 10:00" as the date and time
When /^I select "([^\"]*)" as the date and time$/ do |time|
  select_datetime(time)
end

# Use this step when using multiple datetime_select helpers on a page or
# you want to specify which datetime to select. Given the following view:
#   <%= f.label :preferred %><br />
#   <%= f.datetime_select :preferred %>
#   <%= f.label :alternative %><br />
#   <%= f.datetime_select :alternative %>
# The following steps would fill out the form:
# When I select "November 23, 2004 11:20" as the "Preferred" date and time
# And I select "November 25, 2004 10:30" as the "Alternative" date and time
When /^I select "([^\"]*)" as the "([^\"]*)" date and time$/ do |datetime, datetime_label|
  select_datetime(datetime, :from => datetime_label)
end

# Use this step in conjunction with Rail's time_select helper. For example:
# When I select "2:20PM" as the time
# Note: Rail's default time helper provides 24-hour time-- not 12 hour time. Webrat
# will convert the 2:20PM to 14:20 and then select it.
When /^I select "([^\"]*)" as the time$/ do |time|
  select_time(time)
end

# Use this step when using multiple time_select helpers on a page or you want to
# specify the name of the time on the form.  For example:
# When I select "7:30AM" as the "Gym" time
When /^I select "([^\"]*)" as the "([^\"]*)" time$/ do |time, time_label|
  select_time(time, :from => time_label)
end

# Use this step in conjunction with Rail's date_select helper.  For example:
# When I select "February 20, 1981" as the date
When /^I select "([^\"]*)" as the date$/ do |date|
  select_date(date)
end

# Use this step when using multiple date_select helpers on one page or
# you want to specify the name of the date on the form. For example:
# When I select "April 26, 1982" as the "Date of Birth" date
When /^I select "([^\"]*)" as the "([^\"]*)" date$/ do |date, date_label|
  select_date(date, :from => date_label)
end

When /^I check "([^\"]*)"$/ do |field|
  check(field)
end

When /^I check by value "([^\"]*)"$/ do |value|
  xpath = "//input[@value='#{value}']"
  check(field_by_xpath(xpath))
end


When /^I uncheck "([^\"]*)"$/ do |field|
  uncheck(field)
end

When /^I choose "([^\"]*)"$/ do |field|
  choose(field)
end

When /^I attach the file at "([^\"]*)" to "([^\"]*)"$/ do |path, field|
  attach_file(field, path)
end

Then /^I should see "(.*)"$/ do |text|
  assert !!(response_body =~ /#{Regexp.escape text}/m)
end

Then /^I should see "(.*)" (\d+) times$/ do |text, number|
  assert_equal number, response_body.scan(/#{Regexp.escape text}/m).length.to_s
end

Then /^I should see "(.*)" within(?: the)? (.+)$/ do |text, cssname|
  within(get_selector(cssname)) do |content|
    assert !!(content.dom.inner_html =~ /#{Regexp.escape text}/m), content.dom.inner_html
  end
end

Then /^I should see "(.*)" (\d+) times within(?: the)? (.+)$/ do |text, number, cssname|
  within(get_selector(cssname)) do |content|
    assert_equal number, content.dom.inner_html.scan(/#{Regexp.escape text}/m).length.to_s
  end
end

Then /^I should not see "(.*)"$/ do |text|
  assert !!(response_body !~ /#{Regexp.escape text}/m)
end

Then /^I should not see "(.*)" within(?: the)? (.+)$/ do |text, cssname|
  within(get_selector(cssname)) do |content|
    assert !!(content.dom.inner_html !~ /#{Regexp.escape text}/m), content.dom.inner_html
  end
end

Then /^the "(.*)" checkbox should not be checked$/ do |label|
  assert !field_labeled(label).checked?
end

Then /^the "(.*)" checkbox should be checked$/ do |label|
  assert field_labeled(label).checked?
end

Then /^I should be redirected to "(.*)"$/ do |path|
  assert_template path
end

Then /^the "([^\"]*)" field should contain "([^\"]*)"$/ do |field, value|
  assert field_labeled(field).value =~ /#{value}/
end

Then /^the "([^\"]*)" field should not contain "([^\"]*)"$/ do |field, value|
  assert !(field_labeled(field).value =~ /#{value}/)
end

Then /^I should be on(?: the)? (.+) page$/ do |page_name|
  assert_equal get_path(page_name), current_url
end

Then /^show me the page$/ do
  save_and_open_page
end

Then /^check links for errors starting on(?: the)? (.+) page/ do |page_name|
  Given "the list of visited links is empty"
  url = get_path(page_name)
  # get links from the first page
  parse_page(url)

  while(@@links_todo.length > 0) do

    link = @@links_todo.shift

    parse_page link['url']

    check_page(link)

  end

  puts 'Finished visiting ' + @@links_visited.length.to_s + ' pages'
end

Given /^the list of visited links is empty$/ do
  @@links_todo = []
  @@links_visited = {}
end


def in_todo url
  @@links_todo.each do |link|
    return true if generalize(link['url']) == generalize(url)
  end
  return false
end


# Analyses a page that has previously been parsed by parse_page
#
# Gets information about the page from the argument (a link hash)
# and information about the page that contained it from @@links_visited
#
# Looks for problems with the page:
# - 404 or other http errors
# - missing language strings (by looking for [[string]] in html)
# - moodle error boxes (by searching for the .errorbox class
#
# Doesn't search for PHP warnings or notices or moodle debug messages
# as these should appear in the error log
#
def check_page(link)
  url = link['url']
  referrer = link['referrer']

  if @@links_visited.key?(generalize(url)) then
    html = @@links_visited[generalize(url)]['html']
    parsed = @@links_visited[generalize(url)]['parsed']
    code = @@links_visited[generalize(url)]['code']
  else
    html = parsed = code = nil
  end

  # did the page return a 404 or other http error code?
  if code == 'bad' then
    puts 'ERROR 404: '
    puts '     FROM: ' + referrer
    puts '       TO: ' + url
    puts
  end

  # find missing language strings
  html.scan(/\[\[([^\]]+)\]\]/) do |match|
    puts 'MISSING LANG STRING: "' + match[0] + '"'
    puts '    IN PAGE: ' + url
  end

  html.scan(/call to debugging()/) do |match|
    puts 'SQL ERROR'
    puts '    IN PAGE: ' + url
  end

  # find error boxes
  errors = parsed.css('.errorbox').map do |error|
    if error.css('.errormessage').text != '' then
      errstr = error.css('.errormessage').text
    else
      errstr = error.text
    end
    puts 'ERROR BOX: ' + errstr
    puts '     FROM: ' + referrer
    puts '       TO: ' + url
    puts
  end
end

# Parse a URL, extracting the page contents and any links
#
# Page details are saved to @@links_visited (hash using the url as a key)
# Saves the raw html, a parsed object, and the response code
#
# Any URLs that are found and added to the end of @@links_todo, as long
# as they aren't:
#  - already on the todo
#  - previously visited
#  - anchor links
#  - external to site
#  - in the ignore list
# The URL and the page that linked to it (referrer) are stored
#
# This method also deletes this item from the todo list
def parse_page url
  require 'uri'
  @@site_url = get_site_url
  # ignore URLs starting with:
  @@ignore = [
    '/login/logout.php',
    '/calendar/view.php',
    '/blocks/facetoface/calendar.php',
    # problem pages:
    # won't work for local lookup
    '/iplookup/index.php',
  ]


  # visit the page
  begin
    visit url
    code = 'ok'
  rescue Mechanize::ResponseCodeError => ex
    error_response_body = ex.page.parser.inner_html
    code = 'bad'
  html = response_body || error_response_body
  end

  # parse the page
  html = (code == 'ok') ? response_body : error_response_body
  doc = Nokogiri::HTML.parse(html)

  # save page info
  @@links_visited[generalize(url)] = {
    'html' => html,
    'parsed' => doc,
    'code' => code,
  }

  # record that this page has been analysed
  @@links_todo.delete(url) if @@links_todo.include?(url)

  # find all links within the page
  links = doc.css('a').map { |link| link['href'] }
  links.each do |link|
    next if link.nil?
    link.strip!
    # add root to relative paths
    if link =~ /^[\/.]/ then
      urlobj = URI.parse url
      link = (urlobj + link).to_s
    end

    if link =~ /[^=]192\.168\.[0-9]+\.[0-9]+/ then
      # print error url link
      puts 'Error local URL found:'
      puts link
      next
    end
    # skip anchor links
    next if link =~ /^#/
    # skip external links
    next if link[0..@@site_url.length - 1] != @@site_url
    # skip already visited links
    next if @@links_visited.include?(generalize(link))
    # skip if already in todo
    next if in_todo link
    # skip urls the match start of ignore list
    matchbad = false
    @@ignore.each do |badlink|
      badlink = @@site_url + badlink
      matchbad = true if link[0..badlink.length - 1] == badlink
    end
    next if matchbad

    @@links_todo << {
      'url' => link,
      'referrer' => url,
    }

  end
end

def generalize(url)
  require 'uri'
  require 'cgi'

  return '' if url.nil?
  url.gsub!(/ /, '%20')
  parsed = URI.parse(url)
  return url if parsed.query.nil?
  params = CGI.parse(parsed.query)

  query = ''
  params.sort.each do |key, values|
    # can be multiple values for same key if element used more than once
    values.each do |value|
      value.gsub!(/ /, '%20')
      if(key == 'ssort')
        value = 'X'
      end

      # don't add & the first time
      query << '&' unless query == ''
      value = 'X' if is_int? value
      query << key + '=' + value
    end
  end
  parsed.query = query

  parsed.to_s
end

# true if str is an integer
def is_int? str
  result = /^[0-9]+$/.match(str)
  return !result.nil?
end



When /^I press "([^\"]*)" and save the page$/ do |button|
  begin
    click_button(button)
  rescue Mechanize::ResponseCodeError => ex
    error_response_body = ex.page.parser.inner_html

  end
  filename = "/tmp/webrat-#{Time.now.to_i}.html"

  File.open(filename, "w") do |f|
    f.write response_body
  end

end
