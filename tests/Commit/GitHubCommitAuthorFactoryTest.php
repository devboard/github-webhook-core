<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Commit;

use Devboard\GitHub\Commit\GitHubCommitAuthor;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitAuthorFactory;
use Generator;
use tests\Devboard\GitHub\Webhook\Core\Event\TestData\TestDataProvider;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Commit\GitHubCommitAuthorFactory
 * @group  unit
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GitHubCommitAuthorFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideHeadCommits
     * @dataProvider provideCommits
     */
    public function testCreating(array $data)
    {
        $sut = new GitHubCommitAuthorFactory();

        $this->assertInstanceOf(GitHubCommitAuthor::class, $sut->create($data));
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
