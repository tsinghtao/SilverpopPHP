<?php

namespace Silverpop\Util;

use Buzz\Browser;

class Connector
{
	private $connector;

	public function __construct($connector=null, $serializer=null) {
		$this->connector  = $connector  ?: new Browser();
	}

	public function send($url, $data) {
		return $this->connector->post($url, array(), $data);
	}
}
