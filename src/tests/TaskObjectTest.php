<?php

require_once dirname(__FILE__) . "/../../vendor/autoload.php";
require_once dirname(__FILE__) . "/../library/autoloader.php";

class TaskObjectTest extends PHPUnit_Framework_TestCase {

    protected $_taskObj = null;

    public function setUp() {
        $this->_taskObj = new \Demo\TaskObject('Task1');
    }

    public function tearDown() {
        unset($this->_taskObj);
    }

    public function testShouldHaveSameName() {
        $this->assertEquals("Task1", $this->_taskObj->getName());
    }
}