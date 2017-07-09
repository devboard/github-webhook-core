<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHubWebhook\Core\Repo\RepoTimestampsFactory;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Repo\RepoTimestampsFactory
 * @group  unit
 */
class RepoTimestampsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testFactoryReturnsGitHubRepoTimestampsInstance(array $data)
    {
        $sut = new RepoTimestampsFactory();

        $this->assertInstanceOf(RepoTimestamps::class, $sut->create($data));
    }

    public function provideData(): \Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
