<?php
if(function_exists('xdebug_disable')) 
{ 
    xdebug_disable();
    ini_set("xdebug.overload_var_dump", "off"); 
}

include __DIR__ . '/../vendor/autoload.php';
        
require __DIR__.'/../includes/bank_entity_repository.php';

$personalBudget = $repository->retrieve($id);

if ($personalBudget->spend(amount_to_spend())) {
    echo "Spending succeeded";
} else {
    echo "Spending failed";
}

$repository->persist($personalBudget);