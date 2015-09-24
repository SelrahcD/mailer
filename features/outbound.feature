Feature:
  As an external system
  I'm able to send an email trough mailgun


  Scenario: Sending a basic email
    When I want to send an email with the following information:
      | from         | to         | subject                      | content                      |
      | from@test.fr | to@test.fr | A subject for the test email | A content for the test email |
    Then mailgun receive all email information in order to process it