<?php
if(function_exists('xdebug_disable'))
{
    xdebug_disable();
    ini_set("xdebug.overload_var_dump", "off");
}

include __DIR__ . '/../vendor/autoload.php';

require __DIR__.'/../includes/fetch_credit.php';

$credit = fetch_credit();
echo "Credit is $credit\n";
$purchase = 80;

if ($credit >= $purchase) {
    $credit -= $purchase;
    echo "Purchase of $purchase is OK!";
} else {
    echo "Purchase of $purchase has failed.";
}
