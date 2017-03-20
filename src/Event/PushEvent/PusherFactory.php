<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\Event\PushEvent;

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
