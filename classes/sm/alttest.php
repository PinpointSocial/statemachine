<?php

class Sm_Alttest extends Statemachine {
   protected $_model = 'alt';

   protected $_states = array(
      'start',
      'middle',
      'end',
   );

   protected $_transitions = array(
      'start' => array(
	 'foo' => 'middle',
      ),

      'middle' => array(
	 'bar' => 'end',
      ),
   );

   public function foo($args) {
      if(!isset($args['bool'])) {
	 throw new Statemachine_Exception('Arguments required');
      }
      return $args['bool'];
   }
}
