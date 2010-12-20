@wip
@nightly
Feature: Check for broken links, PHP errors and missing language strings
    In order to avoid exposing errors
    As a developer
    I want to check that every page a user can access is error-free

  @link-checker
  Scenario: Check pages as a learner
    Given I am logged in as a learner
    Then check links for errors starting on the home page

  @link-checker
  Scenario: Check pages as admin
    Given I am logged in as admin
    Then check links for errors starting on the home page

