<?php
/*
Define a class for each state
*/

class Node {
  private $name;
  private $goTo;
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
 * [isAFN description]
 * @param  char  $char
 * @return boolean
 */
  public function isAFN($char) {
    if(count($this->goTo[$char]) > 1)
      return true;
      return false;
  }

  /**
   * [getPath description]
   * @param  char $char
   * @return boolean/char
   */
  public function getPath($char) {
    if(isset( $this->goTo[$char] ))
      return $this->goTo[$char];
    return false;
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
