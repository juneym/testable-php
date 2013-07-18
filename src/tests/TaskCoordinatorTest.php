<?php

require_once dirname(__FILE__) . "/../../vendor/autoload.php";
require_once dirname(__FILE__) . "/../library/autoloader.php";

class TaskCoordinatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \Demo\TaskCoordinator
     */
    protected $_taskCoord = null;

    public function setUp() {
        $this->_taskCoord = new \Demo\TaskCoordinator('Coordinator1');
    }

    public function tearDown() {
        unset($this->_taskCoord);
    }

    public function testShouldHaveSameName() {
        $this->assertEquals("Coordinator1", $this->_taskCoord->getName());
    }

    /**
     * @expectedException  \Demo\CyclicDependencyException
     */
    public function testCantDoCyclicDependency() {
        $this->_taskCoord->setDependency($this->_taskCoord);
    }


    public function testCanConfigureDependency() {
        $coord2 = new \Demo\TaskCoordinator('Coordinator2');
        $this->_taskCoord->setDependency($coord2);
        $this->assertEquals($coord2, $this->_taskCoord->getDependency());
    }


    public function testCanAddTask() {

        $task1 = new \Demo\TaskObject('Task1');
        $task2 = new \Demo\TaskObject('Task2');
        $this->_taskCoord->addTask($task1);
        $this->_taskCoord->addTask($task2);

        $this->assertEquals(2, $this->_taskCoord->getTaskCount());
        $this->assertEquals($task2, $this->_taskCoord->getTask('Task2'));
        $this->assertEquals($task1, $this->_taskCoord->getTask('Task1'));
    }


    public function testCanClearTask(){
        $task1 = new \Demo\TaskObject('Task1');
        $task2 = new \Demo\TaskObject('Task1');
        $this->_taskCoord->addTask($task1);
        $this->_taskCoord->addTask($task2);
        $this->_taskCoord->clearTasks();

        $this->assertEquals(0, $this->_taskCoord->getTaskCount());
    }

    /**
     * @expectedException \Demo\InvalidTaskException
     */
    public function testCanRaiseExceptionOnInvalidTaskQuery(){
        $this->_taskCoord->getTask('TaskXXXXX');
    }


    public function testCanRunTasks() {
        $task1 = new \Demo\TaskObject('Task1');
        $task2 = new \Demo\TaskObject('Task2');

        $this->_taskCoord->addTask($task1);
        $this->_taskCoord->addTask($task2);


        $this->assertTrue(true, $this->_taskCoord->run(null));
    }
}