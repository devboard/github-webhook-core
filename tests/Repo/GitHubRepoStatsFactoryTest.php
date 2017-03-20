<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoStats;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoStatsFactory;
use tests\Devboard\GitHub\Webhook\Core\Event\TestData\TestDataProvider;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Repo\GitHubRepoStatsFactory
 * @group  unit
 */
class GitHubRepoStatsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testFactoryReturnsGitHubRepoStatsInstance(array $data)
    {
        $sut = new GitHubRepoStatsFactory();

        $this->assertInstanceOf(GitHubRepoStats::class, $sut->create($data));
    }

    public function provideData(): \Generator
    {
        $provider = new TestDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
