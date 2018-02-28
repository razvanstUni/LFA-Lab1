<?php
$str = $_GET['str'];

class Node {
  public $name;
  public $go_to;
  public $state;

  function __construct($name, $go_to, $state) {
    $this->name = $name;
    $this->go_to = $go_to;
    if(isset($state)) {
      $this->state = $state;
    }
  }
}

class Automata {
    public $states = array();
    public $currentState = NULL;
    public $initialState = NULL;

    public function addState($state) {
      if($state->state['initial']) $this->initialState = $this->currentState = $state;
      $this->states[$state->name] = $state;
    }

    public function nextState($l) {
      if(isset( $this->states[$this->currentState->name]->go_to[$l] )) {
        $this->currentState = $this->states[ $this->states[$this->currentState->name]->go_to[$l] ];
        return true;
      } else {
        return false;
      }
    }

    public function can($str) {
      $ok = true;
      for($i=0; $i<strlen($str) && $ok; $i++) {
        $ok = $this->nextState($str[$i]);
      }

      if($ok && $this->currentState->state['final']) return 'YES';
      else return 'NO';
    }
}

$auto = new Automata;
$auto->addState( new Node('0', array('a' => '1', 'b' => '0'), array('initial' => true, 'final' => true)) );
$auto->addState( new Node('1', array('a' => '2','b' => '0'), array('initial' => false, 'final' => true)) );
$auto->addState( new Node('2', array('a' => '2', 'b' => '2'), array('initial' => false, 'final' => false)) );

print_r( $auto->can($str) );
