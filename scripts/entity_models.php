<?php
if(function_exists('xdebug_disable')) 
{ 
    xdebug_disable();
    ini_set("xdebug.overload_var_dump", "off"); 
}

include __DIR__ . '/../vendor/autoload.php';
        
class PersonalBudget {
    private $credit;
    public function __construct(int $credit) {
        $this->credit = $credit;
    }
    public function spend(int $amount): bool {
        if ($amount > $this->credit) return false;

        $this->credit -= $amount;

        return true;
    }
}