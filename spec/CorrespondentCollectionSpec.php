<?php

namespace spec\SelrahcD\Mailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SelrahcD\Mailer\Correspondent;
use SelrahcD\Mailer\CorrespondentCollection;

class CorrespondentCollectionSpec extends ObjectBehavior
{
    function it_should_be_constructed_using_an_array_of_correspondent(Correspondent $c1, Correspondent $c2)
    {
        $this->beConstructedWith(array($c1, $c2));
    }

    function it_should_be_able_to_build_a_collection_from_a_string()
    {
        $this->beConstructedThrough('createFromString',
            array('bla@test.fr, poney@test.fr')
        );


        $this->shouldBeLike(new CorrespondentCollection(array(
            new Correspondent('bla@test.fr'),
            new Correspondent('poney@test.fr')
        )));
    }
    
    function it_should_return_a_string_representation(Correspondent $c1, Correspondent $c2)
    {
        $c1->__toString()->willReturn('bla@test.fr');
        $c2->__toString()->willReturn('poney@test.fr');

        $this->beConstructedWith(array($c1, $c2));

        $this->__toString()->shouldReturn('bla@test.fr, poney@test.fr');
    }
}
