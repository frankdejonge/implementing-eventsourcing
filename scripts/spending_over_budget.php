<?php
if(function_exists('xdebug_disable')) 
{ 
    xdebug_disable();
    ini_set("xdebug.overload_var_dump", "off"); 
}

include __DIR__ . '/../vendor/autoload.php';
        
require __DIR__.'/../includes/spend_100_includes.php';

$personalBudget->increaseBudget(50);
$personalBudget->increaseBudget(100);
$personalBudget->spend(75);

// Can I spend 100 now?
var_dump($personalBudget->spend(100));