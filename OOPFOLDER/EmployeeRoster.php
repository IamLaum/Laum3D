<?php

class EmployeeRoster {
    private $employees = [];
    private $size;

    public function __construct($size) {
        $this->size = $size;
    }

    public function add($employee) {
        if (count($this->employees) < $this->size) {
            $this->employees[] = $employee;
        } else {
            throw new Exception("Roster is full.");
        }
    }

    public function remove($empNum) {
        if (isset($this->employees[$empNum - 1])) {
            array_splice($this->employees, $empNum - 1, 1);
            return true;
        }
        return false;
    }

    public function count() {
        return count($this->employees);
    }

    public function getAvailableSlots() {
        return $this->size - count($this->employees);
    }

    public function display() {
        if (count($this->employees) === 0) {
            echo "No employees in the roster.\n";
            return;
        }
        foreach ($this->employees as $index => $employee) {
            echo ($index + 1) . ". " . $employee->getName() . "\n";
        }
    }

    public function payroll() {
        foreach ($this->employees as $employee) {
            echo $employee->getName() . ": " . $employee->calculatePay() . "\n";
        }
    }
}

?>
