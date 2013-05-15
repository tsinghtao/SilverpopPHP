<?php

namespace spec\Silverpop\Util;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class ConnectorSpec extends ObjectBehavior
{
    private $connector;

    function let()
    {
        $prophet = new Prophet;
        $this->connector = $prophet->prophesize('Buzz\Browser');
        $this->beConstructedWith($this->connector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Silverpop\Util\Connector');
    }

    function it_should_do_a_get_request()
    {
        $url = "http://www.google.com";
        $this->connector->get($url)->willReturn("Hello Silverpop");
        $this->get($url)->shouldReturn("Hello Silverpop");
    }
}
