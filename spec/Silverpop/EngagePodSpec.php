<?php

namespace spec\Silverpop;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EngagePodSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Silverpop\EngagePod');
    }
}
