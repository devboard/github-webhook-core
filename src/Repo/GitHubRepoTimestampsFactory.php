<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\Repo\RepoCreatedAt;
use DevboardLib\GitHub\Repo\RepoPushedAt;
use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHub\Repo\RepoUpdatedAt;

/**
 * @see GitHubRepoTimestampsFactorySpec
 * @see GitHubRepoTimestampsFactoryTest
 */
class GitHubRepoTimestampsFactory
{
    public function create(array $data): RepoTimestamps
    {
        return new RepoTimestamps(
            new RepoCreatedAt(gmdate("Y-m-d\TH:i:s\Z", $data['created_at'])),
            new RepoUpdatedAt($data['updated_at']),
            new RepoPushedAt(gmdate("Y-m-d\TH:i:s\Z", $data['pushed_at']))
        );
    }
}
