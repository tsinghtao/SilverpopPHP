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

    function it_should_perform_a_post_request()
    {
        $url    = "http://www.google.com";
        $param  = array("foo" => "bar");
        $this->connector->post($url, array(), Argument::any())->willReturn("Hello Silverpop");
        $this->send($url, $param)->shouldReturn("Hello Silverpop");
    }
}
