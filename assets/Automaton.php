<?php
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

   /**
    * [addState description]
    * A function that get's a Node object (representing a new state for the Automaton)
    * @param Node object $state
    */
    public function addState($state) {
      if($state->isInitial()) $this->initialState = $this->currentState = $state;
      $this->states[$state->getName()] = $state;
    }

   /**
    * [nextState description]
    * A function that change the current state of the Automaton
    * @param char $l
    * @return boolean
    */
    public function nextState($l) {
      if( $this->states[$this->currentState->getName()]->getPath($l) !== false ) {
        if($this->currentState->isAFN($l)) {
          
          return false;
        }
        $this->currentState = $this->states[ $this->states[$this->currentState->getName()]->getPath($l)[0] ];
        return true;
      } else {
        return false;
      }
    }

   /**
    * [can description]
    * A function that check to see if a string is accepted by the Automaton
    * @param  string $str
    * @return boolean
    */
    public function can($str) {
      $ok = true;
      for($i=0; $i<strlen($str) && $ok; $i++) {
        $ok = $this->nextState($str[$i]);
      }

      if($ok && $this->currentState->isFinal()) return true;
      else return false;
    }
}
