<?php
/*
Define a class for each state
*/

class Node {
  private $name;
  public $goTo;
  private $state;

  function __construct($name, $goTo, $state) {
    $this->name = $name;
    $this->goTo = $goTo;
    if(isset($state)) {
      $this->state = $state;
    }
  }

  /**
   * [getName description]
   * @return string
   */
  public function getName() {
    return $this->name;
  }

/**
 * [isFinal description]
 * @return boolean
 */
  public function isFinal() {
    if($this->state['final']) return true;
    return false;
  }

/**
 * [isInitial description]
 * @return boolean
 */
  public function isInitial() {
    if($this->state['initial']) return true;
    return false;
  }
}
