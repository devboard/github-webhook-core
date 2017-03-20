<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\Commit\GitHubCommitSha;
use Devboard\GitHub\GitHubCommit;
use Devboard\GitHub\GitHubRepo;
use Devboard\GitHub\Webhook\Core\CompareChangesUrl;
use Devboard\GitHub\Webhook\Core\Event\PushEvent;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\Pusher;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\PushEventState;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\Ref;
use Devboard\GitHub\Webhook\Core\Event\Sender;
use Devboard\GitHub\Webhook\Core\GitHubCommitCollection;
use PhpSpec\ObjectBehavior;

class PushEventSpec extends ObjectBehavior
{
    public function let(
        Ref $ref,
        GitHubCommitSha $before,
        GitHubCommitSha $after,
        PushEventState $state,
        Ref $baseRef,
        CompareChangesUrl $changesUrl,
        GitHubCommitCollection $commits,
        GitHubCommit $headCommit,
        GitHubRepo $repo,
        Pusher $pusher,
        Sender $sender
    ) {
        $this->beConstructedWith(
            $ref, $before, $after, $state, $baseRef, $changesUrl, $commits, $headCommit, $repo, $pusher, $sender
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PushEvent::class);
    }

    public function it_exposes_constructor_arguments(
        Ref $ref,
        GitHubCommitSha $before,
        GitHubCommitSha $after,
        PushEventState $state,
        Ref $baseRef,
        CompareChangesUrl $changesUrl,
        GitHubCommitCollection $commits,
        GitHubCommit $headCommit,
        GitHubRepo $repo,
        Pusher $pusher,
        Sender $sender
    ) {
        $this->getRef()->shouldReturn($ref);
        $this->getBefore()->shouldReturn($before);
        $this->getAfter()->shouldReturn($after);
        $this->getState()->shouldReturn($state);
        $this->getBaseRef()->shouldReturn($baseRef);
        $this->getChangesUrl()->shouldReturn($changesUrl);
        $this->getCommits()->shouldReturn($commits);
        $this->getHeadCommit()->shouldReturn($headCommit);
        $this->getRepo()->shouldReturn($repo);
        $this->getPusher()->shouldReturn($pusher);
        $this->getSender()->shouldReturn($sender);
    }

    public function it_has_no_after_and_head_commit_for_delete(
        Ref $ref,
        GitHubCommitSha $before,
        PushEventState $state,
        Ref $baseRef,
        CompareChangesUrl $changesUrl,
        GitHubCommitCollection $commits,
        GitHubRepo $repo,
        Pusher $pusher,
        Sender $sender
    ) {
        $this->beConstructedWith(
            $ref, $before, null, $state, $baseRef, $changesUrl, $commits, null, $repo, $pusher, $sender
        );

        $this->getAfter()->shouldReturn(null);
        $this->getHeadCommit()->shouldReturn(null);
    }

    public function it_has_no_before_when_creating(
        Ref $ref,
        GitHubCommitSha $after,
        PushEventState $state,
        Ref $baseRef,
        CompareChangesUrl $changesUrl,
        GitHubCommitCollection $commits,
        GitHubCommit $headCommit,
        GitHubRepo $repo,
        Pusher $pusher,
        Sender $sender
    ) {
        $this->beConstructedWith(
            $ref, null, $after, $state, $baseRef, $changesUrl, $commits, $headCommit, $repo, $pusher, $sender
        );
        $this->getBefore()->shouldReturn(null);
    }
}
