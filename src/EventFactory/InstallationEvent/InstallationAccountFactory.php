<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\EventFactory\InstallationEvent;

use Devboard\GitHub\Account\GitHubAccountApiUrl;
use Devboard\GitHub\Account\GitHubAccountAvatarUrl;
use Devboard\GitHub\Account\GitHubAccountGravatarId;
use Devboard\GitHub\Account\GitHubAccountHtmlUrl;
use Devboard\GitHub\Account\GitHubAccountId;
use Devboard\GitHub\Account\GitHubAccountLogin;
use Devboard\GitHub\Account\GitHubAccountTypeFactory;
use Devboard\GitHub\Installation\GitHubInstallationAccount;

/**
 * @see InstallationAccountFactorySpec
 * @see InstallationAccountFactoryTest
 */
class InstallationAccountFactory
{
    public function create(array $data): GitHubInstallationAccount
    {
        return new GitHubInstallationAccount(
            new GitHubAccountId($data['id']),
            new GitHubAccountLogin($data['login']),
            GitHubAccountTypeFactory::create($data['type']),
            new GitHubAccountAvatarUrl($data['avatar_url']),
            new GitHubAccountGravatarId($data['gravatar_id']),
            new GitHubAccountHtmlUrl($data['html_url']),
            new GitHubAccountApiUrl($data['url']),
            $data['site_admin']
        );
    }
}
