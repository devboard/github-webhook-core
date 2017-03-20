<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event\PushEvent;

use Devboard\GitHub\Webhook\Core\Event\PushEvent\Pusher;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\PusherFactory;
use PhpSpec\ObjectBehavior;

class PusherFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PusherFactory::class);
    }

    public function it_will_create_pusher_value_object_from_given_array()
    {
        $data = [
            'name'  => 'devboard-test',
            'email' => 'noreply@example.com',
        ];

        $this->create($data)
            ->shouldReturnAnInstanceOf(Pusher::class);
    }
}
