<?php

class Sm_Multi extends Statemachine {

   protected $_states = array(
      'idle',
      'state_a',
      'state_b',
   );

   protected $_transitions = array(
      'idle' => array(
	 'set_a' => 'state_a',
	 'set_b' => 'state_b',
      ),
   );

   public function set_a($args) {
      if(!isset ($args['foo'])) {
	 throw new Statemachine_Exception('Arguments Required');
      }
      
      if($args['foo'] == TRUE) {
	 $this->complete_state(__FUNCTION__);
	 return true;
      } 
      
      return false;
   }

   public function set_b($args) {
      if(!isset ($args['foo'])) {
	 throw new Statemachine_Exception('Arguments Required');
      }
      
      if($args['foo'] == TRUE) {
	 $this->complete_state(__FUNCTION__);
	 return true;
      } 
      
      return false;
   }

}
