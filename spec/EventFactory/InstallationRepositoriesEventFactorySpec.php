<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\EventFactory;

use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationRepositoriesEventFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\SenderFactory;
use PhpSpec\ObjectBehavior;

class InstallationRepositoriesEventFactorySpec extends ObjectBehavior
{
    public function let(
        InstallationFactory $installationFactory,
        SenderFactory $senderFactory
    ) {
        $this->beConstructedWith($installationFactory, $senderFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationRepositoriesEventFactory::class);
    }
}
