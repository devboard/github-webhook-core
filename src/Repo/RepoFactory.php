<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\GitHubRepo;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoName;

/**
 * @see RepoFactorySpec
 * @see RepoFactoryTest
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RepoFactory
{
    /** @var RepoEndpointsFactory */
    private $endpointsFactory;
    /** @var RepoTimestampsFactory */
    private $timestampsFactory;
    /** @var RepoStatsFactory */
    private $statsFactory;

    public function __construct(
        RepoEndpointsFactory $endpointsFactory,
        RepoTimestampsFactory $timestampsFactory,
        RepoStatsFactory $statsFactory
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
