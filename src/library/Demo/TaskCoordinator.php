<?php
namespace Demo;

class TaskCoordinator  extends TaskAbstract {

    /**
     * @var array
     */
    private $_taskQueue;

    /**
     * Task Runner
     */
    public function run($caller = null) {

        $this->_taskName = get_class($this);
        foreach ($this->_taskQueue as $q) {
            $q->run($this);
        }
    }

    /**
     * Task Cleanup
     */
    public function clearTasks() {
        unset($this->_taskQueue);
        $this->_taskQueue = array();
    }

    /**
     * @return int
     */
    public function getTaskCount() {
        return count($this->_taskQueue);
    }

    /**
     * @param TaskObject $t
     */
    public function addTask(TaskObject $t) {
        $this->_taskQueue[$t->getName()] = $t;
    }

    /**
     * @param $name
     * @throws Exception
     */
    public function getTask($name) {

        if (!isset($this->_taskQueue[$name])) {
            throw new Exception("Invalid Task: $name");
        }

        return $this->_taskQueue[$name];
    }

}

?>