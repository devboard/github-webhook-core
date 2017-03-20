<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitAuthorFactory;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitCommitterFactory;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitFactory;
use Devboard\GitHub\Webhook\Core\Event\PushEvent;
use Devboard\GitHub\Webhook\Core\Event\PushEvent\PusherFactory;
use Devboard\GitHub\Webhook\Core\Event\PushEventFactory;
use Devboard\GitHub\Webhook\Core\Event\SenderFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoEndpointsFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoStatsFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoTimestampsFactory;
use Generator;
use tests\Devboard\GitHub\Webhook\Core\Event\TestData\TestDataProvider;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Event\PushEventFactory
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
            new GitHubCommitFactory(
                new GitHubCommitCommitterFactory(),
                new GitHubCommitAuthorFactory()
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
        $provider = new TestDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            yield [$item];
        }
    }
}
