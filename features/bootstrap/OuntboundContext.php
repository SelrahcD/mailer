<?php

use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Mockery\Mock;
use SelrahcD\Mailer\Email;
use SelrahcD\Mailer\MailgunGateway;

/**
 * Defines application features from the specific context.
 */
class OuntboundContext implements Context, SnippetAcceptingContext
{
    private $mailgunGateway;

    private $mailgun;

    private $emailInfo;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->mailgun = Mockery::spy('Mailgun\Mailgun');
        $this->mailgunGateway = new MailgunGateway($this->mailgun);
    }

    /**
     * @AfterScenario
     */
    public function tearDownMockery(AfterScenarioScope $event)
    {
        Mockery::close();
    }

    /**
     * @Transform table:from,to,subject,content
     */
    public function castEmailFieldsTable(TableNode $emailTable)
    {
        $this->emailInfo = $emailTable->getHash()[0];
        return new Email($this->emailInfo['from'], $this->emailInfo['to'], $this->emailInfo['subject'], $this->emailInfo['content']);
    }



    /**
     * @When I want to send an email with the following information using mailgun gateway:
     */
    public function iWantToSendAnEmailWithTheFollowingInformationUsingMailgunGateway(Email $email)
    {
        $email->send($this->mailgunGateway);
    }

    /**
     * @Then mailgun receive all email information in order to process it
     */
    public function mailgunReceiveAllEmailInformationInOrderToProcessIt()
    {
        $this->mailgun->shouldHaveReceived('sendMessage')->once()->with('test.com', array(
            'from'    => $this->emailInfo['from'],
            'to'      => $this->emailInfo['to'],
            'subject' => $this->emailInfo['subject'],
            'text'    => $this->emailInfo['content'],
        ));
    }
}
