<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHubWebhook\Core\Repo\RepoStatsFactory;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Repo\RepoStatsFactory
 * @group  unit
 */
class RepoStatsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testFactoryReturnsGitHubRepoStatsInstance(array $data)
    {
        $sut = new RepoStatsFactory();

        $this->assertInstanceOf(RepoStats::class, $sut->create($data));
    }

    public function provideData(): \Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
