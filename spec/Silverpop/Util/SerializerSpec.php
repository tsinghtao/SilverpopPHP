<?php

namespace spec\Silverpop\Util;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SerializerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Silverpop\Util\Serializer');
    }

    function it_should_serialize()
    {
        $array = array("Body" => array(
                "Login" => array(
                    "USERNAME" => "user",
                    "PASSWORD" => "pass"
                ),
            ),
        );
        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<Envelope>
  <Body>
    <Login>
      <USERNAME>user</USERNAME>
      <PASSWORD>pass</PASSWORD>
    </Login>
  </Body>
</Envelope>
XML;
        $this->serialize($array)->shouldBe($expected);
    }

    function it_should_unserialize()
    {
        $xml = "<Envelope><foo baz=\"foo\">bar</foo></Envelope>";
        $expected = array("Envelope" => array(
          "foo" => array(
            "@value" => "bar",
            "@attributes" => array(
              "baz" => "foo"
            )
          )
        ));
        $this->unserialize($xml)->shouldBe($expected);
    }
}
