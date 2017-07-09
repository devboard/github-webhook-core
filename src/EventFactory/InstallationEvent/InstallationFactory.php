<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent;

use Devboard\GitHub\GitHubInstallation;
use Devboard\GitHub\Installation\ApplicationId;
use Devboard\GitHub\Installation\CreatedAt;
use Devboard\GitHub\Installation\Events;
use Devboard\GitHub\Installation\GitHubInstallationAccessTokenUrl;
use Devboard\GitHub\Installation\GitHubInstallationHtmlUrl;
use Devboard\GitHub\Installation\GitHubInstallationId;
use Devboard\GitHub\Installation\GitHubInstallationRepositoriesUrl;
use Devboard\GitHub\Installation\Permissions;
use Devboard\GitHub\Installation\RepositorySelectionFactory;
use Devboard\GitHub\Installation\UpdatedAt;

/**
 * @see InstallationFactorySpec
 * @see InstallationFactoryTest
 */
class InstallationFactory
{
    /**
     * @var \DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationAccountFactory
     */
    private $installationAccountFactory;

    public function __construct(InstallationAccountFactory $installationAccountFactory)
    {
        $this->installationAccountFactory = $installationAccountFactory;
    }

    public function create(array $data): GitHubInstallation
    {
        $account = $this->installationAccountFactory->create($data['account']);

        if (true === array_key_exists('repository_selection', $data)) {
            $repositorySelection = RepositorySelectionFactory::create($data['repository_selection']);
        } else {
            $repositorySelection = null;
        }

        return new GitHubInstallation(
            new GitHubInstallationId($data['id']),
            $account,
            new ApplicationId($data['app_id']),
            $repositorySelection,
            new Permissions($data['permissions']),
            new Events($data['events']),
            new GitHubInstallationAccessTokenUrl($data['access_tokens_url']),
            new GitHubInstallationRepositoriesUrl($data['repositories_url']),
            new GitHubInstallationHtmlUrl($data['html_url']),
            CreatedAt::createFromFormat('U', (string) $data['created_at']),
            UpdatedAt::createFromFormat('U', (string) $data['updated_at'])
        );
    }
}
