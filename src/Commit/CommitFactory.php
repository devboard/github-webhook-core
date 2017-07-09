<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Commit;

use DevboardLib\GitHub\Commit\CommitDate;
use DevboardLib\GitHub\Commit\CommitMessage;
use DevboardLib\GitHub\Commit\CommitSha;
use DevboardLib\GitHub\GitHubCommit;

/**
 * @see CommitFactorySpec
 * @see CommitFactoryTest
 */
class CommitFactory
{
    /** @var CommitCommitterFactory */
    private $committerFactory;
    /** @var CommitAuthorFactory */
    private $authorFactory;

    public function __construct(CommitCommitterFactory $commitCommitterFactory, CommitAuthorFactory $authorFactory)
    {
        $this->committerFactory = $commitCommitterFactory;
        $this->authorFactory    = $authorFactory;
    }

    public function create(array $data): GitHubCommit
    {
        return new GitHubCommit(
            new CommitSha($data['id']),
            new CommitMessage($data['message']),
            new CommitDate($data['timestamp']),
            $this->authorFactory->create($data),
            $this->committerFactory->create($data)
        );
    }
}
