<?php

namespace spec\Silverpop;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EngagePodSpec extends ObjectBehavior
{

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function let($connector)
	{
		$config = array(
			'username'      => 'r.delazzari@nature.com',
			'password'      => '123N4ture',
			'engage_server' => 4
		);

		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>true</SUCCESS>
<SESSIONID>41AF1FEE603E062EFDFF5F31951BB68F</SESSIONID>
<ORGANIZATION_ID>9f0df0-11c05819426-7ed8ba187b62142e84dccb0910cb2101</ORGANIZATION_ID>
<SESSION_ENCODING>;jsessionid=41AF1FEE603E062EFDFF5F31951BB68F</SESSION_ENCODING>
</RESULT>
</Body>
</Envelope>
XML;

		$connector->send(Argument::cetera())->willReturn($return);
		$this->beConstructedWith($config, $connector);
	}

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function it_is_initializable($connector)
	{
		$this->shouldHaveType('Silverpop\EngagePod');
	}

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function it_should_throw_exception_with_wrong_config_args($connector)
	{
		$exception = new \Exception("Incorrect constructor");
		$wrong_config = array(
			'username' => 'hey!',
			'password' => 'ho! Lets go!'
		);

		$connector->send()->shouldNotBeCalled();
		$this->shouldThrow($exception)->during('__construct', array($wrong_config));
	}

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function it_should_get_lists($connector)
	{
		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>TRUE</SUCCESS>
<LIST>
<ID>365333</ID>
<NAME>Folder One</NAME>
<TYPE>0</TYPE>
<SIZE>0</SIZE>
<NUM_OPT_OUTS>0</NUM_OPT_OUTS>
<NUM_UNDELIVERABLE>0</NUM_UNDELIVERABLE>
<LAST_MODIFIED>08/23/07 04:18 PM</LAST_MODIFIED>
<VISIBILITY>0</VISIBILITY>
<PARENT_NAME/>
<USER_ID>8c3747-111fae2b32c21fbca0cb8d6</USER_ID>
<PARENT_FOLDER_ID>285607</PARENT_FOLDER_ID>
<IS_FOLDER>true</IS_FOLDER>
</LIST>
<LIST>
<ID>323543</ID>
<NAME>List One</NAME>
<TYPE>0</TYPE>
<SIZE>1</SIZE>
<NUM_OPT_OUTS>0</NUM_OPT_OUTS>
<NUM_UNDELIVERABLE>0</NUM_UNDELIVERABLE>
<LAST_MODIFIED>09/26/07 10:31 AM</LAST_MODIFIED>
<VISIBILITY>0</VISIBILITY>
<PARENT_NAME/>
<USER_ID>8c3747-111fae23972-f520cb8d6</USER_ID>
<PARENT_FOLDER_ID>285607</PARENT_FOLDER_ID>
<IS_FOLDER>false</IS_FOLDER>
</LIST>
</RESULT>
</Body>
</Envelope>
XML;
		$connector->send(Argument::cetera())->willReturn($return);
		$return = $this->getLists();
		$return[0]["ID"]->shouldBe("365333");
		$return[1]["ID"]->shouldBe("323543");
	}

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function it_should_get_mailing_templates($connector)
	{
		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>TRUE</SUCCESS>
<MAILING_TEMPLATE>
<MAILING_ID>365333</MAILING_ID>
<MAILING_NAME>Mailing One</MAILING_NAME>
<SUBJECT>Mailing One</SUBJECT>
<LAST_MODIFIED>08/23/07 04:18 PM</LAST_MODIFIED>
<VISIBILITY>0</VISIBILITY>
<USER_ID>8c3747-111fae2b32c21fbca0cb8d6</USER_ID>
</MAILING_TEMPLATE>
<MAILING_TEMPLATE>
<MAILING_ID>323543</MAILING_ID>
<MAILING_NAME>Mailing Two</MAILING_NAME>
<SUBJECT>Mailing Two</SUBJECT>
<LAST_MODIFIED>09/26/07 10:31 AM</LAST_MODIFIED>
<VISIBILITY>0</VISIBILITY>
<USER_ID>8c3747-111fae23972-f520cb8d6</USER_ID>
</MAILING_TEMPLATE>
</RESULT>
</Body>
</Envelope>
XML;
		$connector->send(Argument::cetera())->willReturn($return);
		$return = $this->getMailingTemplates();
		$return[0]["MAILING_ID"]->shouldBe("365333");
		$return[1]["MAILING_ID"]->shouldBe("323543");
	}

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function it_should_calculate_query($connector)
	{
		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>TRUE</SUCCESS>
<JOB_ID>499600</JOB_ID>
</RESULT>
</Body>
</Envelope>
XML;
		$connector->send(Argument::cetera())->willReturn($return);
		$return = $this->calculateQuery(12345);
		$return->shouldBe("499600");
	}

