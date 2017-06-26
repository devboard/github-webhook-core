<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core;

interface EventFactory
{
    public function getSupportedEventType(): string;
}