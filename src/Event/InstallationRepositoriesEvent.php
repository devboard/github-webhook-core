<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Event;

use Devboard\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\Event\InstallationRepositoriesEvent\InstallationRepositoriesAction;

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
    /** @var \DevboardLib\GitHubWebhook\Core\Event\Sender */
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