	/**
	 * @param Silverpop\Util\Connector $connector

	function it_should_get_scheduled_mailings($connector)
	{
		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>TRUE</SUCCESS>

</RESULT>
</Body>
</Envelope>
XML;
		$connector->send(Argument::cetera())->willReturn($return);
		$return = $this->calculateQuery(12345);
		$return->shouldBe("499600");
	}
	 */

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function it_should_get_list_meta_data($connector)
	{
		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>TRUE</SUCCESS>
<ID>108220</ID>
<NAME>Test3</NAME>
<TYPE>0</TYPE>
<SIZE>12</SIZE>
<NUM_OPT_OUTS>0</NUM_OPT_OUTS>
<NUM_UNDELIVERABLE>0</NUM_UNDELIVERABLE>
<LAST_MODIFIED>02/02/06 04:51 PM</LAST_MODIFIED>
<LAST_CONFIGURED>02/02/06 04:51 PM</LAST_CONFIGURED>
<CREATED>02/02/06 04:51 PM</CREATED>
<VISIBILITY>0</VISIBILITY>
<USER_ID>12c734c-108b610e402-f528764d624db129b32c21fbca0cb8d6</USER_ID>
<ORGANIZATION_ID>113cf49-fc61243b0b-f528764d624db129b32c21fbca0cb8d6 </ORGANIZATION_ID>
<OPT_IN_FORM_DEFINED>false</OPT_IN_FORM_DEFINED>
<OPT_OUT_FORM_DEFINED>true</OPT_OUT_FORM_DEFINED>
<PROFILE_FORM_DEFINED>false</PROFILE_FORM_DEFINED>
<OPT_IN_AUTOREPLY_DEFINED>false</OPT_IN_AUTOREPLY_DEFINED>
<PROFILE_AUTOREPLY_DEFINED>false</PROFILE_AUTOREPLY_DEFINED>
<COLUMNS>
<COLUMN>
<NAME>LIST_ID</NAME>
</COLUMN>
<COLUMN>
<NAME>MAILING_ID</NAME>
</COLUMN>
<COLUMN>
<NAME>RECIPIENT_ID</NAME>
</COLUMN>
<COLUMN>
<NAME>EMAIL</NAME>
</COLUMN>
<COLUMN>
<NAME>CAR_TYPE</NAME>
<DEFAULT_VALUE>Hybrid</DEFAULT_VALUE>
<TYPE>0</TYPE>
</COLUMN>
</COLUMNS>
</RESULT>
</Body>
</Envelope>
XML;
		$connector->send(Argument::cetera())->willReturn($return);
		$return = $this->getListMetaData(12345);
		$return["NAME"]->shouldBe("Test3");
	}

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function it_should_remove_a_contact($connector)
	{
		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>TRUE</SUCCESS>
</RESULT>
<ORGANIZATION_ID>
1dcd49d-108b594203d-f528764d648fb129b32c21fbca0cb8d6
</ORGANIZATION_ID>
</Body>
</Envelope>
XML;
		$connector->send(Argument::cetera())->willReturn($return);
		$this->removeContact(12345, "test@test.com", 123)->shouldBe(true);
	}

	/**
	 * @param Silverpop\Util\Connector $connector
	 */
	function it_should_add_a_contact($connector)
	{
		$return = <<<XML
<Envelope>
<Body>
<RESULT>
<SUCCESS>TRUE</SUCCESS>
<RecipientId>33535067</RecipientId>
</RESULT>
</Body>
</Envelope>
XML;
		$connector->send(Argument::cetera())->willReturn($return);
		$this->addContact(12345, true, array("name" => "123") )->shouldBe("33535067");
	}
}

