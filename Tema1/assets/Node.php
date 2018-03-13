<?php
/*
Define a class for each state
*/

class Node {
  public $name;
  public $goTo;
  public $state;

  function __construct($name, $goTo, $state) {
    $this->name = $name;
    $this->goTo = $goTo;
    if(isset($state)) {
      $this->state = $state;
    }
  }
}
