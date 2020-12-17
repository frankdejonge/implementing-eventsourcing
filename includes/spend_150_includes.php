<?php

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;
use EventSauce\EventSourcing\ConstructingAggregateRootRepository;
use EventSauce\EventSourcing\Header;
use EventSauce\EventSourcing\InMemoryMessageRepository;
use EventSauce\EventSourcing\Message;
use EventSauce\EventSourcing\Serialization\SerializablePayload;
use EventSauce\EventSourcing\UuidAggregateRootId;

include_once __DIR__ . '/../vendor/autoload.php';

class_alias(UuidAggregateRootId::class, 'AggregateRootId');
class_alias(InMemoryMessageRepository::class, 'InMemoryMessageRepository');
class_alias(ConstructingAggregateRootRepository::class, 'AggregateRootRepository');
class_alias(Header::class, 'Header');
class_alias(Message::class, 'Message');

include_once __DIR__ . '/budget_was_increased.php';
include_once __DIR__ . '/budget_was_insufficient.php';
include_once __DIR__ . '/purchase_was_made.php';
include_once __DIR__ . '/personal_budget.php';
