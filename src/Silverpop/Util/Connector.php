<?php

namespace Silverpop\Util;

use Buzz\Browser;

class Connector
{
  private $connector;
  private $serializer;

  public function __construct($connector=null, $serializer=null) {
    $this->connector  = $connector  ?: new Browser();
    $this->serializer = $serializer ?: new Serializer();
  }

  public function send($url, array $param) {
    $param = $this->serializer->serialize($param);
    return $this->serializer->unserialize($this->connector->post($url, array(), $param));
  }

  public function login($url, $username, $password) {
    $data = array(
      "Body" => array(
        "Login" => array(
          "USERNAME" => $username,
          "PASSWORD" => $password,
        ),
      )
    );
    return $this->send($url, $data);
  }
}
