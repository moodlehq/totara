Given /^there are no (.+) records$/ do |name|
  delete_all_records get_table(name)
end

Given /^there (?:is|are) (\d+) (.+) records? with (\d+) (.+) each$/ do |number, name, numberchild, namechild|
  Given "there are no #{name} records"
  Given "there are no #{namechild} records"
  1.upto(number.to_i) do |count|
    And "there is a #{name} record numbered #{count}"
    1.upto(numberchild.to_i) do |countchild|
      And "there is a #{namechild} record numbered #{countchild}"
    end
  end
  Then "there should be #{number} #{name} records"
  total = numberchild.to_i * number.to_i
  Then "there should be #{total} #{namechild} records"
end

Given /^there (?:is|are) (\d+) (.+) records?$/ do |number, name|
  Given "there are no #{name} records"
  1.upto(number.to_i) do |count|
    And "there is a #{name} record numbered #{count}"
  end
  Then "there should be #{number} #{name} records"
end

Given /^the (.+) table contains:/ do |name, contents|
  Given "there are no #{name} records"
  contents.hashes.each do |hash|
    # use the default object, and override with any data provided
    default = get_record_object get_table(name)
    record = default.merge(hash)
    insert_record get_table(name), record
  end
end

Given /^there is a (.+) record(?: numbered (\d+))?$/ do |name, number|
  if number.nil? then
    add_record get_table(name)
  else
    add_record get_table(name), number
  end
end

Then /^there should be (\d+) (.+) records$/ do |number, name|
   assert_equal number, count_records(get_table(name)).to_s
end

Then /^(?:the )(.+) should match:/ do |cssname, table|
  selector = get_selector(cssname)
  table.diff!(tableish("#{selector} tr", 'td,th'))
end
