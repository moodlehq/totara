When /^I delete the (\d+)(?:st|nd|rd|th) (\w+) framework$/ do |number, frameworktype|
  within("table.edit#{frameworktype} tr:nth-child(#{number.to_i+1})") do
    click_link "Delete"
  end
  click_button "Yes"
  click_button "Continue"
end

# TODO not yet tested
When /^I (\w+) the (\d+)(?:st|nd|rd|th) (\w+) entry$/ do |action, number, cssname|
  within("#{get_selector(cssname)} tr:nth-child(#{number.to_i+1})") do
    click_link action
  end
end

