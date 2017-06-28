<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Webhook\Core\EventFactory;
use Devboard\GitHub\Webhook\Core\EventFactory\InstallationEvent\InstallationFactory;
use Devboard\GitHub\Webhook\Core\EventFactory\InstallationEventFactory;
use Devboard\GitHub\Webhook\Core\EventFactory\SenderFactory;
use PhpSpec\ObjectBehavior;

class InstallationEventFactorySpec extends ObjectBehavior
{
    public function let(
        InstallationFactory $installationFactory,
        SenderFactory $senderFactory
    ) {
        $this->beConstructedWith($installationFactory, $senderFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationEventFactory::class);
        $this->shouldImplement(EventFactory::class);
    }
}
