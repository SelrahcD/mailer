<?php

namespace spec\SelrahcD\Mailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SelrahcD\Mailer\Correspondent;

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

    function it_should_accept_an_identity() 
    {
        $this->beConstructedWith('test@test.com', 'Paul Bismuth');
    }

    function it_should_return_a_correct_string_value_when_identity_is_provided()
    {
        $this->beConstructedWith('test@test.com', 'Paul Bismuth');
        $this->__toString()->shouldReturn('Paul Bismuth <test@test.com>');
    }

    function it_can_be_created_from_a_string_with_identity()
    {
        $this->beConstructedThrough('createFromString',
            array('Paul Bismuth <paul@ump.fr>')
        );

        $this->shouldBeLike(new Correspondent('paul@ump.fr', 'Paul Bismuth'));
    }

    function it_can_be_created_from_a_string_without_identity()
    {
        $this->beConstructedThrough('createFromString',
            array('paul@ump.fr')
        );

        $this->__toString()->shouldReturn('paul@ump.fr');
    }
}
