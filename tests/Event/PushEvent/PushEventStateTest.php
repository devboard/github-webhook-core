<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Event\PushEvent;

use DevboardLib\GitHubWebhook\Core\Event\PushEvent\PushEventState;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Event\PushEvent\PushEventState
 * @group  unit
 */
class PushEventStateTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideValues */
    public function testGetters(bool $created, bool $deleted, bool $forced)
    {
        $sut = new PushEventState($created, $deleted, $forced);

        $this->assertEquals($created, $sut->isCreated());
        $this->assertEquals($deleted, $sut->isDeleted());
        $this->assertEquals($forced, $sut->isForced());
    }

    public function provideValues(): array
    {
        return [
            [true, false, false],
            [false, true, false],
            [false, false, true],
        ];
    }
}
