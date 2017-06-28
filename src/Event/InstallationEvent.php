<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\GitHubInstallation;
use Devboard\GitHub\Webhook\Core\Event\InstallationEvent\InstallationAction;

/**
 * @see InstallationEventSpec
 * @see InstallationEventTest
 */
class InstallationEvent
{
    /** @var InstallationAction */
    private $action;
    /** @var GitHubInstallation */
    private $installation;
    /** @var \Devboard\GitHub\Webhook\Core\Event\Sender */
    private $sender;

    public function __construct(InstallationAction $action, GitHubInstallation $installation, Sender $sender)
    {
        $this->action       = $action;
        $this->installation = $installation;
        $this->sender       = $sender;
    }

    public function getAction(): InstallationAction
    {
        return $this->action;
    }

    public function getInstallation(): GitHubInstallation
    {
        return $this->installation;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }
}
