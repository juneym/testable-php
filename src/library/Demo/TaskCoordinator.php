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
    public function run() {
        foreach ($this->_taskQueue as $q) {
            $q->run($this);
        }
    }

    /**
     * Task Cleanup
     */
    public function clearTasks() {
        unset($this->_taskQueue);
    }

    /**
     * @param TaskObject $t
     */
    public function addTask(TaskObject $t) {
        $this->_taskQueue[$t->getName()] = $t;
    }

}

?>