<?php

namespace SelrahcD\Mailer;

use Assert\Assertion;

class Correspondent
{
    private $emailAddress;

    private $identity = null;

    public function __construct($emailAddress, $identity = null)
    {
        Assertion::email($emailAddress);

        $this->emailAddress = $emailAddress;
        $this->identity = $identity;
    }

    public static function createFromString($string)
    {
        if(preg_match('/^(.*?) <(.*?)>$/', $string, $matches)) {
            return new self($matches[2], $matches[1]);
        }

        return new self($string);
    }

    public function __toString()
    {
        if(!$this->hasIdentity()) {
            return $this->emailAddress;
        }

        return $this->identity . ' <' . $this->emailAddress . '>';
    }

    private function hasIdentity()
    {
        return $this->identity !== null;
    }
}
