<?php

class HourlyEmployee {
    private $name;
    private $address;
    private $age;
    private $company;
    private $hoursWorked;
    private $hourlyRate;

    public function __construct($name, $address, $age, $company, $hoursWorked, $hourlyRate) {
        $this->name = $name;
        $this->address = $address;
        $this->age = $age;
        $this->company = $company;
        $this->hoursWorked = $hoursWorked;
        $this->hourlyRate = $hourlyRate;
    }

    public function getName() {
        return $this->name;
    }

    public function calculatePay() {
        return $this->hoursWorked * $this->hourlyRate;
    }
}

?>
