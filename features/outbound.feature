Feature:
  As an external system
  I'm able to send an email trough mailgun


  Scenario: Sending a basic email
    When I try to send I mail with the following information :
      | from    | from@test.com                        |
      | to      | to@test.com                          |
      | subject | The subject of the test mail         |
      | content | This a boring content of a test mail |
    Then mailgun receive all email information in order to process it