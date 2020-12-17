<?php

include_once __DIR__.'/../scripts/entity_models.php';

class BankAccountRepository
{
    public function retrieve()
    {
        return new PersonalBudget(150);
    }

    public function persist() {}
}

$id = 100;
$repository = new BankAccountRepository();

function amount_to_spend() {
    return rand(100, 200);
}