<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoEndpointsFactory;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoEndpointsFactory
 * @group  unit
 */
class GitHubRepoEndpointsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testFactoryReturnsGitHubRepoEndpointsInstance(array $data)
    {
        $sut = new GitHubRepoEndpointsFactory();

        $this->assertInstanceOf(RepoEndpoints::class, $sut->create($data));
    }

    public function provideData(): \Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
