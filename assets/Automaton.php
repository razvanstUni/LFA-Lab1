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
