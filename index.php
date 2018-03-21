<?php
function __autoload($class_name) {
  require_once './assets/' . $class_name . '.php';
}

/*
Dummy input data for an Automaton
*/

$str = $_GET['str']; //Get the string via an URL parameter

$auto = new Automaton;
$auto->addState( new Node('0', array('a' => array('1'), 'b' => array('0')), array('initial' => true, 'final' => true)) );
$auto->addState( new Node('1', array('a' => array('2'), 'b' => array('0')), array('initial' => false, 'final' => true)) );
$auto->addState( new Node('2', array('a' => array('2'), 'b' => array('2')), array('initial' => false, 'final' => false)) );

/*
$auto->addState( new Node('0', array('a' => '1', 'b' => '0'), array('initial' => true, 'final' => true)) );
$auto->addState( new Node('1', array('a' => '2', 'b' => '0'), array('initial' => false, 'final' => true)) );
$auto->addState( new Node('2', array('a' => '2', 'b' => '2'), array('initial' => false, 'final' => false)) );
*/

if( $auto->can($str) ) print 'YES'; else print 'NO';
