Feature: Manage Organisation Frameworks
  In order to maintain the site organisation frameworks
  As an administrator
  I want to be able to add, edit and delete organisation frameworks

  @store_org_framework
  Scenario: No organisation frameworks
    Given there are no organisation framework records
      And I am logged in as admin
      And I am on the manage organisations page
    Then I should see "No organisation frameworks available"
      And I should not see "Test Organisation Framework"

  @store_org_framework
  Scenario: Display the frameworks
    Given there are 4 organisation framework records
      And I am logged in as admin
      And I am on the manage organisations page
    Then I should see "Test Organisation Framework" 4 times within the edit organisation frameworks table

  @store_org_framework
  Scenario: Check editing options
    Given there are 4 organisation framework records
      And I am logged in as admin
      And I am on the manage organisations page with editing on
    Then I should see "up.gif" 3 times within the edit organisation frameworks table
      And I should see "down.gif" 3 times within the edit organisation frameworks table
      And I should see "delete.gif" 4 times within the edit organisation frameworks table
      And I should see "edit.gif" 4 times within the edit organisation frameworks table
      And I should see "hide.gif" 4 times within the edit organisation frameworks table
      And I should see "Edit"

# example of a scenario outline
# see: http://wiki.github.com/aslakhellesoy/cucumber/scenario-outlines
  @store_org_framework
  Scenario Outline: Check wide range of editing options
    Given there are <frameworks> organisation framework records
      And I am logged in as admin
      And I am on the manage organisations page with editing on
    Then I should see "up.gif" <up> times within the edit organisation frameworks table
      And I should see "down.gif" <down> times within the edit organisation frameworks table
      And I should see "delete.gif" <delete> times within the edit organisation frameworks table
  Examples:
    |frameworks|up|down|delete|
    | 1        |0 | 0  | 1    |
    | 2        |1 | 1  | 2    |
    | 3        |2 | 2  | 3    |
    | 4        |3 | 3  | 4    |

  @store_org_framework
  Scenario: Add a new organisation framework
    Given I am logged in as admin
      And I am on the add organisation framework page
      And I fill in "fullname" with "My organisation fullname"
      And I press "Save changes"
    Then I should be on manage organisations page
      And I should see "My organisation fullname"

# example of a multi-line step using tables
# see: http://wiki.github.com/aslakhellesoy/cucumber/multiline-step-arguments
  @store_org_framework
  Scenario: Delete a organisation framework
    Given the organisation framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test    | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage organisations page with editing on
      And I delete the 2nd organisation framework
    Then the edit organisation frameworks table should match:
|Name|
| New Framework 1 |
| New Framework 3 |


# Requires webrat patch (use one from 2nd comment):
# https://webrat.lighthouseapp.com/projects/10503/tickets/384-webrat-does-not-pass-empty-form-fields-correctly-to-mechanize

  @store_org_framework
  Scenario: Fail to create a framework without required fields
    Given there are no organisation framework records
      And I am logged in as admin
      And I am on the add organisation framework page
      And I press "Save changes"
    Then I should see "Missing organisation framework name"
      And there should be 0 organisation framework records

  @store_org_framework
  Scenario: Edit a organisation framework
    Given there are 1 organisation framework records
      And I am logged in as admin
      And I am on the manage organisations page with editing on
      And I edit the 1st edit organisation frameworks table entry
      And I fill in "fullname" with "My organisation changed"
      And I press "Save changes"
    Then I should be on manage organisations page
      And I should see "My organisation changed"

  @store_org_framework
  Scenario: Hide a organisation framework
    Given there are 1 organisation framework records
      And I am logged in as admin
      And I am on the manage organisations page with editing on
      And I hide the 1st edit organisation frameworks table entry
    Then I should see "show.gif" within the edit organisation frameworks table

  @store_org_framework
  Scenario: Reordering by moving up a organisation framework
    Given the organisation framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test 1  | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage organisations page with editing on
      And I Move up the 2nd edit organisation frameworks table entry
    Then the edit organisation frameworks table should match:
|Name|
| New Framework 2 |
| New Framework 1 |
| New Framework 3 |


  @store_org_framework
  Scenario: Reordering by moving down a organisation framework
    Given the organisation framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test 1  | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage organisations page with editing on
      And I Move down the 2nd edit organisation frameworks table entry
    Then the edit organisation frameworks table should match:
|Name|
| New Framework 1 |
| New Framework 3 |
| New Framework 2 |


# Requires to patch webrat, query params on get method are written incorrectly.
# this similar to fix below, convert array of hashmap to just hashmaps
# https://webrat.lighthouseapp.com/projects/10503/tickets/380-fix-for-query-string-building-when-using-mechanize-adapter
  @store_org_framework
  @store_org_type
  Scenario: Add a organisation type
    Given I am logged in as admin
      And I am on the manage organisation types page
      And I press "Add a new type"
      And I fill in "fullname" with "My organisation type fullname"
      And I press "Save changes"
  Then I should see "My organisation type fullname"


  @store_org_framework
  @store_org_type
  Scenario: Add a organisation type with incomplete data, gives validation message
    Given there are no organisation type records
      And I am logged in as admin
      And I am on the manage organisation types page
      And I press "Add a new type"
      And I press "Save changes"
  Then I should see "Missing organisation type name"
      And there should be 0 organisation type records
