<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent;

use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountGravatarId;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountTypeFactory;
use DevboardLib\GitHub\Installation\InstallationAccount;

/**
 * @see InstallationAccountFactorySpec
 * @see InstallationAccountFactoryTest
 */
class InstallationAccountFactory
{
    public function create(array $data): InstallationAccount
    {
        return new InstallationAccount(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            AccountTypeFactory::create($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            new AccountGravatarId($data['gravatar_id']),
            new AccountHtmlUrl($data['html_url']),
            new AccountApiUrl($data['url']),
            $data['site_admin']
        );
    }
}
