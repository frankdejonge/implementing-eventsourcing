<?php

function fetch_credit() {
    $credit = 100;
    $purchases = [25, 37];
    foreach ($purchases as $purchase) $credit -= $purchase;

    return $credit;
}

var_dump(fetch_credit());