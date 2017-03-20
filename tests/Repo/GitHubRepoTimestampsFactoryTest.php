<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoTimestamps;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoTimestampsFactory;
use tests\Devboard\GitHub\Webhook\Core\Event\TestData\TestDataProvider;

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
        $provider = new TestDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
