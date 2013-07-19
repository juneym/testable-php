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

    /**
     * @expectedException  \Demo\CyclicDependencyException
     */
    public function testCantDoCyclicDependency() {

        $this->_taskObj->setDependency($this->_taskObj);
    }

    /**
     * @expectedException  \Demo\CyclicDependencyException
     */
    public function testCantDoCyclicDependencyScenario2() {
        $task1 = new \Demo\TaskObject('Task1');
        $task1->setDependency($this->_taskObj);
        $this->_taskObj->setDependency($task1);
    }


    public function testCanConfigureDependency() {
        $task2 = new \Demo\TaskObject('Task2');
        $this->_taskObj->setDependency($task2);
        $this->assertEquals($task2, $this->_taskObj->getDependency());
    }


    public function testStatusReadyByDefault() {
        $this->assertEquals(\Demo\TaskAbstract::STATUS_READY, $this->_taskObj->getStatus());
    }

    public function testChangeStateAfterRun() {
        $this->_taskObj->run(null);
        $this->assertEquals(\Demo\TaskAbstract::STATUS_DONE, $this->_taskObj->getStatus());
    }

    public function testTaskObjectStatusShouldBeDone() {
        $this->_taskObj = new \Demo\TaskObject('Task11', \Demo\TaskAbstract::STATUS_DONE);

        $this->assertEquals(\Demo\TaskAbstract::STATUS_DONE, $this->_taskObj->getStatus());
    }

    public function testTaskObjectStatusDoneWillNotRun() {
        $this->_taskObj = new \Demo\TaskObject('Task11', \Demo\TaskAbstract::STATUS_DONE);
        $this->assertEquals(\Demo\TaskAbstract::TASK_ALREADY_DONE, $this->_taskObj->run(null));
    }

    public function testTaskObjectStatusNotReadyWillNotRun() {
        $this->_taskObj = new \Demo\TaskObject('Task11', \Demo\TaskAbstract::STATUS_NOT_READY);
        $this->assertEquals(\Demo\TaskAbstract::TASK_NOT_READY, $this->_taskObj->run(null));
    }

}