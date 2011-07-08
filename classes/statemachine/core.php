<?php

abstract class Statemachine_Core {
   
   public static function factory($machine_type) {
      $machine = 'Sm_'.$machine_type;
      return new $machine;
   }

   public function __construct() {

   }
}
