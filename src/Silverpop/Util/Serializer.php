<?php

namespace Silverpop\Util;

use LSS\Array2XML,
    LSS\XML2Array;

class Serializer
{
  private $default_root;

  public function __construct($default_root=null) {
    if(is_null($default_root)) $this->default_root = "Envelope";
    else $this->default_root = $default_root;
  }

  public function serialize(array $array) {
    // Array -> XML
    return rtrim(Array2XML::createXML($this->default_root, $array)->saveXML());
  }

  public function unserialize($xml) {
    // XML -> Array
    return XML2Array::createArray($xml);
  }
}
