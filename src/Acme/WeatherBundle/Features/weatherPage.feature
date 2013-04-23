Feature: First test coverage for AcmeWeatherBundle
  Scenario: Open page with weather info
    Given I am on "/"
    When I go to "/weather/Moscow"
    Then I should see "average_max_temp"

