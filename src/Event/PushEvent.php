<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\Commit\GitHubCommitSha;
use Devboard\GitHub\GitHubCommit;
use Devboard\GitHub\GitHubRepo;
use Devboard\GitHub\Webhook\Core\CompareChangesUrl;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\Pusher;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\PushEventState;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\Ref;
use Devboard\GitHub\Webhook\Core\GitHubCommitCollection;

/**
 * @see PushEventSpec
 * @see PushEventTest
 *
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class PushEvent
{
    /** @var Ref */
    private $ref;
    /** @var GitHubCommitSha */
    private $before;
    /** @var GitHubCommitSha */
    private $after;
    /** @var PushEventState */
    private $state;
    /** @var Ref */
    private $baseRef;
    /** @var CompareChangesUrl */
    private $changesUrl;
    /** @var GitHubCommitCollection */
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
        ?GitHubCommitSha $before,
        ?GitHubCommitSha $after,
        PushEventState $state,
        ?Ref $baseRef,
        CompareChangesUrl $changesUrl,
        GitHubCommitCollection $commits,
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

    public function getBefore(): ?GitHubCommitSha
    {
        return $this->before;
    }

    public function getAfter(): ?GitHubCommitSha
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

    public function getCommits(): GitHubCommitCollection
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
}
