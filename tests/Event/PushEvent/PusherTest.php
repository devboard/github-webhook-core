<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Event\PushEvent;

use Devboard\GitHub\User\GitHubUserEmailAddress;
use Devboard\GitHub\User\GitHubUserLogin;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher
 * @group  unit
 */
class PusherTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideValues */
    public function testGetters(GitHubUserLogin $login, GitHubUserEmailAddress $emailAddress)
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
            [new GitHubUserLogin('devboard-test'), new GitHubUserEmailAddress('nobody@example.com')],
        ];
    }

    public function provideStringValues(): array
    {
        return [
            ['devboard-test', 'nobody@example.com'],
        ];
    }
}
