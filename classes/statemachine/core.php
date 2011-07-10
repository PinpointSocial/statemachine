<?php

abstract class Statemachine_Core {

   private $current_state = null;
   private $model = null;
   private $machine_type = null;
   private $loaded = FALSE;

   protected $_states = array();
   protected $_transitions = array();
   
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
      if(isset($this->_model)) {
	 $model_type = $this->_model;
      } else {
	 $model_type = $this->machine_type;
      }
      $this->model = Mango::factory($model_type);
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

   public function process($function, $args) {
      if(!method_exists($this, $function)) {
	 throw new Statemachine_Exception('Unknown Function');
      }
      // Get keys of legal functions current state
      $legal = array_keys($this->_transitions[$this->current_state]);
      if(!in_array($function, $legal)){
	 throw new Statemachine_Exception('Illegal Function Call');
      }

      return $this->$function($args);
   }

   public function next($args) {
      if(!isset($this->_transitions[$this->current_state])) {
	 throw new Statemachine_Exception('Current State Is End State');
      }

      if(count($this->_transitions[$this->current_state]) != 1) {
	 throw new Statemachine_Exception('State Is Non Linear');
      }

      $function  = array_keys($this->_transitions[$this->current_state]);
      return $this->process($function[0],$args);
   }

   protected function complete_state($current_function) {
      $this->current_state = $this->_transitions[$this->current_state][$current_function];
   }
}
