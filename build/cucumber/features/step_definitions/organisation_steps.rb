Given /^there is a organisation framework and (\d+) depth$/ do |no_depth|

  Given "there are 1 organisation framework record with #{no_depth} organisation depth each"

end

Given /^I add an organisation$/ do
  Given "I add an organisation with parent \"Top\""
end

Given /^I add an organisation with parent "([^"]*)"$/ do |parent_name|
  Given "I press \"Add new organisation\""
  Given "I fill in \"fullname\" with \"My organisation fullname\""
  Given "I fill in \"shortname\" with \"My shortname\""
  Given "I press \"Save changes\""
  Given "I press \"Return to organisation framework\""
end
