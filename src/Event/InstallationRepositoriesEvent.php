<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\GitHubInstallation;
use Devboard\GitHub\Webhook\Core\Event\InstallationRepositoriesEvent\InstallationRepositoriesAction;

/**
 * @see InstallationRepositoriesEventSpec
 * @see InstallationRepositoriesEventTest
 */
class InstallationRepositoriesEvent
{
    /** @var InstallationRepositoriesAction */
    private $action;
    /** @var GitHubInstallation */
    private $installation;
    /** @var array */
    private $reposAdded;
    /** @var array */
    private $reposRemoved;
    /** @var \Devboard\GitHub\Webhook\Core\Event\Sender */
    private $sender;

    public function __construct(
        InstallationRepositoriesAction $action,
        GitHubInstallation $installation,
        array $reposAdded,
        array $reposRemoved,
        Sender $sender
    ) {
        $this->action       = $action;
        $this->installation = $installation;
        $this->reposAdded   = $reposAdded;
        $this->reposRemoved = $reposRemoved;
        $this->sender       = $sender;
    }

    public function getAction(): InstallationRepositoriesAction
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
