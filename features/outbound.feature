Feature:
  As an external system
  I'm able to send an email trough mailgun


  Scenario: Sending a basic email
    When I want to send an email with the following information using mailgun gateway:
      | from         | to         | subject                      | content                      |
      | from@test.fr | to@test.fr | A subject for the test email | A content for the test email |
    Then mailgun receive all email information in order to process it

  Scenario: Sending an email to several recipients
    When I want to send an email with the following information using mailgun gateway:
      | from         | to                      | subject                      | content                      |
      | from@test.fr | to@test.fr, to2@test.fr | A subject for the test email | A content for the test email |
    Then mailgun receive all email information in order to process it