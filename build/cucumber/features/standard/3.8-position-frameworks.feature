# Some tests require webrat patch (use one from 2nd comment):
# https://webrat.lighthouseapp.com/projects/10503/tickets/384-webrat-does-not-pass-empty-form-fields-correctly-to-mechanize

# 3.8, page 91
Feature: Manage position Frameworks
  In order to maintain the site position frameworks
  As an administrator
  I want to be able to add, edit and delete position frameworks

  # new, doc doesn't have an entry for this.
  @store_pos_framework
  Scenario: No position frameworks
    Given there are no position framework records
      And I am logged in as admin
      And I am on the manage positions page
    Then I should see "No position frameworks available"
      And I should see "Add new position framework"
      And I should not see "Test Position Framework"

  # new, doc doesn't have an entry for this.
  @store_pos_framework
  Scenario: Display the frameworks
    Given there are 4 position framework records
      And I am logged in as admin
      And I am on the manage positions page
    Then I should see "Test Position Framework" 4 times within the edit position frameworks table

  # new, doc doesn't have an entry for this.
  @store_pos_framework
  Scenario: Check editing options
    Given there are 4 position framework records
      And I am logged in as admin
      And I am on the manage positions page with editing on
    Then I should see "up.gif" 3 times within the edit position frameworks table
      And I should see "down.gif" 3 times within the edit position frameworks table
      And I should see "delete.gif" 4 times within the edit position frameworks table
      And I should see "edit.gif" 4 times within the edit position frameworks table
      And I should see "hide.gif" 4 times within the edit position frameworks table
      And I should see "Edit"

  # 3.8.1, page 92
  @store_pos_framework
  Scenario: Add a new position framework
    Given I am logged in as admin
      And I am on the add position framework page
      And I fill in "fullname" with "My position fullname"
      And I press "Save changes"
    Then I should be on manage positions page
      And I should see "My position fullname"

  # 3.8.2 page 92
  @store_pos_framework
  Scenario: Edit a position framework
    Given there are 1 position framework records
      And I am logged in as admin
      And I am on the manage positions page with editing on
      And I edit the 1st edit position frameworks table entry
      And I fill in "fullname" with "My position changed"
      And I press "Save changes"
    Then I should be on manage positions page
      And I should see "My position changed"

# example of a multi-line step using tables
# see: http://wiki.github.com/aslakhellesoy/cucumber/multiline-step-arguments
  # 3.8.3, page 94
  @store_pos_framework
  Scenario: Delete a position framework
    Given the position framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test    | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage positions page with editing on
      And I delete the 2nd position framework
    Then the edit position frameworks table should match:
|Name|
| New Framework 1 |
| New Framework 3 |

  # new, doc doesn't have an entry for this.
  # Test required fields
  @store_pos_framework
  Scenario: Fail to create a framework without required fields
    Given there are no position framework records
      And I am logged in as admin
      And I am on the add position framework page
      And I press "Save changes"
    Then I should see "Missing position framework name"
      And there should be 0 position framework records

  @store_pos_framework
  Scenario: Hide a position framework
    Given there are 1 position framework records
      And I am logged in as admin
      And I am on the manage positions page with editing on
      And I hide the 1st edit position frameworks table entry
    Then I should see "show.gif" within the edit position frameworks table

  # 3.8.4, page 95, move #2 up
  @store_pos_framework
  Scenario: Reordering by moving up a position framework
    Given the position framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test 1  | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage positions page with editing on
      And I Move up the 2nd edit position frameworks table entry
    Then the edit position frameworks table should match:
|Name|
| New Framework 2 |
| New Framework 1 |
| New Framework 3 |

  #3.8.4, page 95 -- move #2 down
  @store_pos_framework
  Scenario: Reordering by moving down a position framework
    Given the position framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test 1  | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage positions page with editing on
      And I Move down the 2nd edit position frameworks table entry
    Then the edit position frameworks table should match:
|Name|
| New Framework 1 |
| New Framework 3 |
| New Framework 2 |

  #3.8.4, page 95, move first down
  @store_pos_framework
  Scenario: Reordering by moving first entry down a position framework
    Given the position framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test 1  | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage positions page with editing on
      And I Move down the 1st edit position frameworks table entry
    Then the edit position frameworks table should match:
|Name|
| New Framework 2 |
| New Framework 1 |
| New Framework 3 |

  #3.8.4, page 95, move last up
  @store_pos_framework
  Scenario: Reordering by moving the last entry up a position framework
    Given the position framework table contains:
|fullname|shortname|idnumber|
| New Framework 1 | Test 1  | ID1 |
| New Framework 2 | Test 2  | ID2 |
| New Framework 3 | Test 3  | ID3 |
      And I am logged in as admin
      And I am on the manage positions page with editing on
      And I Move up the 3rd edit position frameworks table entry
    Then the edit position frameworks table should match:
|Name|
| New Framework 1 |
| New Framework 3 |
| New Framework 2 |


# Requires to patch webrat, query params on get method are written incorrectly.
# this similar to fix below, convert array of hashmap to just hashmaps
# https://webrat.lighthouseapp.com/projects/10503/tickets/380-fix-for-query-string-building-when-using-mechanize-adapter
  @store_pos_framework
  @store_pos_type
  Scenario: Add a position type with incomplete data, gives validation message
    Given there are no position type records
      And I am logged in as admin
      And I am on the manage position types page
      And I press "Add a new type"
      And I press "Save changes"
  Then I should see "Missing position type name"
      And there should be 0 position type records

  @store_pos_framework
  @store_pos_type
  Scenario: Add a position type
    Given I am logged in as admin
        And I am on the manage position types page
        And I press "Add a new type"
        And I fill in "Type full name" with "My position type fullname"
        And I press "Save changes"
    Then I should see "My position type fullname"
