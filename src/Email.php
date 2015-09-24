<?php

namespace SelrahcD\Mailer;

class Email
{
    private $from;
    private $to;
    private $subject;
    private $content;

    public function __construct($from, $to, $subject, $content)
    {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function send(MailgunGateway $mailgun)
    {
        $mailgun->send($this);
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getContent()
    {
        return $this->content;
    }
}
