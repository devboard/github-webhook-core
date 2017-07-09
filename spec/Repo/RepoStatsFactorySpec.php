<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHubWebhook\Core\Repo\RepoStatsFactory;
use PhpSpec\ObjectBehavior;

class RepoStatsFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoStatsFactory::class);
    }

    public function it_will_return_github_repo_stats_instance()
    {
        $data = [
          'forks_count'      => 1,
          'watchers_count'   => 2,
          'stargazers_count' => 3,
          'open_issues_count'=> 4,
          'size'             => 5,
        ];

        $this->create($data)->shouldReturnAnInstanceOf(RepoStats::class);
    }
}
