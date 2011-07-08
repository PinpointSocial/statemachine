<?php

abstract class Statemachine_Core {

   private $current_state = null;
   private $model = null;
   private $machine_type = null;
   private $loaded = FALSE;
   
   public static function factory($machine_type) {
      $machine = 'Sm_'.$machine_type;
      if(class_exists($machine)) {
	 return new $machine($machine_type);
      } else {
	 throw new Statemachine_Exception('Invalid Machine Type');
      }
   }


   public function __construct($machine_type) {
      $this->machine_type = $machine_type;
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

   public function load($args) {
      $this->model = Mango::factory($this->machine_type);
      foreach ($args as $key=>$value) {
	 $this->model->$key = $value;
      }
      $this->model->load();
      if ($this->model->loaded()) {
	 $this->loaded = TRUE;
	 $this->current_state = $this->model->st;
      }
   }

   public function loaded() {
      return $this->loaded;
   }
}
