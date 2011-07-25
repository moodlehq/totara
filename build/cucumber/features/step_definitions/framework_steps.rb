
Given /^there is a competency scale$/ do
  Given "there is 1 competency scale record"
    And "there are 3 competency scale value records"
end

Given /^there is a complete competency scale$/ do
  Given "the competency scale table contains:", table(%{
    |name|
    |Complete Competency Scale|
})
  newscaleid = get_scale_id('Complete Competency Scale')
  And "the competency scale value table contains:", table(%{
    |scaleid|
    |#{newscaleid}|
    |#{newscaleid}|
    |#{newscaleid}|
})
end

Given /^there is a (\w+) framework and (\d+) depth$/ do |framework_type, no_depth|

  Given "there are 1 #{framework_type} framework record with #{no_depth} #{framework_type} depth each"

end

Given /^I add an (\w+)$/ do |framework_type|
  Given "I add a #{framework_type} with parent \"Top\""
end

Given /^I add a (\w+) with parent "([^"]*)"$/ do |framework_type, parent_name|
  Given "I press \"Add new #{framework_type}\""
  Given "I fill in \"fullname\" with \"My #{framework_type} fullname\""
  Given "I press \"Save changes\""
end
