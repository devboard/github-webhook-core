<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\GitHubRepo;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoEndpointsFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoStatsFactory;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoTimestampsFactory;
use Generator;
use tests\Devboard\GitHub\Webhook\Core\Event\TestData\TestDataProvider;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Repo\GitHubRepoFactory
 * @group  unit
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GitHubRepoFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testCreate(array $data)
    {
        $sut = new GitHubRepoFactory(
            new GitHubRepoEndpointsFactory(),
            new GitHubRepoTimestampsFactory(),
            new GitHubRepoStatsFactory()
        );

        $this->assertInstanceOf(GitHubRepo::class, $sut->create($data));
    }

    public function provideData(): Generator
    {
        $provider = new TestDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            yield [$item['repository']];
        }
    }
}
