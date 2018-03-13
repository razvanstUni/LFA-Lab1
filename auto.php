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

/*
Define the Automaton class with the 3 main functions:
- Add new state
- Move to the next state
- Check a string to see if it's accepted by the Automaton
*/
class Automaton {
    public $states = array(); //A list with all the states
    public $currentState = NULL; //The current state of the Automaton
    public $initialState = NULL; //The state from where the Automaton starts working

    /*
      A function that get's a Node object (representing a new state for the Automaton)
    */
    public function addState($state) {
      if($state->state['initial']) $this->initialState = $this->currentState = $state;
      $this->states[$state->name] = $state;
    }

    /*
      A function that change the current state of the Automaton
    */
    public function nextState($l) {
      if(isset( $this->states[$this->currentState->name]->goTo[$l] )) {
        $this->currentState = $this->states[ $this->states[$this->currentState->name]->goTo[$l] ];
        return true;
      } else {
        return false;
      }
    }

    /*
      A function that check to see if a string is accepted by the Automaton
    */
    public function can($str) {
      $ok = true;
      for($i=0; $i<strlen($str) && $ok; $i++) {
        $ok = $this->nextState($str[$i]);
      }

      if($ok && $this->currentState->state['final']) return true;
      else return false;
    }
}

/*
Dummy input data for an Automaton
*/

$str = $_GET['str']; //Get the string via an URL parameter

$auto = new Automaton;
$auto->addState( new Node('0', array('a' => '1', 'b' => '0'), array('initial' => true, 'final' => true)) );
$auto->addState( new Node('1', array('a' => '2','b' => '0'), array('initial' => false, 'final' => true)) );
$auto->addState( new Node('2', array('a' => '2', 'b' => '2'), array('initial' => false, 'final' => false)) );

if( $auto->can($str) ) print 'YES'; else print 'NO';
