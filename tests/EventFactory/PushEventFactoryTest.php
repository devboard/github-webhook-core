<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\EventFactory;

use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHubWebhook\Core\Commit\CommitAuthorFactory;
use DevboardLib\GitHubWebhook\Core\Commit\CommitCommitterFactory;
use DevboardLib\GitHubWebhook\Core\Commit\CommitFactory;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent;
use DevboardLib\GitHubWebhook\Core\EventFactory\PushEvent\PusherFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\PushEventFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoEndpointsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoStatsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoTimestampsFactory;
use Generator;
use tests\DevboardLib\GitHubWebhook\Core\GitHubExampleTestData;
use tests\DevboardLib\GitHubWebhook\Core\GitHubProductionTestData;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\EventFactory\PushEventFactory
 * @group  unit
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PushEventFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideArguments */
    public function testCreating(array $data)
    {
        $sut = new PushEventFactory(
            new CommitFactory(
                new CommitCommitterFactory(),
                new CommitAuthorFactory()
            ),
            new GitHubRepoFactory(
                new GitHubRepoEndpointsFactory(),
                new GitHubRepoTimestampsFactory(),
                new GitHubRepoStatsFactory()
            ),
            new PusherFactory(),
            new SenderFactory()
        );

        $this->assertInstanceOf(PushEvent::class, $sut->create($data));
    }

    public function provideArguments(): Generator
    {
        foreach (GitHubProductionTestData::create()->getGitHubPushEventData() as $item) {
            yield [$item];
        }

        foreach (GitHubExampleTestData::create()->getGitHubPushEventData() as $item) {
            yield [$item];
        }

        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield [$item];
        }
    }
}
