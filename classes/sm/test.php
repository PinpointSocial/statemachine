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
   );

   public function foo($args) {
      if(isset($args['bool'])) {
	 
      } else {

      }
   }



}
