<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoStatsFactory;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoStatsFactory
 * @group  unit
 */
class GitHubRepoStatsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testFactoryReturnsGitHubRepoStatsInstance(array $data)
    {
        $sut = new GitHubRepoStatsFactory();

        $this->assertInstanceOf(RepoStats::class, $sut->create($data));
    }

    public function provideData(): \Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
