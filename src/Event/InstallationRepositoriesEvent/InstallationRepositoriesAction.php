<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Event\InstallationRepositoriesEvent;

use Webmozart\Assert\Assert;

/**
 * @see InstallationRepositoriesActionSpec
 * @see InstallationRepositoriesActionTest
 */
class InstallationRepositoriesAction
{
    private $action;

    public function __construct(string $action)
    {
        Assert::oneOf($action, ['added', 'removed']);
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
