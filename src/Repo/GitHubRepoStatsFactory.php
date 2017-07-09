<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoSize;
use Devboard\GitHub\Repo\GitHubRepoStats;

/**
 * @see GitHubRepoStatsFactorySpec
 * @see GitHubRepoStatsFactoryTest
 */
class GitHubRepoStatsFactory
{
    public function create(array $data): GitHubRepoStats
    {
        return new GitHubRepoStats(
            $data['forks_count'],
            $data['watchers_count'],
            $data['stargazers_count'],
            $data['open_issues_count'],
            new GitHubRepoSize($data['size'])
        );
    }
}
