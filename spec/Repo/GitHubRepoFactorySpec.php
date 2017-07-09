<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\GitHubRepo;
use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoEndpointsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoStatsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoTimestampsFactory;
use PhpSpec\ObjectBehavior;

class GitHubRepoFactorySpec extends ObjectBehavior
{
    public function let(
        GitHubRepoEndpointsFactory $endpointsFactory,
        GitHubRepoTimestampsFactory $timestampsFactory,
        GitHubRepoStatsFactory $statsFactory
    ) {
        $this->beConstructedWith($endpointsFactory, $timestampsFactory, $statsFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubRepoFactory::class);
    }

    public function it_will_return_github_repo_instance(
        GitHubRepoEndpointsFactory $endpointsFactory,
        GitHubRepoTimestampsFactory $timestampsFactory,
        GitHubRepoStatsFactory $statsFactory,
        RepoEndpoints $endpoints,
        RepoTimestamps $timestamps,
        RepoStats $stats
    ) {
        $data = [
            'id'    => 123,
            'owner' => [
                'name' => 'devboard-test',
            ],
            'name'    => 'super-library',
            'private' => false,
        ];

        $endpointsFactory->create($data)->shouldBeCalled()->willReturn($endpoints);
        $timestampsFactory->create($data)->shouldBeCalled()->willReturn($timestamps);
        $statsFactory->create($data)->shouldBeCalled()->willReturn($stats);

        $this->create($data)->shouldReturnAnInstanceOf(GitHubRepo::class);
    }
}
