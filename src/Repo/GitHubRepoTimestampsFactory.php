<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoCreatedAt;
use Devboard\GitHub\Repo\GitHubRepoPushedAt;
use Devboard\GitHub\Repo\GitHubRepoTimestamps;
use Devboard\GitHub\Repo\GitHubRepoUpdatedAt;

/**
 * @see GitHubRepoTimestampsFactorySpec
 * @see GitHubRepoTimestampsFactoryTest
 */
class GitHubRepoTimestampsFactory
{
    public function create(array $data): GitHubRepoTimestamps
    {
        return new GitHubRepoTimestamps(
            new GitHubRepoCreatedAt(gmdate("Y-m-d\TH:i:s\Z", $data['created_at'])),
            new GitHubRepoUpdatedAt($data['updated_at']),
            new GitHubRepoPushedAt(gmdate("Y-m-d\TH:i:s\Z", $data['pushed_at']))
        );
    }
}
