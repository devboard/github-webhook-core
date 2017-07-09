<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Event;

use Devboard\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\Event\InstallationEvent;
use DevboardLib\GitHubWebhook\Core\Event\InstallationEvent\InstallationAction;
use DevboardLib\GitHubWebhook\Core\Event\Sender;
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
