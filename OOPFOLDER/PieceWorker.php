<?php

class PieceWorker {
    private $name;
    private $address;
    private $age;
    private $company;
    private $itemsProduced;
    private $wagePerItem;

    public function __construct($name, $address, $age, $company, $itemsProduced, $wagePerItem) {
        $this->name = $name;
        $this->address = $address;
        $this->age = $age;
        $this->company = $company;
        $this->itemsProduced = $itemsProduced;
        $this->wagePerItem = $wagePerItem;
    }

    public function getName() {
        return $this->name;
    }

    public function calculatePay() {
        return $this->itemsProduced * $this->wagePerItem;
    }
}

?>
