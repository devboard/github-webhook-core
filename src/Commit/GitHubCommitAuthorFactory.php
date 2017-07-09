<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Commit;

use Devboard\GitHub\Commit\Author\GitHubCommitAuthorEmail;
use Devboard\GitHub\Commit\Author\GitHubCommitAuthorName;
use Devboard\GitHub\Commit\GitHubCommitAuthor;
use Devboard\GitHub\Commit\GitHubCommitDate;

/**
 * @see GitHubCommitAuthorFactorySpec
 * @see GitHubCommitAuthorFactoryTest
 */
class GitHubCommitAuthorFactory
{
    public function create(array $data): GitHubCommitAuthor
    {
        return new GitHubCommitAuthor(
            new GitHubCommitAuthorName($data['author']['name']),
            new GitHubCommitAuthorEmail($data['author']['email']),
            new GitHubCommitDate($data['timestamp']),
            null
        );
    }
}
