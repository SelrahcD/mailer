<?php

namespace spec\SelrahcD\Mailer;

use Mailgun\Mailgun;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SelrahcD\Mailer\Email;

class MailgunGatewaySpec extends ObjectBehavior
{
    function let(Mailgun $mailgun)
    {
        $this->beConstructedWith($mailgun);
    }
    function it_is_initializable(Mailgun $mailgun)
    {
        $this->beConstructedWith($mailgun);
        $this->shouldHaveType('SelrahcD\Mailer\MailgunGateway');
    }

    function it_should_send_an_email_to_mailgun(Mailgun $mailgun, Email $email)
    {
        $email->getFrom()->willReturn("from@test.com");
        $email->getTo()->willReturn('to@test.com');
        $email->getSubject()->willReturn('A subject');
        $email->getContent()->willReturn('A content');

        $this->send($email);

        $mailgun->sendMessage('test.com', array(
            'from'    => 'from@test.com',
            'to'      => 'to@test.com',
            'subject' => 'A subject',
            'text'    => 'A content',
        ))->shouldHaveBeenCalled();
    }
}
