<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\EventFactory\PushEvent;

use Devboard\GitHub\Webhook\Core\Event\PushEvent\Pusher;
use Devboard\GitHub\Webhook\Core\EventFactory\PushEvent\PusherFactory;

/**
 * @covers \Devboard\GitHub\Webhook\Core\EventFactory\PushEvent\PusherFactory
 * @group  unit
 */
class PusherFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideArguments */
    public function testCreating(array $data)
    {
        $sut = new PusherFactory();
        $this->assertInstanceOf(Pusher::class, $sut->create($data));
    }

    public function provideArguments(): \Generator
    {
        yield [['name' => 'Joe', 'email' => 'joe@example.com']];
    }
}
