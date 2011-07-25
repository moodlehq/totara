Feature: Login
  In order to use Totara
  As an administrator
  I want access to Totara features to require a login

  Scenario: View the login page
    Given I am on the login page
    Then I should see "Returning to this web site?"

  Scenario: Login with default admin password
    Given I am on the login page
    When I fill in "username" with "admin"
      And I fill in "password" with "passworD1!"
      And I press "Login"
    Then I should see "You are logged in as"
    And I should see "Admin User"

  Scenario: Login with default admin password
    Given I am logged in as admin
    Then I should see "You are logged in as"

  Scenario: Logout
    Given I am logged in as admin
      When I click "Logout"
    Then I should see "You are not logged in"

  Scenario: Not logged in
    Given I am not logged in
      And I am on the home page
    Then I should see "You are not logged in"

  Scenario: Login as learner
    Given I am logged in as a learner
      And I am on the home page
    Then I should see "You are logged in as"
      And I should see "Reginald Hulsman"

  Scenario: View protected page with permission
    Given I am logged in as admin
    Then visiting the manage competencies page should show "Competency Frameworks"

  Scenario: View protected page without permission
    Given I am logged in as a learner
    Then visiting the manage competencies page should show "Access denied"

