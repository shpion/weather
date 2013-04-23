Feature: First test coverage for AcmeAdminBundle
  Checking simple functiononality
  Scenario: Open login page and check it
    Given I am on "/login"

    When I fill in "_username" with "admin"
    And I fill in "_password" with "111111"
    And I press "login"

    When I go to "/admin"
    Then I should see "List of Endpoints"

    When I fill in "form[serviceName]" with "Test 1"
    And I fill in "form_endpoint" with "Test Endpoint 1"
    And I fill in "form_parser" with "test_1"
    And I press "submit"
    Then I should see "Test 1 Test Endpoint 1 test_1"

