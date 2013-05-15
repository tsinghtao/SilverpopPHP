<?php

namespace Silverpop\Util;

use Buzz\Browser;

class Connector
{
  private $connector;

  public function __construct($connector=null) {
    if(null === $connector) $this->connector = new Browser();
    else $this->connector = $connector;
  }

  public function get($url) {
    return $this->connector->get($url);
  }
}
