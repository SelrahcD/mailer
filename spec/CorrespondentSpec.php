<?php

namespace spec\SelrahcD\Mailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CorrespondentSpec extends ObjectBehavior
{
    function it_should_be_constructed_with_an_email_address()
    {
        $this->beConstructedWith('test@test.fr');
    }

    function it_should_validate_the_email_address()
    {
        $this->beConstructedWith('bla');
        $this->shouldThrow('InvalidArgumentException')->duringInstantiation();
    }

    function it_should_return_a_string_value()
    {
        $this->beConstructedWith('test@test.fr');
        $this->__toString()->shouldReturn('test@test.fr');
    }
}
