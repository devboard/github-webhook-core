<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoTimestampsFactory;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoTimestampsFactory
 * @group  unit
 */
class GitHubRepoTimestampsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testFactoryReturnsGitHubRepoTimestampsInstance(array $data)
    {
        $sut = new GitHubRepoTimestampsFactory();

        $this->assertInstanceOf(RepoTimestamps::class, $sut->create($data));
    }

    public function provideData(): \Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
