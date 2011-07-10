<?php

class Sm_Test extends Statemachine {

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
      if($args['bool']) {
	 $this->complete_state(__FUNCTION__);
	 return true;
      } else {
	 return false;
      }
   }
   
   public function bar($args) {
      if(!isset($args['bool'])) {
	 throw new Statemachine_Exception('Arguments required');
      }
      return $args['bool'];
   }
}
