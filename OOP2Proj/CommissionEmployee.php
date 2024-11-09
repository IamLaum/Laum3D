<?php
require_once 'CommissionEmployee.php';
require_once 'HourlyEmployee.php';
require_once 'PieceWorker.php';

class EmployeeRoster {
    private $roster;
    private $nextId;

    public function __construct($rosterSize) {
        $this->roster = array_fill(0, $rosterSize, null);
        $this->nextId = 1;
    }


   public function add($employee) {
        for ($i = 0; $i < count($this->roster); $i++) {
            if ($this->roster[$i] === null) {
                $employee->setEmployeeId($this->nextId++); 
                $this->roster[$i] = $employee;
                return true;  // Return true to indicate success
            }
        }
        echo "Roster is full. Cannot add more employees.\n";
        return false; 
    }

    public function addCommissionEmployee($name, $address, $age, $companyName, $regularSalary, $itemsSold, $commissionRate) {
        $employee = new CommissionEmployee($name, $address, $age, $companyName, $regularSalary, $itemsSold, $commissionRate);
        return $this->add($employee);
    }


    public function addHourlyEmployee($name, $address, $age, $companyName, $hoursWorked, $rate) {
        $employee = new HourlyEmployee($name, $address, $age, $companyName, $hoursWorked, $rate);
        return $this->add($employee);
    }

    public function addPieceWorker($name, $address, $age, $companyName, $numberItems, $wagePerItem) {
        $employee = new PieceWorker($name, $address, $age, $companyName, $numberItems, $wagePerItem);
        return $this->add($employee);
    }

    public function deleteEmployee($employeeNumber) {
        if (isset($this->roster[$employeeNumber]) && $this->roster[$employeeNumber] !== null) {
            $this->roster[$employeeNumber] = null;
            return true;
        }
        return false;
    }

    public function countAll() {
        return count(array_filter($this->roster));
    }

    public function countCE() {
        return count(array_filter($this->roster, fn($e) => $e instanceof CommissionEmployee));
    }

    public function countHE() {
        return count(array_filter($this->roster, fn($e) => $e instanceof HourlyEmployee));
    }

    public function countPE() {
        return count(array_filter($this->roster, fn($e) => $e instanceof PieceWorker));
    }

    public function displayAll() {
        foreach ($this->roster as $employee) {
            if ($employee !== null) {
                echo $employee->toString(). "\n";
            }
        }
    }

    public function displayCE() {
        foreach ($this->roster as $key => $employee) {
            if ($employee instanceof CommissionEmployee) {
                echo "Commission Employee " . $employee->toString();
            }
        }
    }

    public function displayHE() {
        foreach ($this->roster as $key => $employee) {
            if ($employee instanceof HourlyEmployee) {
                echo "Hourly Employee:" . $employee->toString();
            }
        }
    }

    public function displayPE() {
        foreach ($this->roster as $key => $employee) {
            if ($employee instanceof PieceWorker) {
                echo "Piece Worker:" . $employee->toString();
            }
        }
    }

    public function calculateTotalPayroll() {
        $totalPayroll = 0;
        foreach ($this->roster as $employee) {
            if ($employee !== null) {
                $totalPayroll += $employee->earnings();
            }
        }
        return $totalPayroll;
    }

    public function count() {
        return count(array_filter($this->roster));
    }

    public function payroll() {
        foreach ($this->roster as $employee) {
            if ($employee !== null) echo $employee . "\n";
        }
    }
}
?>