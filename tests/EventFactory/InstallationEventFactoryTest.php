<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Webhook\Core\Event\InstallationEvent;
use Devboard\GitHub\Webhook\Core\EventFactory\InstallationEvent\InstallationAccountFactory;
use Devboard\GitHub\Webhook\Core\EventFactory\InstallationEvent\InstallationFactory;
use Devboard\GitHub\Webhook\Core\EventFactory\InstallationEventFactory;
use Devboard\GitHub\Webhook\Core\EventFactory\SenderFactory;
use Generator;
use tests\Devboard\GitHub\Webhook\Core\GitHubExampleTestData;
use tests\Devboard\GitHub\Webhook\Core\GitHubProductionTestData;

/**
 * @covers \Devboard\GitHub\Webhook\Core\EventFactory\InstallationEventFactory
 * @group  unit
 */
class InstallationEventFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideArguments */
    public function testCreating(array $data)
    {
        $sut = new InstallationEventFactory(
            new InstallationFactory(
                new InstallationAccountFactory()
            ),
            new SenderFactory()
        );

        $this->assertInstanceOf(InstallationEvent::class, $sut->create($data));
    }

    public function provideArguments(): Generator
    {
        foreach (GitHubProductionTestData::create()->getGitHubInstalationEventData() as $item) {
            yield [$item];
        }

        /*
        // Example from GitHub documentation is outdated and missing data. Dont use it until it gets updated :(
        foreach (GitHubExampleTestData::create()->getGitHubInstalationEventData() as $item) {
            yield [$item];
        }
        */
    }
}
