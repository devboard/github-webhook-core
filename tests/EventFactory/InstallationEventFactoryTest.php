<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\EventFactory;

use DevboardLib\GitHubWebhook\Core\Event\InstallationEvent;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationAccountFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEventFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\SenderFactory;
use Generator;
use tests\DevboardLib\GitHubWebhook\Core\GitHubExampleTestData;
use tests\DevboardLib\GitHubWebhook\Core\GitHubProductionTestData;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEventFactory
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
