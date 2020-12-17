<?php
if(function_exists('xdebug_disable')) 
{ 
    xdebug_disable();
    ini_set("xdebug.overload_var_dump", "off"); 
}

include __DIR__ . '/../vendor/autoload.php';
        
$credit = 60;

$purchase = 80;

if ($credit >= $purchase) {
    $credit -= $purchase;
    echo "Purchase of $purchase is OK!";
} else {
    echo "Purchase of $purchase has failed.";
}