<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\EventFactory;

use Devboard\GitHub\Commit\GitHubCommitSha;
use DevboardLib\GitHubWebhook\Core\Commit\GitHubCommitFactory;
use DevboardLib\GitHubWebhook\Core\CompareChangesUrl;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\PushEventState;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Ref;
use DevboardLib\GitHubWebhook\Core\EventFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\PushEvent\PusherFactory;
use DevboardLib\GitHubWebhook\Core\GitHubCommitCollection;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoFactory;

/**
 * @see PushEventFactorySpec
 * @see PushEventFactoryTest
 */
class PushEventFactory implements EventFactory
{
    /** @var GitHubCommitFactory */
    private $commitFactory;
    /** @var GitHubRepoFactory */
    private $repoFactory;
    /** @var PusherFactory */
    private $pusherFactory;
    /** @var SenderFactory */
    private $senderFactory;

    public function __construct(
        GitHubCommitFactory $commitFactory,
        GitHubRepoFactory $repoFactory,
        PusherFactory $pusherFactory,
        SenderFactory $senderFactory
    ) {
        $this->commitFactory = $commitFactory;
        $this->repoFactory   = $repoFactory;
        $this->pusherFactory = $pusherFactory;
        $this->senderFactory = $senderFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'push';
    }

    public function create(array $data): PushEvent
    {
        $ref     = null;
        $baseRef = null;

        if (null !== $data['ref']) {
            $ref = new Ref($data['ref']);
        }

        if (null !== $data['base_ref']) {
            $baseRef = new Ref($data['base_ref']);
        }

        $commit = null;

        if (null !== $data['head_commit']) {
            $commit = $this->commitFactory->create($data['head_commit']);
        }

        return new PushEvent(
            $ref,
            new GitHubCommitSha($data['before']),
            new GitHubCommitSha($data['after']),
            new PushEventState($data['created'], $data['deleted'], $data['forced']),
            $baseRef,
            new CompareChangesUrl($data['compare']),
            new GitHubCommitCollection(),
            $commit,
            $this->repoFactory->create($data['repository']),
            $this->pusherFactory->create($data['pusher']),
            $this->senderFactory->create($data['sender'])
        );
    }
}
