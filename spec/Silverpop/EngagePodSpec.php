<?php

namespace spec\Silverpop;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class EngagePodSpec extends ObjectBehavior
{
    private $connector;

    function let()
    {
        $prophet = new Prophet();
        $this->connector = $prophet->prophesize("Silverpop/Util/Connector");
        $config = array(
            'username'      => 'r.delazzari@nature.com',
            'password'      => '123N4ture',
            'engage_server' => 4
        );
        $this->beConstructedWith($config, $this->connector);
    }

    function it_is_initializable()
    {
        $return = <<<XML
XML;
        $this->connector->send(Argument::cetera())->willReturn();
        $this->shouldHaveType('Silverpop\EngagePod');
    }

    function it_should_throw_exception_with_wrong_config_args()
    {
        $exception = new \Exception("Incorrect constructor");
        $wrong_config = array(
            'username' => 'hey!',
            'password' => 'ho! Lets go!'
        );

        $this->shouldThrow($exception)->during('__construct', array($wrong_config));
    }
}
