<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\Account\GitHubAccountType;
use Devboard\GitHub\Account\Type\Organization;
use Devboard\GitHub\Account\Type\User;
use Devboard\GitHub\User\GitHubUserApiUrl;
use Devboard\GitHub\User\GitHubUserAvatarUrl;
use Devboard\GitHub\User\GitHubUserGravatarId;
use Devboard\GitHub\User\GitHubUserHtmlUrl;
use Devboard\GitHub\User\GitHubUserId;
use Devboard\GitHub\User\GitHubUserLogin;
use Devboard\GitHub\Webhook\Core\Event\Sender;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Event\Sender
 * @group  unit
 */
class SenderTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideArguments */
    public function testCreating(
        GitHubUserId $userId,
        GitHubUserLogin $login,
        GitHubAccountType $gitHubAccountType,
        GitHubUserAvatarUrl $avatarUrl,
        GitHubUserGravatarId $gravatarId,
        GitHubUserHtmlUrl $htmlUrl,
        GitHubUserApiUrl $apiUrl,
        bool $siteAdmin
    ) {
        $sut = new Sender(
            $userId, $login, $gitHubAccountType, $avatarUrl, $gravatarId, $htmlUrl, $apiUrl, $siteAdmin
        );

        $this->assertSame($userId, $sut->getUserId());
        $this->assertSame($login, $sut->getLogin());
        $this->assertSame($gitHubAccountType, $sut->getGitHubAccountType());
        $this->assertSame($avatarUrl, $sut->getAvatarUrl());
        $this->assertSame($gravatarId, $sut->getGravatarId());
        $this->assertSame($htmlUrl, $sut->getHtmlUrl());
        $this->assertSame($apiUrl, $sut->getApiUrl());
        $this->assertSame($siteAdmin, $sut->isSiteAdmin());
    }

    /** @dataProvider provideArguments */
    public function testSerializationAndDeserialization(
        GitHubUserId $userId,
        GitHubUserLogin $login,
        GitHubAccountType $gitHubAccountType,
        GitHubUserAvatarUrl $avatarUrl,
        GitHubUserGravatarId $gravatarId,
        GitHubUserHtmlUrl $htmlUrl,
        GitHubUserApiUrl $apiUrl,
        bool $siteAdmin
    ) {
        $sut = new Sender(
            $userId, $login, $gitHubAccountType, $avatarUrl, $gravatarId, $htmlUrl, $apiUrl, $siteAdmin
        );

        $serialized = $sut->serialize();

        $this->assertEquals($sut, Sender::deserialize($serialized));
    }

    public function provideArguments(): array
    {
        return [
            [
                new GitHubUserId(13507412),
                new GitHubUserLogin('devboard-test'),
                new User(),
                new GitHubUserAvatarUrl('https://avatars.githubusercontent.com/u/13507412?v=3'),
                new GitHubUserGravatarId(''),
                new GitHubUserHtmlUrl('https://github.com/devboard-test'),
                new GitHubUserApiUrl('https://api.github.com/users/devboard-test'),
                false,
            ],
            [
                new GitHubUserId(13396338),
                new GitHubUserLogin('devboard'),
                new Organization(),
                new GitHubUserAvatarUrl('https://avatars.githubusercontent.com/u/13396338?v=3'),
                new GitHubUserGravatarId(''),
                new GitHubUserHtmlUrl('https://github.com/devboard'),
                new GitHubUserApiUrl('https://api.github.com/users/devboard'),
                false,
            ],
            [
                new GitHubUserId(1),
                new GitHubUserLogin('octocat'),
                new User(),
                new GitHubUserAvatarUrl('https://avatars.githubusercontent.com/u/1?v=3'),
                new GitHubUserGravatarId(''),
                new GitHubUserHtmlUrl('https://github.com/octocat'),
                new GitHubUserApiUrl('https://api.github.com/users/octocat'),
                true,
            ],
        ];
    }
}
