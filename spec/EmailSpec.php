<?php

namespace spec\SelrahcD\Mailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SelrahcD\Mailer\Content;
use SelrahcD\Mailer\Correspondent;
use SelrahcD\Mailer\CorrespondentCollection;
use SelrahcD\Mailer\MailgunGateway;
use SelrahcD\Mailer\Subject;

class EmailSpec extends ObjectBehavior
{
    function let(Correspondent $from, CorrespondentCollection $to, Subject $subject, Content $content)
    {
        $this->beConstructedWith($from, $to, $subject, $content);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('SelrahcD\Mailer\Email');
    }

    function it_should_beconstructed_with_a_from_a_to_a_subject_and_a_content(Correspondent $from, CorrespondentCollection $to, Subject $subject, Content $content)
    {
        $this->beConstructedWith($from, $to, $subject, $content);
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

    function it_should_have_a_subject(Subject $subject)
    {
        $this->getSubject()->shouldReturn($subject);
    }

    function it_should_have_a_content(Content $content)
    {
        $this->getContent()->shouldReturn($content);
    }
}
