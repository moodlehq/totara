Feature: Login
  In order to view my record of learning
  As an administrator
  I want to be able to see the page

  Scenario: View the record of learning page
    Given I am logged in as admin
    And I am on the my records page
    Then I should see "Record of Learning"
    And I should see "Admin User"

  Scenario: View a learner's record of learning page
    Given I am logged in as admin
    And I am on a learners my records page
    Then I should see "Record of Learning for Reginald Hulsman"
