Feature:
    In order to gain access to the site
    As any type of user
    I should be redirected and I am able to login and logout

    Scenario Outline: Signing in by username or email
        Given I am on "/"
        Then I am on "/login"
        When I fill in "inputUsernameEmail" with "<usernameOrEmail>"
        And I fill in "inputPassword" with "<password>"
        And I press "Sign in"
        Then I should see "Logout"

        Examples:
            | usernameOrEmail        | password |
            | superadmin             | 12345    |
            | superadmin@example.com | 12345    |
            | admin                  | 12345    |
            | admin@example.com      | 12345    |
            | manager                | 12345    |
            | manager@example.com    | 12345    |
            | user                   | 12345    |
            | user@example.com       | 12345    |
            | user_wai               | 12345    |
            | user_wai@example.com   | 12345    |


