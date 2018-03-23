<form method="post">
  <input type="text" name="str" value="<?=(isset($_POST['str']) ? trim($_POST['str']) : '')?>" />
  <input type="submit" />
</form>
<?php
function __autoload($class_name) {
  require_once './assets/' . $class_name . '.php';
}

if(isset($_POST['str'])) {
  $str = trim($_POST['str']);
  $auto = new Automaton;

  /*
  Dummy input data for an Automaton
  */

  $auto->addState( new Node('0', array('a' => array('1'), 'b' => array('0')), array('initial' => true, 'final' => true)) );
  $auto->addState( new Node('1', array('a' => array('2'), 'b' => array('0')), array('initial' => false, 'final' => true)) );
  $auto->addState( new Node('2', array('a' => array('2'), 'b' => array('2')), array('initial' => false, 'final' => false)) );

  //AFN
  /*
  $auto->addState( new Node('q0', array('a' => array('q0', 'q2'), 'b' => array('q0'), 'c' => array('q1')), array('initial' => true, 'final' => false)) );
  $auto->addState( new Node('q1', array('a' => array('q1', 'q3'), 'b' => array('q2')), array('initial' => false, 'final' => false)) );
  $auto->addState( new Node('q2', array('a' => array('q3'), 'b' => array('q3', 'q2')), array('initial' => false, 'final' => false)) );
  $auto->addState( new Node('q3', array('c' => array('q4')), array('initial' => false, 'final' => false)) );
  $auto->addState( new Node('q4', array(), array('initial' => false, 'final' => true)) );
  */

  if( $auto->can($str) ) print 'YES'; else print 'NO';
}
