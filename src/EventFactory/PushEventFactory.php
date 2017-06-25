<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Commit\GitHubCommitSha;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitFactory;
use Devboard\GitHub\Webhook\Core\CompareChangesUrl;
use Devboard\GitHub\Webhook\Core\Event\PushEvent;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\PushEventState;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\Ref;
use Devboard\GitHub\Webhook\Core\EventFactory\PushEvent\PusherFactory;
use Devboard\GitHub\Webhook\Core\GitHubCommitCollection;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoFactory;

/**
 * @see PushEventFactorySpec
 * @see PushEventFactoryTest
 */
class PushEventFactory
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

    public function create(array $data)
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
