<?php

abstract class Statemachine_Core {

   private $current_state = null;
   
   public static function factory($machine_type) {
      $machine = 'Sm_'.$machine_type;
      if(class_exists($machine)) {
	 return new $machine;
      } else {
	 throw new Statemachine_Exception('Invalid Machine Type');
      }
   }



   public function __construct() {

   }

   public function create() {
      $this->current_state = $this->_states[0];
   }

   public function current_state() {
      if ($this->current_state != null) {
	 return $this->current_state;
      } else {
	 throw new Statemachine_Exception('Machine Is Not Initialized');
      }
   }
}
