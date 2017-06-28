<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\GitHubInstallation;
use Devboard\GitHub\Webhook\Core\Event\InstallationRepositoriesEvent;
use Devboard\GitHub\Webhook\Core\Event\InstallationRepositoriesEvent\InstallationRepositoriesAction;
use Devboard\GitHub\Webhook\Core\Event\Sender;
use PhpSpec\ObjectBehavior;

class InstallationRepositoriesEventSpec extends ObjectBehavior
{
    public function let(
        InstallationRepositoriesAction $action,
        GitHubInstallation $installation,
        Sender $sender
    ) {
        $this->beConstructedWith($action, $installation, $reposAdded = [], $reposRemoved = [], $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationRepositoriesEvent::class);
    }

    public function it_should_expose_all_values_via_getters(
        InstallationRepositoriesAction $action,
        GitHubInstallation $installation,
        Sender $sender
    ) {
        $this->getAction()->shouldReturn($action);
        $this->getInstallation()->shouldReturn($installation);
        $this->getSender()->shouldReturn($sender);
    }
}
