<?php

interface shippingCompnayInterface{
    public function setRegion($inputRegion);
    public function getBasicCharge();
    public function getChargePerKilo();
}

class shippingCompnay implements shippingCompnayInterface{
    private $region= null;

    function __construct($region){
        $this->setRegion($region);
    }

    public function setRegion($inputRegion){
        if(!in_array($inputRegion, array_keys($this->basicCharge))){
            throw new Exception('Sorry, Service are not supported in your region...');
        }
        $this->region = $inputRegion;
    }

    public function getBasicCharge(){
        if(!$this->region) throw new Exception('Please set your region');
        return $this->basicCharge[$this->region];
    }

    public function getChargePerKilo(){
        if(!$this->region) throw new Exception('Please set your region');
        return $this->chargePerKilo[$this->region];
    }
}

class Dog extends shippingCompnay{
    protected $basicCharge = ['USA' => 0];
    protected $chargePerKilo = ['USA' => 60];
}

class Falcon extends shippingCompnay{
    protected $basicCharge = ['China' => 200, 'Taiwan' => 150];
    protected $chargePerKilo = ['China' => 20, 'Taiwan' => 30];
}

class Cat extends shippingCompnay{
    protected $basicCharge = ['Taiwan' => 100];
    protected $chargePerKilo = ['Taiwan' => 10];
}

class Tiger extends shippingCompnay{
    protected $basicCharge = ['Taiwan' => 60];
    protected $chargePerKilo = ['Taiwan' => 20];
}


interface calculator{
    function getTotalFee($weight);
}

class shippingAdapter implements calculator{
    function __construct($region, $company){
        $this->ShippingCompany = new $company($region);
    }

    public function getTotalFee($weight){
        return $this->ShippingCompany->getBasicCharge() + $this->ShippingCompany->getChargePerKilo() * $weight;
    }
}

try{
    $shipping = new shippingAdapter('Taiwan', 'Falcon');
    echo $shipping->getTotalFee(50).PHP_EOL;
}
catch(Exception $e){
    echo $e->getMessage();
    echo "\n";
}