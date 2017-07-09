<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Event;

use Devboard\GitHub\Commit\GitHubCommitSha;
use Devboard\GitHub\GitHubCommit;
use Devboard\GitHub\GitHubRepo;
use DevboardLib\GitHubWebhook\Core\CompareChangesUrl;
use DevboardLib\GitHubWebhook\Core\Event;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\PushEventState;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Ref;
use DevboardLib\GitHubWebhook\Core\Event\Sender;
use DevboardLib\GitHubWebhook\Core\GitHubCommitCollection;
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
        $this->shouldImplement(Event::class);
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

    public function it_exposes_if_push_event_is_for_a_branch(Ref $ref)
    {
        $ref->isBranchReference()->shouldBeCalled()->willReturn(true);
        $this->isBranch()->shouldReturn(true);
    }

    public function it_exposes_if_push_event_is_for_a_tag(Ref $ref)
    {
        $ref->isTagReference()->shouldBeCalled()->willReturn(true);
        $this->isTag()->shouldReturn(true);
    }

    public function it_exposes_if_this_is_a_delete_push_event(PushEventState $state)
    {
        $state->isDeleted()->shouldBeCalled()->willReturn(true);
        $this->isDeleted()->shouldReturn(true);
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
