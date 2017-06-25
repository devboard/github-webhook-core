<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\User\GitHubUserApiUrl;
use Devboard\GitHub\User\GitHubUserAvatarUrl;
use Devboard\GitHub\User\GitHubUserGravatarId;
use Devboard\GitHub\User\GitHubUserHtmlUrl;
use Devboard\GitHub\User\GitHubUserId;
use Devboard\GitHub\User\GitHubUserLogin;
use Devboard\GitHub\User\GitHubUserTypeFactory;
use Devboard\GitHub\Webhook\Core\Event\Sender;

/**
 * @see SenderFactorySpec
 * @see SenderFactoryTest
 */
class SenderFactory
{
    public function create(array $data): Sender
    {
        return new Sender(
            new GitHubUserId($data['id']),
            new GitHubUserLogin($data['login']),
            GitHubUserTypeFactory::create($data['type']),
            new GitHubUserAvatarUrl($data['avatar_url']),
            new GitHubUserGravatarId($data['gravatar_id']),
            new GitHubUserHtmlUrl($data['html_url']),
            new GitHubUserApiUrl($data['url']),
            $data['site_admin']
        );
    }
}
