<?php

namespace spec\SelrahcD\Mailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SelrahcD\Mailer\Correspondent;
use SelrahcD\Mailer\CorrespondentCollection;
use SelrahcD\Mailer\MailgunGateway;

class EmailSpec extends ObjectBehavior
{
    function let(Correspondent $from, CorrespondentCollection $to)
    {
        $this->beConstructedWith($from, $to, 'A subject', 'A content');
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('SelrahcD\Mailer\Email');
    }

    function it_should_beconstructed_with_a_from_a_to_a_subject_and_a_content(Correspondent $from, CorrespondentCollection $to)
    {
        $this->beConstructedWith($from, $to, 'subject', 'content');
    }

    function it_should_be_sent_through_mailgun(MailgunGateway $mailgun)
    {
        $this->send($mailgun);
        $mailgun->send($this->getWrappedObject())->shouldHaveBeenCalled();
    }

    function it_should_have_a_from(Correspondent $from)
    {
        $this->getFrom()->shouldReturn($from);
    }

    function it_should_have_a_to(CorrespondentCollection $to)
    {
        $this->getTo()->shouldReturn($to);
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
