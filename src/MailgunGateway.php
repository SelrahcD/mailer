<?php

namespace SelrahcD\Mailer;

use Mailgun\Mailgun;

class MailgunGateway
{
    private $mailgun;

    /**
     * MailgunGateway constructor.
     * @param $mailgun
     */
    public function __construct(Mailgun $mailgun)
    {
        $this->mailgun = $mailgun;
    }


    public function send(Email $email)
    {
        $this->mailgun->sendMessage('test.com', array(
            'from'    => $email->getFrom(),
            'to'      => $email->getTo(),
            'subject' => $email->getSubject(),
            'text'    => $email->getContent(),
        ));
    }
}