<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\EventFactory;

use DevboardLib\GitHub\GitHubCommit;
use DevboardLib\GitHub\GitHubRepo;
use DevboardLib\GitHubWebhook\Core\Commit\GitHubCommitFactory;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher;
use DevboardLib\GitHubWebhook\Core\Event\Sender;
use DevboardLib\GitHubWebhook\Core\EventFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\PushEvent\PusherFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\PushEventFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoFactory;
use PhpSpec\ObjectBehavior;

class PushEventFactorySpec extends ObjectBehavior
{
    public function let(
        GitHubCommitFactory $commitFactory,
        GitHubRepoFactory $repoFactory,
        PusherFactory $pusherFactory,
        SenderFactory $senderFactory
    ) {
        $this->beConstructedWith($commitFactory, $repoFactory, $pusherFactory, $senderFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PushEventFactory::class);
        $this->shouldImplement(EventFactory::class);
    }

    public function it_supports_push_event_type()
    {
        $this->getSupportedEventType()->shouldReturn('push');
    }

    public function it_will_return_push_event_instance_from_given_array(
        GitHubCommitFactory $commitFactory,
        GitHubRepoFactory $repoFactory,
        PusherFactory $pusherFactory,
        SenderFactory $senderFactory,
        GitHubCommit $commit,
        GitHubRepo $repo,
        Pusher $pusher,
        Sender $sender
    ) {
        $data = [
            'ref'         => 'refs/heads/dev',
            'before'      => 'abc123',
            'after'       => 'asbc234',
            'created'     => false,
            'deleted'     => false,
            'forced'      => false,
            'base_ref'    => 'refs/heads/master',
            'compare'     => 'https://github.com/devboard-test/super-library/compare/a12589f209f3...91473c03e04b',
            'head_commit' => ['commit_data'],
            'repository'  => ['repository_data'],
            'pusher'      => ['pusher_data'],
            'sender'      => ['sender_data'],
        ];

        $commitFactory->create(['commit_data'])
            ->shouldBeCalled()
            ->willReturn($commit);

        $repoFactory->create(['repository_data'])
            ->shouldBeCalled()
            ->willReturn($repo);

        $pusherFactory->create(['pusher_data'])
            ->shouldBeCalled()
            ->willReturn($pusher);

        $senderFactory->create(['sender_data'])
            ->shouldBeCalled()
            ->willReturn($sender);

        $this->create($data)
            ->shouldReturnAnInstanceOf(PushEvent::class);
    }
}
