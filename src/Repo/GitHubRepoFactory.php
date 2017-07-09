<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\GitHub\Account\GitHubAccountLogin;
use Devboard\GitHub\GitHubRepo;
use Devboard\GitHub\Repo\GitHubRepoFullName;
use Devboard\GitHub\Repo\GitHubRepoId;
use Devboard\GitHub\Repo\GitHubRepoName;

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
            new GitHubRepoId($data['id']),
            new GitHubRepoFullName(
                new GitHubAccountLogin($data['owner']['name']),
                new GitHubRepoName($data['name'])
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
