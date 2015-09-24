<?php

namespace spec\SelrahcD\Mailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SelrahcD\Mailer\MailgunGateway;

class EmailSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('from@test.com', 'to@test.com', 'A subject', 'A content');
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('SelrahcD\Mailer\Email');
    }

    function it_should_beconstructed_with_a_from_a_to_a_subject_and_a_content()
    {
        $this->beConstructedWith('to', 'from', 'subject', 'content');
    }

    function it_should_be_sent_through_mailgun(MailgunGateway $mailgun)
    {
        $this->send($mailgun);
        $mailgun->send($this->getWrappedObject())->shouldHaveBeenCalled();
    }

    function it_should_have_a_from()
    {
        $this->getFrom()->shouldReturn('from@test.com');
    }

    function it_should_have_a_to()
    {
        $this->getTo()->shouldReturn('to@test.com');
    }

    function it_should_have_a_subject()
    {
        $this->getSubject()->shouldReturn('A subject');
    }

    function it_should_have_a_content()
    {
        $this->getContent()->shouldReturn('A content');
    }
}
