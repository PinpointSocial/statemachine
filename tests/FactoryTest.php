<?php

class FactoryTest extends PHPUnit_Framework_TestCase {

   private $start;
   private $middle;
   private $end;

   public function setUp() {
      $this->start = Mango::factory('test'); 
      $this->start->st = 'start';
      $this->start->create();
      
      $this->middle = Mango::factory('test'); 
      $this->middle->st = 'middle';
      $this->middle->create();
      
      $this->end = Mango::factory('test'); 
      $this->end->st = 'end';
      $this->end->create();
   }

   public function tearDown() {
      $m = new Mongo();
      $db = $m->selectDB('statemachine_unittest');
      $db->command(array('dropDatabase' => 1));
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

   public function testLoadModel() {
      $machine = Statemachine::factory('test');
      $machine->load(array('st' => 'start'));
      if ($machine->loaded()) {
	 $this->assertEquals('start', $machine->current_state());
      } else {
	 $this->fail('Model exists in fixture');
      }
   }

}
