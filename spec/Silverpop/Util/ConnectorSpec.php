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

	function it_should_get_an_error_on_login()
	{
		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>false</SUCCESS>
</RESULT>
<Fault>
<Request/>
<FaultCode/>
<FaultString><![CDATA[Unable to login user: r.deladsdsaazzari@nature.com - USER_NOT_FOUND. Attempt made from IP address: 31.221.45.4]]></FaultString>
<detail>
<error>
<errorid>140</errorid>
<module/>
<class>SP.Admin</class>
<method/>
</error>
</detail>
</Fault>
</Body>
</Envelope>
XML;
		$this->connector->post(Argument::cetera())->willReturn($return);
		$result = $this->login("whatever.com", "user", "pass");
		$result["Envelope"]["Body"]["RESULT"]["SUCCESS"]->shouldBe("false");
	}
}

