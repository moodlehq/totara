Feature: Manage Organisation
  In order to maintain the site organisation
  As an administrator
  I want to be able to add, edit and delete organisations

  @store_org
  @store_org_framework
  @store_org_depth
  Scenario: No organisations
    Given there are no organisation framework records
      And I am logged in as admin
      And I am on the manage organisations page
    Then I should see "No organisation frameworks available"

  @store_org
  @store_org_framework
  @store_org_type
  Scenario: Fail to create a organisation without required fields
    Given there is 1 organisation framework record
      And I am logged in as admin
      And I am on the manage organisations page
      And I click "Test Organisation Framework 1"
      And I press "Add new organisation"
      And I press "Save changes"
    Then I should see "Missing organisation name"

  @store_org
  @store_org_framework
  @store_org_type
  Scenario: Add a new organisation
    Given there is 1 organisation framework record
      And I am logged in as admin
      And I am on the manage organisations page
      And I click "Test Organisation Framework 1"
      And I press "Add new organisation"
      And I fill in "fullname" with "My organisation fullname"
      And I press "Save changes"
    Then I should see "My organisation fullname"

  @store_org
  @store_org_framework
  @store_org_type
  Scenario: Add a new child organisation
    Given there is 1 organisation framework record
      And I am logged in as admin
      And I am on the manage organisations page
      And I click "Test Organisation Framework 1"
      And I add an organisation
      And I press "Return to organisation framework"
      And I press "Add new organisation"
      And I select "My organisation fullname" from "parentid"
      And I fill in "fullname" with "My child organisation fullname"
      And I press "Save changes"
    Then I should see "My child organisation fullname"

  @store_org
  @store_org_framework
  @store_org_type
  Scenario: Edit an organisation
    Given there is 1 organisation framework record
      And I am logged in as admin
      And I am on the manage organisations page
      And I click "Test Organisation Framework 1"
      And I add an organisation
      And I press "Return to organisation framework"
      And I edit the 1st organisation table entry
      And I fill in "fullname" with "My organisation fullname revised"
      And I press "Save changes"
    Then I should see "My organisation fullname revised"

  @store_org
  @store_org_framework
  @store_org_type
  Scenario: Delete an organisation
    Given there is 1 organisation framework record
      And I am logged in as admin
      And I am on the manage organisations page
      And I click "Test Organisation Framework 1"
      And I add an organisation
      And I press "Return to organisation framework"
      And I delete the 1st organisation table entry and confirm
    Then I should not see "My organisation fullname" within the organisation column

  #@store_org
  #@store_org_framework
  #@store_org_type
  #Scenario: Filter an organisation
  #  Given there is a organisation framework and 1 depth
  #    And I am logged in as admin
  #    And I am on the manage organisations page with editing on
  #    And I add an organisation
  #  When I select "contains" from "fullname_op"
  #    And I fill in "fullname" with "test filter"
  #    And I press "Add filter"
  #  Then I should not see "My organisation fullname"
  #  When I press "Remove all filters"
  #  Then I should see "My organisation fullname"

