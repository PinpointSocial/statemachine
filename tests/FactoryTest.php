<?php

class FactoryTest extends PHPUnit_Framework_TestCase {

   public function setUp() {

   }

   public function tearDown() {

   }

   public function testLoadPass() {
      $machine = Statemachine::factory('test');
      $class = get_class($machine);
      $this->assertEquals('Sm_Test', $class);
   }
   
   /**
   *  @expectedException   Statemachine_Exception
   */
   public function testLoadFail() {
      $machine = Statemachine::factory('derp');
   }

   public function testCreate() {
      $machine = Statemachine::factory('test');
      $machine->create();
      $this->assertEquals('start', $machine->current_state());
   }
   
   /**
   *  @expectedException   Statemachine_Exception
   */
   public function testCurrentStatusNonInit() {
      $machine = Statemachine::factory('test');
      $machine->current_state();
   }

}
