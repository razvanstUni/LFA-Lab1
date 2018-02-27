<?php
$str = $_GET['str'];

define("INITIAL_STATE", 0);
define("FINAL_STATE", 2);
class Automata {
    public $states = array();
    public $cur_state = NULL;
    public $initial_state = NULL;
    public $final_state = NULL;

    public function add_state($name, $go_to, $state = 1) {
      if($state == INITIAL_STATE) $this->initial_state = $this->cur_state = $name;
      if($state == FINAL_STATE) $this->final_state = $name;
      $this->states[$name] = array(
        'state' => $state,
        'go_to' => $go_to
      );
    }

    public function next_state($l) {
      if(isset( $this->states[$this->cur_state]['go_to'][$l] )) {
        $this->cur_state = $this->states[$this->cur_state]['go_to'][$l];
        return true;
      } else {
        return false;
      }
    }

    public function can($str) {
      $ok = true;
      for($i=0; $i<strlen($str) && $ok; $i++) {
        $ok = $this->next_state($str[$i]);
      }

      if($ok && $this->cur_state == $this->final_state) return 'YES';
      else return 'NO';
    }
}

$auto = new Automata;
$auto->add_state('s', array('b'=>'s', 'a'=>'p'), INITIAL_STATE);
$auto->add_state('p', array('b'=>'q', 'a'=>'p'));
$auto->add_state('q', array('b'=>'s', 'a'=>'r'));
$auto->add_state('r', array('b'=>'r', 'a'=>'r'), FINAL_STATE);

print_r( $auto->can($str) );
