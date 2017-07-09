<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHub\GitHubRepo;
use DevboardLib\GitHubWebhook\Core\Repo\RepoEndpointsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\RepoFactory;
use DevboardLib\GitHubWebhook\Core\Repo\RepoStatsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\RepoTimestampsFactory;
use Generator;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Repo\RepoFactory
 * @group  unit
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RepoFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testCreate(array $data)
    {
        $sut = new RepoFactory(
            new RepoEndpointsFactory(),
            new RepoTimestampsFactory(),
            new RepoStatsFactory()
        );

        $this->assertInstanceOf(GitHubRepo::class, $sut->create($data));
    }

    public function provideData(): Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield [$item['repository']];
        }
    }
}
