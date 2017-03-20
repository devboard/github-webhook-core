<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoStats;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoStatsFactory;
use PhpSpec\ObjectBehavior;

class GitHubRepoStatsFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubRepoStatsFactory::class);
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

        $this->create($data)->shouldReturnAnInstanceOf(GitHubRepoStats::class);
    }
}
