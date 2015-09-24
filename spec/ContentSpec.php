<?php

namespace spec\SelrahcD\Mailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContentSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('The content');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SelrahcD\Mailer\Content');
    }
    
    function it_has_a_string_representation()
    {
        $this->__toString()->shouldReturn('The content');
    }
}
