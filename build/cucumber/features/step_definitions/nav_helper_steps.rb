When /^I delete the (\d+)(?:st|nd|rd|th) (\w+) framework$/ do |number, frameworktype|
  within("table.edit#{frameworktype} tr:nth-child(#{number.to_i+1})") do
    click_link "Delete"
  end
  click_button "Yes"
end

When /^I ([\w\s]+) the (\d+)(?:st|nd|rd|th) ([\w\s]+) entry$/ do |action, number, cssname|
  within("#{get_selector(cssname)} tr:nth-child(#{number.to_i+1})") do
    click_link "#{action}"
  end
#filename = "/tmp/webrat-#{Time.now.to_i}.html"

#      File.open(filename, "w") do |f|
#        f.write response_body
#      end
end

When /^I ([\w\s]+) the (\d+)(?:st|nd|rd|th) ([\w\s]+) entry and confirm$/ do |action, number, cssname|
  within("#{get_selector(cssname)} tr:nth-child(#{number.to_i+1})") do
    click_link "#{action}"
  end
  click_button "Yes"
  click_button "Continue" if (response_body =~ /input type="submit" value="Continue"/)
end
