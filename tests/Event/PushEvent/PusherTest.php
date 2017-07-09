<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Event\PushEvent;

use DevboardLib\GitHub\User\UserEmailAddress;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher
 * @group  unit
 */
class PusherTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideValues */
    public function testGetters(UserLogin $login, UserEmailAddress $emailAddress)
    {
        $sut = new Pusher($login, $emailAddress);

        $this->assertEquals($login, $sut->getLogin());
        $this->assertEquals($emailAddress, $sut->getEmailAddress());
    }

    /** @dataProvider provideStringValues */
    public function testItCanBeCreatedFromStrings(string $login, string $emailAddress)
    {
        $this->assertInstanceOf(
            Pusher::class,
            Pusher::create($login, $emailAddress)
        );
    }

    public function provideValues(): array
    {
        return [
            [new UserLogin('devboard-test'), new UserEmailAddress('nobody@example.com')],
        ];
    }

    public function provideStringValues(): array
    {
        return [
            ['devboard-test', 'nobody@example.com'],
        ];
    }
}
