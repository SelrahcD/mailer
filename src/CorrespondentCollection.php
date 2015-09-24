<?php

namespace SelrahcD\Mailer;

class CorrespondentCollection
{
    private $correspondents;

    public function __construct(array $correspondents = array())
    {
        $this->correspondents = $correspondents;
    }

    static public function createFromString($string)
    {
        $correspondents = array_map(function($email) {
            $email = trim($email);
            return Correspondent::createFromString($email);
        }, explode(',', $string));

        return new self($correspondents);
    }

    public function __toString()
    {
        return implode(', ', $this->correspondents);
    }
}
