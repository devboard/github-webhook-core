<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\GitHubInstallation;
use Devboard\GitHub\Webhook\Core\Event\InstallationEvent;
use Devboard\GitHub\Webhook\Core\Event\InstallationEvent\InstallationAction;
use Devboard\GitHub\Webhook\Core\Event\Sender;
use PhpSpec\ObjectBehavior;

class InstallationEventSpec extends ObjectBehavior
{
    public function let(InstallationAction $action, GitHubInstallation $installation, Sender $sender)
    {
        $this->beConstructedWith($action, $installation, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationEvent::class);
    }

    public function it_should_expose_all_values_via_getters(
        InstallationAction $action, GitHubInstallation $installation, Sender $sender)
    {
        $this->getAction()->shouldReturn($action);
        $this->getInstallation()->shouldReturn($installation);
        $this->getSender()->shouldReturn($sender);
    }
}
