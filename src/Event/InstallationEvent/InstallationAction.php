<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Event\InstallationEvent;

use Webmozart\Assert\Assert;

/**
 * @see InstallationActionSpec
 * @see InstallationActionTest
 */
class InstallationAction
{
    private $action;

    public function __construct(string $action)
    {
        Assert::oneOf($action, ['created', 'deleted']);
        $this->action = $action;
    }

    public function getValue(): string
    {
        return $this->action;
    }

    public function __toString(): string
    {
        return $this->action;
    }
}
