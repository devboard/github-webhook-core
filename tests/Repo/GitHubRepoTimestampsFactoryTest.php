<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoTimestamps;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoTimestampsFactory;
use Devboard\Thesting\Source\JsonSource;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Repo\GitHubRepoTimestampsFactory
 * @group  unit
 */
class GitHubRepoTimestampsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testFactoryReturnsGitHubRepoTimestampsInstance(array $data)
    {
        $sut = new GitHubRepoTimestampsFactory();

        $this->assertInstanceOf(GitHubRepoTimestamps::class, $sut->create($data));
    }

    public function provideData(): \Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
