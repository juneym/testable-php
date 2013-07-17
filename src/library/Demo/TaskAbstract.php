<?php
namespace Demo;

abstract class TaskAbstract {

    const STATUS_READY = 1;
    const STATUS_DONE  = 2;

    protected $dependency;
    protected $status;

    abstract public function run();

    public function getStatus() {
        return $this->status;
    }

    public function setDependency(TaskAbstract $task) {
        $this->dependency = $task;
    }

}
?>