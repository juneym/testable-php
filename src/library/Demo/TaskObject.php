<?php
namespace Demo;

class TaskObject extends TaskAbstract {

    private $_taskName = "";
    private $_status;

    public function __construct($taskName) {
        $this->_taskName = $taskName;
        $this->_status = self::STATUS_READY;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->_taskName;
    }

    public function run() {
        if ($this->_status == self::STATUS_DONE) {
            return true;
        }

        if ($this->_status != self::STATUS_READY) {
            return false;
        }

        //run dependency if available
        if (!empty($this->dependency)) {
            $this->dependency->run($this);
        }

        echo "Running Task: {$this->_taskName} \n";
        $this->_status = self::STATUS_DONE;
    }

}
?>