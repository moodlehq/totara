Feature: Manage Competency Frameworks
  In order to maintain the site competencies
  As an administrator
  I want to be able to add, edit and delete competency frameworks

  @store_comp_framework
  Scenario: No competency frameworks
    Given there are no competency framework records
      And I am logged in as admin
      And I am on the manage competency frameworks page
    Then I should see "No competency frameworks defined"
      And I should not see "Test Competency Framework"

  @store_comp_framework
  Scenario: Display the frameworks
    Given there are 4 competency framework records
      And I am logged in as admin
      And I am on the manage competency frameworks page
    Then I should see "Test Competency Framework" 4 times within the edit competency frameworks table

  @store_comp_framework
  Scenario: Check editing options
    Given there are 4 competency framework records
      And I am logged in as admin
      And I am on the manage competency frameworks page with editing on
    Then I should see "up.gif" 3 times within the edit competency frameworks table
      And I should see "down.gif" 3 times within the edit competency frameworks table
      And I should see "delete.gif" 4 times within the edit competency frameworks table
      And I should see "edit.gif" 4 times within the edit competency frameworks table
      And I should see "hide.gif" 4 times within the edit competency frameworks table
      And I should see "Edit"

# example of a scenario outline
# see: http://wiki.github.com/aslakhellesoy/cucumber/scenario-outlines
  @store_comp_framework
  Scenario Outline: Check wide range of editing options
    Given there are <frameworks> competency framework records
      And I am logged in as admin
      And I am on the manage competency frameworks page with editing on
    Then I should see "up.gif" <up> times within the edit competency frameworks table
      And I should see "down.gif" <down> times within the edit competency frameworks table
      And I should see "delete.gif" <delete> times within the edit competency frameworks table
  Examples:
    |frameworks|up|down|delete|
    | 1        |0 | 0  | 1    |
    | 2        |1 | 1  | 2    |
    | 3        |2 | 2  | 3    |
    | 4        |3 | 3  | 4    |

# TODO figure out how to check zero frameworks as table doesn't exist at all

  @store_comp_framework
  Scenario: Add a new competency framework
    Given I am logged in as admin
      And I am on the add competency framework page
      And I fill in "fullname" with "My competency fullname"
      And I fill in "shortname" with "My shortname"
      And I press "Save changes"
    Then I should be on manage competency frameworks page
      And I should see "My competency fullname"

# example of a multi-line step using tables
# see: http://wiki.github.com/aslakhellesoy/cucumber/multiline-step-arguments
  @store_comp_framework
  Scenario: Delete a competency framework
    Given the competency framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test    | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage competency frameworks page with editing on
      And I delete the 2nd framework
    Then the edit competency frameworks table should match:
|Name|
| New Framework 1 |
| New Framework 3 |

# Requires webrat patch (use one from 2nd comment):
# https://webrat.lighthouseapp.com/projects/10503/tickets/384-webrat-does-not-pass-empty-form-fields-correctly-to-mechanize
  @store_comp_framework
  Scenario: Fail to create a framework without required fields
    Given there are no competency framework records
      And I am logged in as admin
      And I am on the add competency framework page
      And I press "Save changes"
    Then I should see "Missing framework full name"
      And I should see "Missing framework short name"
      And there should be 0 competency framework records

