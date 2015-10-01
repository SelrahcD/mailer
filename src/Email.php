<?php

namespace SelrahcD\Mailer;

use Assert\Assertion;

class Email
{
    /**
     * @var Correspondent
     */
    private $sender;

    /**
     * @var CorrespondentCollection
     */
    private $primaryRecipients;

    /**
     * @var Subject
     */
    private $subject;

    /**
     * @var Content
     */
    private $content;

    /**
     * @var CorrespondentCollection
     */
    private $secondaryRecipients;

    /**
     * @param Correspondent $sender
     * @param CorrespondentCollection $primaryRecipients
     * @param Subject $subject
     * @param Content $content
     * @param CorrespondentCollection $secondaryRecipients
     */
    public function __construct(
        Correspondent $sender,
        CorrespondentCollection $primaryRecipients,
        Subject $subject,
        Content $content,
        CorrespondentCollection $secondaryRecipients
    )
    {
        $this->guardTheirIsAtLeastOneRecipient($primaryRecipients, $secondaryRecipients);

        $this->sender = $sender;
        $this->primaryRecipients = $primaryRecipients;
        $this->subject = $subject;
        $this->content = $content;
        $this->secondaryRecipients = $secondaryRecipients;
    }

    /**
     * @param MailgunGateway $mailgun
     */
    public function send(MailgunGateway $mailgun)
    {
        $mailgun->send($this);
    }

    /**
     * @return Correspondent
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return CorrespondentCollection
     */
    public function getPrimaryRecipients()
    {
        return $this->primaryRecipients;
    }

    /**
     * @return Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return CorrespondentCollection
     */
    public function getSecondaryRecipients()
    {
        return $this->secondaryRecipients;
    }

    /**
     * @param $primaryRecipients
     * @param $secondaryRecipients
     */
    private function guardTheirIsAtLeastOneRecipient($primaryRecipients, $secondaryRecipients)
    {
        if((count($primaryRecipients) + count($secondaryRecipients)) === 0)
        {
            throw new \DomainException;
        }
    }

    /**
     * @return CorrespondentCollection
     */
    public function getRecipients()
    {
        return $this->secondaryRecipients->combineWith($this->primaryRecipients);
    }
}
