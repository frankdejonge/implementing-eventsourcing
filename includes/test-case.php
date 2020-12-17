<?php

include_once __DIR__.'/spend_150_includes.php';

use EventSauce\EventSourcing\AggregateRootId as Id;
use EventSauce\EventSourcing\AggregateRootTestCase;

class MakePurchase {
    /**
     * @var int
     */
    private $amount;

    /**
     * @var Id
     */
    private $id;

    public function __construct(Id $id, int $amount)
    {
        $this->amount = $amount;
        $this->id = $id;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function id(): Id
    {
        return $this->id;
    }
}

class PersonalBudgetTest extends AggregateRootTestCase
{
    protected function newAggregateRootId(): Id
    {
        return AggregateRootId::create();
    }

    protected function aggregateRootClassName(): string
    {
        return PersonalBudget::class;
    }

    protected function handle(object $command)
    {
        if ($command instanceof MakePurchase) {
            /** @var PersonalBudget $budget */
            $budget = $this->repository->retrieve($command->id());
            $budget->spend($command->amount());
            $this->repository->persist($budget);
        }
    }

    /**
     * @test
     */
    public function it_allows_to_spend_within_the_budget()
    {
        $id = $this->aggregateRootId();

        $this->given(
            new BudgetWasIncreased(100)
        )->when(
            new MakePurchase($id, 40)
        )->then(
            new PurchaseWasMade(40)
        );
    }

    /**
     * @test
     */
    public function it_disallows_to_spend_amounts_over_budget()
    {
        $id = $this->aggregateRootId();

        $this->given(
            new BudgetWasIncreased(100),
            new PurchaseWasMade(80)
        )->when(
            new MakePurchase($id, 40)
        )->then(
            new BudgetWasInsufficient(40)
        );
    }
}