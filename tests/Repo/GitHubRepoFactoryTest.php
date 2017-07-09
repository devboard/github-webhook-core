<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\GitHub\GitHubRepo;
use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoEndpointsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoStatsFactory;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoTimestampsFactory;
use Generator;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoFactory
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
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield [$item['repository']];
        }
    }
}
