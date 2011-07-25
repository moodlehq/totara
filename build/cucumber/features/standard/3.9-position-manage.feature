# Some tests require webrat patch (use one from 2nd comment):
# https://webrat.lighthouseapp.com/projects/10503/tickets/384-webrat-does-not-pass-empty-form-fields-correctly-to-mechanize

# 3.9, page 96
Feature: Manage Positions
  In order to maintain the site positions
  As an administrator
  I want to be able to:
    add, edit, delete, reorder positions at different levels,
    view custom field settings for a position/depth level,
    filter position hierarchies,
    Export position hierarchy data

  # 3.9.1#2
  #@store_pos_depth
  #Scenario: No position depth levels
  #  Given there is 1 position framework record
  #    And there are no position depth records
  #    And I am logged in as admin
  #    And I am on the manage positions page
  #  Then I should see "No depth levels in this framework"
  #    And I should see "Add a new depth level"
  #    And I should not see "Test Position Depth"

  @store_pos_type
  Scenario: Add a new position type
    Given I am logged in as admin
      And I am on the manage position types page
      And I press "Add a new type"
      And I fill in "Type full name" with "My Position Type fullname"
      And I press "Save changes"
    Then I should see "My Position Type fullname"

  @store_pos_type
  Scenario: Add a new position type but with empty mandatory fields
    Given I am logged in as admin
      And I am on the manage position types page
      And I press "Add a new type"
      And I press "Save changes"
    Then I should see "Missing position type name"

  # 3.9.1#5
  #@store_pos_depth
  #Scenario: Edit a position type
  #  Given I am logged in as admin
  #    And there is 1 position framework record
      #And there are no position depth records
  #    And I am on the manage positions page
  #    And I press "Add a new depth level"
  #    And I press "Cancel"
  #  Then I should see "Description for Test Position Framework 1"
