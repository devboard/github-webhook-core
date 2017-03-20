<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Commit;

use Devboard\GitHub\Commit\GitHubCommitCommitter;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitCommitterFactory;
use Generator;
use tests\Devboard\GitHub\Webhook\Core\Event\TestData\TestDataProvider;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Commit\GitHubCommitCommitterFactory
 * @group  unit
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GitHubCommitCommitterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideHeadCommits
     * @dataProvider provideCommits
     */
    public function testCreating(array $data)
    {
        $sut = new GitHubCommitCommitterFactory();

        $this->assertInstanceOf(GitHubCommitCommitter::class, $sut->create($data));
    }

    public function provideHeadCommits(): Generator
    {
        $provider = new TestDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            if (false === empty($item['head_commit'])) {
                yield [$item['head_commit']];
            }
        }
    }

    public function provideCommits(): Generator
    {
        $provider = new TestDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            foreach ($item['commits'] as $commit) {
                yield [$commit];
            }
        }
    }
}
