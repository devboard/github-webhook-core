<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Commit;

use DevboardLib\GitHub\Commit\CommitCommitter;
use DevboardLib\GitHub\Commit\CommitDate;
use DevboardLib\GitHub\Commit\Committer\CommitCommitterEmail;
use DevboardLib\GitHub\Commit\Committer\CommitCommitterName;

/**
 * @see GitHubCommitCommitterFactorySpec
 * @see GitHubCommitCommitterFactoryTest
 */
class GitHubCommitCommitterFactory
{
    public function create(array $data): CommitCommitter
    {
        return new CommitCommitter(
            new CommitCommitterName($data['committer']['name']),
            new CommitCommitterEmail($data['committer']['email']),
            new CommitDate($data['timestamp']),
            null
        );
    }
}
