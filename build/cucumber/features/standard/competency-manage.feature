Feature: Manage Competency
  In order to maintain the site competency
  As an administrator
  I want to be able to add, edit and delete competencies


  @store_comp
  @store_comp_framework
  @store_comp_class
  Scenario: No competencies
    Given there are no competency framework records
      And I am logged in as admin
      And I am on the manage competencies page
    Then I should see "No competency frameworks defined"

  @store_comp
  @store_comp_framework
  @store_comp_class
  Scenario: Fail to create a competency without required fields
    Given there is 1 competency framework record
      And I am logged in as admin
      And I am on the manage competencies page
      And I click "Test Competency Framework 1"
      And I press "Add new competency"
      And I press "Save changes"
    Then I should see "Missing competency name"
