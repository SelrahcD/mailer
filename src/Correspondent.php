<?php

namespace SelrahcD\Mailer;

use Assert\Assertion;

class Correspondent
{
    private $emailAddress;

    public function __construct($emailAddress)
    {
        Assertion::email($emailAddress);

        $this->emailAddress = $emailAddress;
    }

    public function __toString()
    {
        return $this->emailAddress;
    }
}
