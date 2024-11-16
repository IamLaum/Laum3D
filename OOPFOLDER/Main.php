<?php

require_once 'EmployeeRoster.php';
require_once 'CommissionEmployee.php';
require_once 'HourlyEmployee.php';
require_once 'PieceWorker.php';

class Main {
    private EmployeeRoster $roster;
    private $systemState = [
        'size' => 0,
        'isRunning' => true
    ];

    public function start() {
        echo "Enter roster size: ";
        $size = trim(fgets(STDIN));
        $this->systemState['size'] = (int)$size;
        $this->roster = new EmployeeRoster($this->systemState['size']);
        $this->mainLoop();
    }

    private function mainLoop() {
        while ($this->systemState['isRunning']) {
            echo "\n[1] Add Employee\n[2] Delete Employee\n[3] View Employees\n[4] Payroll\n[0] Exit\n";
            echo "Select an option: ";
            $choice = trim(fgets(STDIN));

            switch ($choice) {
                case 1: $this->handleEmployeeAddition(); break;
                case 2: $this->handleEmployeeDeletion(); break;
                case 3: $this->roster->display(); break;
                case 4: $this->roster->payroll(); break;
                case 0: $this->systemState['isRunning'] = false; break;
                default: echo "Invalid choice. Try again.\n"; break;
            }
        }
    }

    private function handleEmployeeAddition() {
        if ($this->roster->getAvailableSlots() === 0) {
            echo "Roster is full.\n";
            return;
        }

        echo "Enter name: ";
        $name = trim(fgets(STDIN));
        echo "Enter address: ";
        $address = trim(fgets(STDIN));
        echo "Enter age: ";
        $age = trim(fgets(STDIN));
        echo "Enter company name: ";
        $company = trim(fgets(STDIN));

        echo "[1] Commission Employee\n[2] Hourly Employee\n[3] Piece Worker\n";
        echo "Select employee type: ";
        $type = trim(fgets(STDIN));

        switch ($type) {
            case 1:
                echo "Enter regular salary: ";
                $salary = trim(fgets(STDIN));
                echo "Enter items sold: ";
                $itemsSold = trim(fgets(STDIN));
                echo "Enter commission rate (%): ";
                $commissionRate = trim(fgets(STDIN));
                $employee = new CommissionEmployee($name, $address, $age, $company, $salary, $itemsSold, $commissionRate);
                break;
            case 2:
                echo "Enter hours worked: ";
                $hoursWorked = trim(fgets(STDIN));
                echo "Enter hourly rate: ";
                $hourlyRate = trim(fgets(STDIN));
                $employee = new HourlyEmployee($name, $address, $age, $company, $hoursWorked, $hourlyRate);
                break;
            case 3:
                echo "Enter number of items produced: ";
                $itemsProduced = trim(fgets(STDIN));
                echo "Enter wage per item: ";
                $wagePerItem = trim(fgets(STDIN));
                $employee = new PieceWorker($name, $address, $age, $company, $itemsProduced, $wagePerItem);
                break;
            default:
                echo "Invalid employee type.\n";
                return;
        }

        $this->roster->add($employee);
        echo "Employee added.\n";
    }

    private function handleEmployeeDeletion() {
        echo "Enter employee number to delete: ";
        $empNum = trim(fgets(STDIN));

        if ($this->roster->remove((int)$empNum)) {
            echo "Employee removed.\n";
        } else {
            echo "Failed to delete employee. Invalid number.\n";
        }
    }
}

$main = new Main();
$main->start();

?>
