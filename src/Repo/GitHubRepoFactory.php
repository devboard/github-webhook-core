<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\GitHubRepo;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoName;

/**
 * @see GitHubRepoFactorySpec
 * @see GitHubRepoFactoryTest
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GitHubRepoFactory
{
    /** @var GitHubRepoEndpointsFactory */
    private $endpointsFactory;
    /** @var GitHubRepoTimestampsFactory */
    private $timestampsFactory;
    /** @var GitHubRepoStatsFactory */
    private $statsFactory;

    public function __construct(
        GitHubRepoEndpointsFactory $endpointsFactory,
        GitHubRepoTimestampsFactory $timestampsFactory,
        GitHubRepoStatsFactory $statsFactory
    ) {
        $this->endpointsFactory  = $endpointsFactory;
        $this->timestampsFactory = $timestampsFactory;
        $this->statsFactory      = $statsFactory;
    }

    public function create(array $data): GitHubRepo
    {
        $repo = new GitHubRepo(
            new RepoId($data['id']),
            new RepoFullName(
                new AccountLogin($data['owner']['name']),
                new RepoName($data['name'])
            ),
            null,
            $data['private'],
            $this->endpointsFactory->create($data),
            $this->timestampsFactory->create($data),
            $this->statsFactory->create($data)
        );

        return $repo;
    }
}
