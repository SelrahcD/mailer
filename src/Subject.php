<?php

namespace SelrahcD\Mailer;

use Assert\Assertion;

class Subject
{
    private $subject;

    public function __construct($value)
    {
        Assertion::maxLength($value, 78);

        $this->subject = $value;
    }

    public function __toString()
    {
        return $this->subject;
    }
}
