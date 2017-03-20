<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\Commit\Author\GitHubCommitAuthorEmail;
use Devboard\GitHub\Commit\Author\GitHubCommitAuthorName;
use Devboard\GitHub\Commit\Committer\GitHubCommitCommitterEmail;
use Devboard\GitHub\Commit\Committer\GitHubCommitCommitterName;
use Devboard\GitHub\Commit\GitHubCommitAuthor;
use Devboard\GitHub\Commit\GitHubCommitAuthorDetails;
use Devboard\GitHub\Commit\GitHubCommitCommitter;
use Devboard\GitHub\Commit\GitHubCommitCommitterDetails;
use Devboard\GitHub\Commit\GitHubCommitDate;
use Devboard\GitHub\Commit\GitHubCommitMessage;
use Devboard\GitHub\Commit\GitHubCommitSha;
use Devboard\GitHub\GitHubCommit;
use Devboard\GitHub\GitHubRepo;
use Devboard\GitHub\Repo\GitHubRepoApiUrl;
use Devboard\GitHub\Repo\GitHubRepoCreatedAt;
use Devboard\GitHub\Repo\GitHubRepoEndpoints;
use Devboard\GitHub\Repo\GitHubRepoFullName;
use Devboard\GitHub\Repo\GitHubRepoHtmlUrl;
use Devboard\GitHub\Repo\GitHubRepoId;
use Devboard\GitHub\Repo\GitHubRepoName;
use Devboard\GitHub\Repo\GitHubRepoOwner;
use Devboard\GitHub\Repo\GitHubRepoPushedAt;
use Devboard\GitHub\Repo\GitHubRepoSize;
use Devboard\GitHub\Repo\GitHubRepoStats;
use Devboard\GitHub\Repo\GitHubRepoTimestamps;
use Devboard\GitHub\Repo\GitHubRepoUpdatedAt;
use Devboard\GitHub\User\GitHubUserApiUrl;
use Devboard\GitHub\User\GitHubUserAvatarUrl;
use Devboard\GitHub\User\GitHubUserEmailAddress;
use Devboard\GitHub\User\GitHubUserGravatarId;
use Devboard\GitHub\User\GitHubUserHtmlUrl;
use Devboard\GitHub\User\GitHubUserId;
use Devboard\GitHub\User\GitHubUserLogin;
use Devboard\GitHub\User\Type\User;
use Devboard\GitHub\Webhook\Core\CompareChangesUrl;
use Devboard\GitHub\Webhook\Core\Event\PushEvent;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\Pusher;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\PushEventState;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\Ref;
use Devboard\GitHub\Webhook\Core\Event\Sender;
use Devboard\GitHub\Webhook\Core\GitHubCommitCollection;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Event\PushEvent
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
                new GitHubCommitSha('abc123'),
                new GitHubCommitSha('abc234'),
                new PushEventState(true, false, false),
                new Ref('refs/heads/master'),
                new CompareChangesUrl(
                    'https://github.com/devboard-test/super-library/compare/9049f1265b7d...0d1a26e67d8f'
                ),
                new GitHubCommitCollection(),
                new GitHubCommit(
                    new GitHubCommitSha('abc234'),
                    new GitHubCommitMessage('Message'),
                    new GitHubCommitDate('2017-02-03 11:22:33'),
                    new GitHubCommitAuthor(
                        new GitHubCommitAuthorName('name'),
                        new GitHubCommitAuthorEmail('nobody@example.com'),
                        new GitHubCommitDate('2017-02-03 11:22:33'),
                        new GitHubCommitAuthorDetails(
                            new GitHubUserId(13507412),
                            new GitHubUserLogin('devboard-test'),
                            new User(),
                            new GitHubUserAvatarUrl('https://avatars.githubusercontent.com/u/13507412?v=3'),
                            new GitHubUserGravatarId(''),
                            new GitHubUserHtmlUrl('https://github.com/devboard-test'),
                            new GitHubUserApiUrl('https://api.github.com/users/devboard-test'),
                            false
                        )
                    ),
                    new GitHubCommitCommitter(
                        new GitHubCommitCommitterName('name'),
                        new GitHubCommitCommitterEmail('nobody@example.com'),
                        new GitHubCommitDate('2017-02-03 11:22:33'),
                        new GitHubCommitCommitterDetails(
                            new GitHubUserId(13507412),
                            new GitHubUserLogin('devboard-test'),
                            new User(),
                            new GitHubUserAvatarUrl('https://avatars.githubusercontent.com/u/13507412?v=3'),
                            new GitHubUserGravatarId(''),
                            new GitHubUserHtmlUrl('https://github.com/devboard-test'),
                            new GitHubUserApiUrl('https://api.github.com/users/devboard-test'),
                            false
                        )
                    )
                ),
                new GitHubRepo(
                    new GitHubRepoId(1234),
                    new GitHubRepoFullName(
                        new GitHubUserLogin('devboard-test'), new GitHubRepoName('super-library')
                    ),
                    new GitHubRepoOwner(
                        new GitHubUserId(789),
                        new GitHubUserLogin('devboard-test'),
                        new User(),
                        new GitHubUserAvatarUrl('..'),
                        new GitHubUserGravatarId('..'),
                        new GitHubUserHtmlUrl('..'),
                        new GitHubUserApiUrl('..'),
                        false
                    ),
                    false,
                    new GitHubRepoEndpoints(
                        new GitHubRepoApiUrl('..'),
                        new GitHubRepoHtmlUrl('..')
                    ),
                    new GitHubRepoTimestamps(
                        new GitHubRepoCreatedAt('2017-01-02 11:22:33'),
                        new GitHubRepoUpdatedAt('2017-02-03 15:16:17'),
                        new GitHubRepoPushedAt('2017-03-04 22:23:24')
                    ),
                    new GitHubRepoStats(1, 2, 3, 4, new GitHubRepoSize(77))
                ),

                new Pusher(new GitHubUserLogin('devboard-test'), new GitHubUserEmailAddress('nobody@example.com')),
                new Sender(
                    new GitHubUserId(13507412),
                    new GitHubUserLogin('devboard-test'),
                    new User(),
                    new GitHubUserAvatarUrl('https://avatars.githubusercontent.com/u/13507412?v=3'),
                    new GitHubUserGravatarId(''),
                    new GitHubUserHtmlUrl('https://github.com/devboard-test'),
                    new GitHubUserApiUrl('https://api.github.com/users/devboard-test'),
                    false
                ),
            ],
        ];
    }
}
