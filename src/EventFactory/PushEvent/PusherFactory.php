<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\EventFactory\PushEvent;

use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher;

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
