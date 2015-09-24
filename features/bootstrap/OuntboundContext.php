<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class OuntboundContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @When I try to send I mail with the following information :
     */
    public function iTryToSendIMailWithTheFollowingInformation(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then mailgun receive all email information in order to process it
     */
    public function mailgunReceiveAllEmailInformationInOrderToProcessIt()
    {
        throw new PendingException();
    }
}
