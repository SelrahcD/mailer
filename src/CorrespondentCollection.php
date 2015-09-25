<?php

namespace SelrahcD\Mailer;

class CorrespondentCollection implements \Countable
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

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->correspondents);
    }
}
