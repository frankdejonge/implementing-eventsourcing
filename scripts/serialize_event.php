<?php
if(function_exists('xdebug_disable')) 
{ 
    xdebug_disable();
    ini_set("xdebug.overload_var_dump", "off"); 
}

include __DIR__ . '/../vendor/autoload.php';
        
require __DIR__.'/../includes/purchase_was_made.php';

$event1 = new PurchaseWasMade(150);

$payload = $event1->toPayload();

$event2 = PurchaseWasMade::fromPayload($payload);

var_dump('same', $event1 === $event2);

var_dump('equal', $event1 == $event2);