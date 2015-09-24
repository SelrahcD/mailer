<?php

namespace spec\SelrahcD\Mailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubjectSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('A subject');
    }

    function it_should_validate_subject_is_not_longer_than_78_chars()
    {
        $this->beConstructedWith(str_repeat('a', 79));
        $this->shouldThrow('\InvalidArgumentException')->duringInstantiation();
    }

    function it_should_return_a_string_value()
    {
        $this->__toString()->shouldReturn('A subject');
    }
}
