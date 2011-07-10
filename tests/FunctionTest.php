<?php

class FunctionTest extends PHPUnit_Framework_TestCase {

   private $start;
   private $middle;
   private $end;
   private $alt;

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

      $this->alt = Mango::factory('alt');
      $this->alt->st = 'start';
      $this->alt->create();
   }

   public function tearDown() {
      $m = new Mongo();
      $db = $m->selectDB('statemachine_unittest');
      $db->command(array('dropDatabase' => 1));
   }

   public function testDirectFunctionPass() {
      $machine = Statemachine::factory('test');
      $machine->load(array('st' => 'start'));
      if(!$machine->loaded()) {
	 $this->fail('Model exists in fixture');
      }
      if(!$machine->process('foo', array('bool' => true))){
	 $this->fail('Function exists and should process');
      }
   }
   
   /**
   *  @expectedException Statemachine_Exception
   */
   public function testDirectFunctionUnknown() {
      $machine = Statemachine::factory('test');
      $machine->load(array('st' => 'start'));
      if(!$machine->loaded()) {
	 $this->fail('Model exists in fixture');
      }
      $machine->process('baz', array('bool' => true));
   }

   /**
   *  @expectedException Statemachine_Exception
   */
   public function testDirectFunctionIllegal() {
      $machine = Statemachine::factory('test');
      $machine->load(array('st' => 'start'));
      if(!$machine->loaded()) {
	 $this->fail('Model exists in fixture');
      }
      $machine->process('bar', array('bool' => true));
   }

}
