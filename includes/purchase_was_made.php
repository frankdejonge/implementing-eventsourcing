<?php

use EventSauce\EventSourcing\Serialization\SerializablePayload;

class PurchaseWasMade implements SerializablePayload
{
    private $amount;

    public function __construct(int $amount) {
        $this->amount = $amount;
    }

    public function amount(): int {
        return $this->amount;
    }

    public function toPayload(): array {
        return ['amount' => $this->amount];
    }

    public static function fromPayload(array $payload): SerializablePayload {
        return new static($payload['amount']);
    }
}
