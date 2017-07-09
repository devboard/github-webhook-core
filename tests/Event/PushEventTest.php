<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Event;

use DevboardLib\GitHub\Account\Type\User;
use DevboardLib\GitHub\Commit\Author\CommitAuthorEmail;
use DevboardLib\GitHub\Commit\Author\CommitAuthorName;
use DevboardLib\GitHub\Commit\CommitAuthor;
use DevboardLib\GitHub\Commit\CommitAuthorDetails;
use DevboardLib\GitHub\Commit\CommitCommitter;
use DevboardLib\GitHub\Commit\CommitCommitterDetails;
use DevboardLib\GitHub\Commit\CommitDate;
use DevboardLib\GitHub\Commit\CommitMessage;
use DevboardLib\GitHub\Commit\CommitSha;
use DevboardLib\GitHub\Commit\Committer\CommitCommitterEmail;
use DevboardLib\GitHub\Commit\Committer\CommitCommitterName;
use DevboardLib\GitHub\GitHubCommit;
use DevboardLib\GitHub\GitHubRepo;
use DevboardLib\GitHub\Repo\RepoApiUrl;
use DevboardLib\GitHub\Repo\RepoCreatedAt;
use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoHtmlUrl;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoName;
use DevboardLib\GitHub\Repo\RepoOwner;
use DevboardLib\GitHub\Repo\RepoPushedAt;
use DevboardLib\GitHub\Repo\RepoSize;
use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHub\Repo\RepoUpdatedAt;
use DevboardLib\GitHub\User\UserApiUrl;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserEmailAddress;
use DevboardLib\GitHub\User\UserGravatarId;
use DevboardLib\GitHub\User\UserHtmlUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\CompareChangesUrl;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\PushEventState;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Ref;
use DevboardLib\GitHubWebhook\Core\Event\Sender;
use DevboardLib\GitHubWebhook\Core\CommitCollection;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Event\PushEvent
 * @group  unit
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class PushEventTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testGetters(
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
        $sut = new PushEvent(
            $ref, $before, $after, $state, $baseRef, $changesUrl, $commits, $headCommit, $repo, $pusher, $sender
        );

        $this->assertEquals($ref, $sut->getRef());
        $this->assertEquals($before, $sut->getBefore());
        $this->assertEquals($after, $sut->getAfter());
        $this->assertEquals($state, $sut->getState());
        $this->assertEquals($baseRef, $sut->getBaseRef());
        $this->assertEquals($changesUrl, $sut->getChangesUrl());
        $this->assertEquals($commits, $sut->getCommits());
        $this->assertEquals($headCommit, $sut->getHeadCommit());
        $this->assertEquals($repo, $sut->getRepo());
        $this->assertEquals($pusher, $sut->getPusher());
        $this->assertEquals($sender, $sut->getSender());
    }

    public function provideData()
    {
        return [
            [
                new Ref('refs/heads/dev'),
                new CommitSha('abc123'),
                new CommitSha('abc234'),
                new PushEventState(true, false, false),
                new Ref('refs/heads/master'),
                new CompareChangesUrl(
                    'https://github.com/devboard-test/super-library/compare/9049f1265b7d...0d1a26e67d8f'
                ),
                new CommitCollection(),
                new GitHubCommit(
                    new CommitSha('abc234'),
                    new CommitMessage('Message'),
                    new CommitDate('2017-02-03 11:22:33'),
                    new CommitAuthor(
                        new CommitAuthorName('name'),
                        new CommitAuthorEmail('nobody@example.com'),
                        new CommitDate('2017-02-03 11:22:33'),
                        new CommitAuthorDetails(
                            new UserId(13507412),
                            new UserLogin('devboard-test'),
                            new User(),
                            new UserAvatarUrl('https://avatars.githubusercontent.com/u/13507412?v=3'),
                            new UserGravatarId(''),
                            new UserHtmlUrl('https://github.com/devboard-test'),
                            new UserApiUrl('https://api.github.com/users/devboard-test'),
                            false
                        )
                    ),
                    new CommitCommitter(
                        new CommitCommitterName('name'),
                        new CommitCommitterEmail('nobody@example.com'),
                        new CommitDate('2017-02-03 11:22:33'),
                        new CommitCommitterDetails(
                            new UserId(13507412),
                            new UserLogin('devboard-test'),
                            new User(),
                            new UserAvatarUrl('https://avatars.githubusercontent.com/u/13507412?v=3'),
                            new UserGravatarId(''),
                            new UserHtmlUrl('https://github.com/devboard-test'),
                            new UserApiUrl('https://api.github.com/users/devboard-test'),
                            false
                        )
                    )
                ),
                new GitHubRepo(
                    new RepoId(1234),
                    new RepoFullName(
                        new UserLogin('devboard-test'), new RepoName('super-library')
                    ),
                    new RepoOwner(
                        new UserId(789),
                        new UserLogin('devboard-test'),
                        new User(),
                        new UserAvatarUrl('..'),
                        new UserGravatarId('..'),
                        new UserHtmlUrl('..'),
                        new UserApiUrl('..'),
                        false
                    ),
                    false,
                    new RepoEndpoints(
                        new RepoApiUrl('..'),
                        new RepoHtmlUrl('..')
                    ),
                    new RepoTimestamps(
                        new RepoCreatedAt('2017-01-02 11:22:33'),
                        new RepoUpdatedAt('2017-02-03 15:16:17'),
                        new RepoPushedAt('2017-03-04 22:23:24')
                    ),
                    new RepoStats(1, 2, 3, 4, new RepoSize(77))
                ),

                new Pusher(new UserLogin('devboard-test'), new UserEmailAddress('nobody@example.com')),
                new Sender(
                    new UserId(13507412),
                    new UserLogin('devboard-test'),
                    new User(),
                    new UserAvatarUrl('https://avatars.githubusercontent.com/u/13507412?v=3'),
                    new UserGravatarId(''),
                    new UserHtmlUrl('https://github.com/devboard-test'),
                    new UserApiUrl('https://api.github.com/users/devboard-test'),
                    false
                ),
            ],
        ];
    }
}
