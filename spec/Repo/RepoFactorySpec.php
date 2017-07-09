<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\GitHubRepo;
use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHubWebhook\Core\Repo\RepoEndpointsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\RepoFactory;
use DevboardLib\GitHubWebhook\Core\Repo\RepoStatsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\RepoTimestampsFactory;
use PhpSpec\ObjectBehavior;

class RepoFactorySpec extends ObjectBehavior
{
    public function let(
        RepoEndpointsFactory $endpointsFactory,
        RepoTimestampsFactory $timestampsFactory,
        RepoStatsFactory $statsFactory
    ) {
        $this->beConstructedWith($endpointsFactory, $timestampsFactory, $statsFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoFactory::class);
    }

    public function it_will_return_github_repo_instance(
        RepoEndpointsFactory $endpointsFactory,
        RepoTimestampsFactory $timestampsFactory,
        RepoStatsFactory $statsFactory,
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
