Feature: User Profile
  As a user
  I want to be able to manage my profile

  Scenario: View the user profile page
    Given I am logged in as admin
    And I am on the home page
    When I click "Admin User"
    Then I should see "Personal profile: Admin User"
