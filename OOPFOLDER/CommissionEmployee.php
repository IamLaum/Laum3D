<?php

class CommissionEmployee {
    private $name;
    private $address;
    private $age;
    private $company;
    private $salary;
    private $itemsSold;
    private $commissionRate;

    public function __construct($name, $address, $age, $company, $salary, $itemsSold, $commissionRate) {
        $this->name = $name;
        $this->address = $address;
        $this->age = $age;
        $this->company = $company;
        $this->salary = $salary;
        $this->itemsSold = $itemsSold;
        $this->commissionRate = $commissionRate;
    }

    public function getName() {
        return $this->name;
    }

    public function calculatePay() {
        return $this->salary + ($this->itemsSold * $this->commissionRate / 100);
    }
}

?>
