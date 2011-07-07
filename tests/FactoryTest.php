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

}
