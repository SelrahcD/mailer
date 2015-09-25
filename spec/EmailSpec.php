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
    function let(
        Correspondent $from,
        CorrespondentCollection $to,
        Subject $subject,
        Content $content,
        CorrespondentCollection $secondaryRecipients
    )
    {
        $to->count()->willReturn(1);
        $this->beConstructedWith($from, $to, $subject, $content, $secondaryRecipients);
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

    function it_should_have_a_sender(Correspondent $from)
    {
        $this->getSender()->shouldReturn($from);
    }

    function it_should_have_a_primary_recipients(CorrespondentCollection $to)
    {
        $this->getPrimaryRecipients()->shouldReturn($to);
    }

    function it_should_have_a_subject(Subject $subject)
    {
        $this->getSubject()->shouldReturn($subject);
    }

    function it_should_have_a_content(Content $content)
    {
        $this->getContent()->shouldReturn($content);
    }
    
    function it_should_have_secondary_recipients(CorrespondentCollection $secondaryRecipients)
    {
        $this->getSecondaryRecipients()->shouldReturn($secondaryRecipients);
    }

    function it_should_validate_their_is_at_least_one_recipient(
        Correspondent $from,
        CorrespondentCollection $to,
        Subject $subject,
        Content $content,
        CorrespondentCollection $secondaryRecipients
    )
    {
        $to->count()->willReturn(0);
        $secondaryRecipients->count()->willReturn(0);
        $this->beConstructedWith($from, $to, $subject, $content, $secondaryRecipients);
        $this->shouldThrow('\DomainException')->duringInstantiation();
    }
}
