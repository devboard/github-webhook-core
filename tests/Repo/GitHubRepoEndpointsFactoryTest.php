<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoEndpoints;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoEndpointsFactory;
use Devboard\Thesting\Source\JsonSource;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Repo\GitHubRepoEndpointsFactory
 * @group  unit
 */
class GitHubRepoEndpointsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideData */
    public function testFactoryReturnsGitHubRepoEndpointsInstance(array $data)
    {
        $sut = new GitHubRepoEndpointsFactory();

        $this->assertInstanceOf(GitHubRepoEndpoints::class, $sut->create($data));
    }

    public function provideData(): \Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            yield[$item['repository']];
        }
    }
}
