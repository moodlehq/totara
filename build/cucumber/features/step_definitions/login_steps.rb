When /I am logged in as "(.*)" with password "(.*)"/ do |username, password|
  @@site_url = get_site_url
  visit @@site_url+"/login/index.php",
      :post,
      {:username => username, :password => password}
end

When /I am not logged in/ do
  Then "I am on the login page"
  And "I should not see \"You are logged in as\""
end

When /I am logged in as (?:an )?admin/ do
  Then "I am logged in as \"admin\" with password \"passworD1!\""
end

When /I am logged in as (?:a )?learner/ do
  Then "I am logged in as \"learner\" with password \"passworD1!\""
end

When /I am logged in as (?:a )?trainer/ do
  Then "I am logged in as \"trainer\" with password \"passworD1!\""
end

When /I am logged in as (?:a )?manager/ do
  Then "I am logged in as \"manager\" with password \"passworD1!\""
end

