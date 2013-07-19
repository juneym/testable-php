<?php
namespace Demo;

abstract class TaskAbstract {

    const STATUS_READY = 1;
    const STATUS_DONE  = 2;

    protected $_dependency;
    protected $_status;
    protected $_taskName = "";


    abstract public function run($caller  = null);

    public function getStatus() {
        return $this->_status;
    }

    /**
     * Task Dependency
     *
     * @param TaskAbstract $task
     */
    public function setDependency(TaskAbstract $task) {

        if (($task === $this) || ($task->getDependency() === $this) || ($this->getDependency() === $task)) {
            throw new CyclicDependencyException("Can't depend on self");
        }
        $this->_dependency = $task;
    }

    /**
     * @return TaskAbstract
     */
    public function getDependency() {
        return $this->_dependency;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->_taskName;
    }

}
?>