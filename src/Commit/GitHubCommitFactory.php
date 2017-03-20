<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\Commit;

use Devboard\GitHub\Commit\GitHubCommitDate;
use Devboard\GitHub\Commit\GitHubCommitMessage;
use Devboard\GitHub\Commit\GitHubCommitSha;
use Devboard\GitHub\GitHubCommit;

/**
 * @see GitHubCommitFactorySpec
 * @see GitHubCommitFactoryTest
 */
class GitHubCommitFactory
{
    /** @var GitHubCommitCommitterFactory */
    private $committerFactory;
    /** @var GitHubCommitAuthorFactory */
    private $authorFactory;

    public function __construct(GitHubCommitCommitterFactory $commitCommitterFactory, GitHubCommitAuthorFactory $authorFactory)
    {
        $this->committerFactory = $commitCommitterFactory;
        $this->authorFactory    = $authorFactory;
    }

    public function create(array $data): GitHubCommit
    {
        return new GitHubCommit(
            new GitHubCommitSha($data['id']),
            new GitHubCommitMessage($data['message']),
            new GitHubCommitDate($data['timestamp']),
            $this->authorFactory->create($data),
            $this->committerFactory->create($data)
        );
    }
}
