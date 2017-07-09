<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Event;

use DevboardLib\GitHub\Commit\CommitSha;
use DevboardLib\GitHub\GitHubCommit;
use DevboardLib\GitHub\GitHubRepo;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHubWebhook\Core\CompareChangesUrl;
use DevboardLib\GitHubWebhook\Core\Event;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\PushEventState;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Ref;
use DevboardLib\GitHubWebhook\Core\CommitCollection;

/**
 * @see PushEventSpec
 * @see PushEventTest
 *
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class PushEvent implements Event
{
    /** @var Ref */
    private $ref;
    /** @var CommitSha */
    private $before;
    /** @var CommitSha */
    private $after;
    /** @var PushEventState */
    private $state;
    /** @var Ref */
    private $baseRef;
    /** @var CompareChangesUrl */
    private $changesUrl;
    /** @var CommitCollection */
    private $commits;
    /** @var GitHubCommit */
    private $headCommit;
    /** @var GitHubRepo */
    private $repo;
    /** @var Pusher */
    private $pusher;
    /** @var Sender */
    private $sender;

    public function __construct(
        Ref $ref,
        ?CommitSha $before,
        ?CommitSha $after,
        PushEventState $state,
        ?Ref $baseRef,
        CompareChangesUrl $changesUrl,
        CommitCollection $commits,
        ?GitHubCommit $headCommit,
        GitHubRepo $repo,
        Pusher $pusher,
        Sender $sender
    ) {
        $this->ref        = $ref;
        $this->before     = $before;
        $this->after      = $after;
        $this->state      = $state;
        $this->baseRef    = $baseRef;
        $this->changesUrl = $changesUrl;
        $this->commits    = $commits;
        $this->headCommit = $headCommit;
        $this->repo       = $repo;
        $this->pusher     = $pusher;
        $this->sender     = $sender;
    }

    public function getRef(): Ref
    {
        return $this->ref;
    }

    public function getBefore(): ?CommitSha
    {
        return $this->before;
    }

    public function getAfter(): ?CommitSha
    {
        return $this->after;
    }

    public function getState(): PushEventState
    {
        return $this->state;
    }

    public function getBaseRef(): ?Ref
    {
        return $this->baseRef;
    }

    public function getChangesUrl(): CompareChangesUrl
    {
        return $this->changesUrl;
    }

    public function getCommits(): CommitCollection
    {
        return $this->commits;
    }

    public function getHeadCommit(): ?GitHubCommit
    {
        return $this->headCommit;
    }

    public function getRepo(): GitHubRepo
    {
        return $this->repo;
    }

    public function getRepoFullName(): RepoFullName
    {
        return $this->repo->getFullName();
    }

    public function getPusher(): Pusher
    {
        return $this->pusher;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function isBranch(): bool
    {
        return $this->ref->isBranchReference();
    }

    public function isTag(): bool
    {
        return $this->ref->isTagReference();
    }

    public function isDeleted(): bool
    {
        return $this->state->isDeleted();
    }

    public function getName(): string
    {
        return $this->ref->getReferenceName();
    }
}
