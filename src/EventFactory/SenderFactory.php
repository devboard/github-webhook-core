<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\EventFactory;

use DevboardLib\GitHub\Account\AccountTypeFactory;
use DevboardLib\GitHub\User\UserApiUrl;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserGravatarId;
use DevboardLib\GitHub\User\UserHtmlUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Event\Sender;

/**
 * @see SenderFactorySpec
 * @see SenderFactoryTest
 */
class SenderFactory
{
    public function create(array $data): Sender
    {
        return new Sender(
            new UserId($data['id']),
            new UserLogin($data['login']),
            AccountTypeFactory::create($data['type']),
            new UserAvatarUrl($data['avatar_url']),
            new UserGravatarId($data['gravatar_id']),
            new UserHtmlUrl($data['html_url']),
            new UserApiUrl($data['url']),
            $data['site_admin']
        );
    }
}
