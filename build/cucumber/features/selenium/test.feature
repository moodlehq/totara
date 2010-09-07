Feature: Test
  Scenario: Testing Google

  Given I am at Google.com
  When I search for "cucumber"
  Then I should see a link to "Google"
