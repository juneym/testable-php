<?php
namespace Demo;

class TaskObject extends TaskAbstract {

    public function __construct($taskName, $status = self::STATUS_READY ) {
        $this->_taskName = $taskName;
        $this->_status = $status;
    }


    public function run($caller = null) {
        if ($this->_status == self::STATUS_DONE) {
            return true;
        }

        if ($this->_status != self::STATUS_READY) {
            return false;
        }

        //run dependency if available
        if (null != ($dep = $this->getDependency())) {
            $dep->run($this);
            unset($dep);
        }

        if (!empty($caller) && ($caller instanceof TaskAbstract)) {
            echo " Caller Task: " . sprintf("%-40s", $caller->getName());
        }

        echo " -> Running Task: {$this->_taskName}\n" ;

        $this->_status = self::STATUS_DONE;
    }

}
?>