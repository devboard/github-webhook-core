<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Webhook\Core\EventFactory\DeploymentStatusEventFactory;
use PhpSpec\ObjectBehavior;

class DeploymentStatusEventFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DeploymentStatusEventFactory::class);
    }
}
