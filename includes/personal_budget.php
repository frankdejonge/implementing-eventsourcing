<?php

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

class PersonalBudget implements AggregateRoot
{
    use AggregateRootBehaviour;

    private $budget = 0;

    public function increaseBudget(int $amount)
    {
        $this->recordThat(new BudgetWasIncreased($amount));
    }

    protected function applyBudgetWasIncreased(BudgetWasIncreased $event)
    {
        $this->budget += $event->amount();
    }

    protected function applyPurchaseWasMade(PurchaseWasMade $event)
    {
        $this->budget -= $event->amount();
    }

    protected function applyBudgetWasInsufficient() {}

    public function spend(int $amount)
    {
        if ($this->budget < $amount) {
            $this->recordThat(new BudgetWasInsufficient($amount));
            return false;
        }
        $this->recordThat(new PurchaseWasMade($amount));
        return true;
    }

    public static function create(AggregateRootId $id): PersonalBudget
    {
        return new PersonalBudget($id);
    }
}
