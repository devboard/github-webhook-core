<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Event;

use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Account\Type\Organization;
use DevboardLib\GitHub\Account\Type\User;
use DevboardLib\GitHub\User\UserApiUrl;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserGravatarId;
use DevboardLib\GitHub\User\UserHtmlUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Event\Sender;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Event\Sender
 * @group  unit
 */
class SenderTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideArguments */
    public function testCreating(
        UserId $userId,
        UserLogin $login,
        AccountType $gitHubAccountType,
        UserAvatarUrl $avatarUrl,
        UserGravatarId $gravatarId,
        UserHtmlUrl $htmlUrl,
        UserApiUrl $apiUrl,
        bool $siteAdmin
    ) {
        $sut = new Sender(
            $userId, $login, $gitHubAccountType, $avatarUrl, $gravatarId, $htmlUrl, $apiUrl, $siteAdmin
        );

        $this->assertSame($userId, $sut->getUserId());
        $this->assertSame($login, $sut->getLogin());
        $this->assertSame($gitHubAccountType, $sut->getAccountType());
        $this->assertSame($avatarUrl, $sut->getAvatarUrl());
        $this->assertSame($gravatarId, $sut->getGravatarId());
        $this->assertSame($htmlUrl, $sut->getHtmlUrl());
        $this->assertSame($apiUrl, $sut->getApiUrl());
        $this->assertSame($siteAdmin, $sut->isSiteAdmin());
    }

    /** @dataProvider provideArguments */
    public function testSerializationAndDeserialization(
        UserId $userId,
        UserLogin $login,
        AccountType $gitHubAccountType,
        UserAvatarUrl $avatarUrl,
        UserGravatarId $gravatarId,
        UserHtmlUrl $htmlUrl,
        UserApiUrl $apiUrl,
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
                new UserId(13507412),
                new UserLogin('devboard-test'),
                new User(),
                new UserAvatarUrl('https://avatars.githubusercontent.com/u/13507412?v=3'),
                new UserGravatarId(''),
                new UserHtmlUrl('https://github.com/devboard-test'),
                new UserApiUrl('https://api.github.com/users/devboard-test'),
                false,
            ],
            [
                new UserId(13396338),
                new UserLogin('devboard'),
                new Organization(),
                new UserAvatarUrl('https://avatars.githubusercontent.com/u/13396338?v=3'),
                new UserGravatarId(''),
                new UserHtmlUrl('https://github.com/devboard'),
                new UserApiUrl('https://api.github.com/users/devboard'),
                false,
            ],
            [
                new UserId(1),
                new UserLogin('octocat'),
                new User(),
                new UserAvatarUrl('https://avatars.githubusercontent.com/u/1?v=3'),
                new UserGravatarId(''),
                new UserHtmlUrl('https://github.com/octocat'),
                new UserApiUrl('https://api.github.com/users/octocat'),
                true,
            ],
        ];
    }
}
