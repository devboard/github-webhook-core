<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\Webhook\Core\Event\FollowEvent;
use PhpSpec\ObjectBehavior;

class FollowEventSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FollowEvent::class);
    }
}
