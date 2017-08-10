<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Webhook\Core\EventFactory\RepositoryEventFactory;
use PhpSpec\ObjectBehavior;

class RepositoryEventFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepositoryEventFactory::class);
    }
}
