<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Commit;

use Devboard\GitHub\Commit\Committer\GitHubCommitCommitterEmail;
use Devboard\GitHub\Commit\Committer\GitHubCommitCommitterName;
use Devboard\GitHub\Commit\GitHubCommitCommitter;
use Devboard\GitHub\Commit\GitHubCommitDate;

/**
 * @see GitHubCommitCommitterFactorySpec
 * @see GitHubCommitCommitterFactoryTest
 */
class GitHubCommitCommitterFactory
{
    public function create(array $data): GitHubCommitCommitter
    {
        return new GitHubCommitCommitter(
            new GitHubCommitCommitterName($data['committer']['name']),
            new GitHubCommitCommitterEmail($data['committer']['email']),
            new GitHubCommitDate($data['timestamp']),
            null
        );
    }
}
