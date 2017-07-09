<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Commit;

use DevboardLib\GitHub\Commit\Author\CommitAuthorEmail;
use DevboardLib\GitHub\Commit\Author\CommitAuthorName;
use DevboardLib\GitHub\Commit\CommitAuthor;
use DevboardLib\GitHub\Commit\CommitDate;

/**
 * @see CommitAuthorFactorySpec
 * @see CommitAuthorFactoryTest
 */
class CommitAuthorFactory
{
    public function create(array $data): CommitAuthor
    {
        return new CommitAuthor(
            new CommitAuthorName($data['author']['name']),
            new CommitAuthorEmail($data['author']['email']),
            new CommitDate($data['timestamp']),
            null
        );
    }
}
