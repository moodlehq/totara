
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
