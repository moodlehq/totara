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
  @store_pos_depth
  Scenario: No position depth levels
    Given there is 1 position framework record
      And there are no position depth records
      And I am logged in as admin
      And I am on the manage positions page
    Then I should see "No depth levels in this framework"
      And I should see "Add a new depth level"
      And I should not see "Test Position Depth"

  # 3.9.1#3
  @store_pos_depth
  Scenario: Add a new position depth level 
    Given I am logged in as admin
      And there is 1 position framework record
      And there are no position depth records
      And I am on the manage positions page
      And I press "Add a new depth level" 
    Then I should see "General"
      And I should see "Depth level"
      And I should see "1"

  # 3.9.1#4
  @store_pos_depth
  @tiger
  Scenario: Add a new position depth level but with empty mandatory fields
    Given I am logged in as admin
      And there is 1 position framework record
      And there are no position depth records
      And I am on the manage positions page
      And I press "Add a new depth level" 
      And I press "Save changes"
    Then I should be on the edit position depth page
      And I should see "Missing depth level full name"
      And I should see "Missing depth level short name"

  # 3.9.1#6
  @store_pos_depth
  Scenario: Add a new position depth level 
    Given I am logged in as admin
      And there is 1 position framework record
      And there are no position depth records
      And I am on the manage positions page
      And I press "Add a new depth level" 
      And I fill in "fullname" with "My position depth fullname"
      And I fill in "shortname" with "My posdepth shortname"
      And I press "Save changes"
    Then I should be on manage position depth page
      And I should see "My position depth fullname"
      And I should see "Add a new depth level"

