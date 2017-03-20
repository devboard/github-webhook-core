<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\GitHubRepo;
use Devboard\GitHub\Repo\GitHubRepoEndpoints;
use Devboard\GitHub\Repo\GitHubRepoStats;
use Devboard\GitHub\Repo\GitHubRepoTimestamps;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoEndpointsFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoStatsFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoTimestampsFactory;
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
        GitHubRepoEndpoints $endpoints,
        GitHubRepoTimestamps $timestamps,
        GitHubRepoStats $stats
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
