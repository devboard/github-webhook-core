<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\Repo\RepoSize;
use DevboardLib\GitHub\Repo\RepoStats;

/**
 * @see GitHubRepoStatsFactorySpec
 * @see GitHubRepoStatsFactoryTest
 */
class GitHubRepoStatsFactory
{
    public function create(array $data): RepoStats
    {
        return new RepoStats(
            $data['forks_count'],
            $data['watchers_count'],
            $data['stargazers_count'],
            $data['open_issues_count'],
            new RepoSize($data['size'])
        );
    }
}
