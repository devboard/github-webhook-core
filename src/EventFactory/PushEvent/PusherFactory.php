<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\EventFactory\PushEvent;

use Devboard\GitHub\Webhook\Core\Event\PushEvent\Pusher;

/**
 * @see PusherFactorySpec
 * @see PusherFactoryTest
 */
class PusherFactory
{
    public function create(array $data): Pusher
    {
        return Pusher::create($data['name'], $data['email']);
    }
}
