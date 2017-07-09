<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core;

interface EventFactory
{
    public function getSupportedEventType(): string;
}
