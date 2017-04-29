<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Commit;

use Devboard\GitHub\GitHubCommit;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitAuthorFactory;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitCommitterFactory;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitFactory;
use Devboard\Thesting\Source\JsonSource;
use Generator;

/**
 * @covers \Devboard\GitHub\Webhook\Core\Commit\GitHubCommitFactory
 * @group  unit
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GitHubCommitFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideHeadCommits
     * @dataProvider provideCommits
     */
    public function testCreating(array $data)
    {
        $sut = new GitHubCommitFactory(
            new GitHubCommitCommitterFactory(),
            new GitHubCommitAuthorFactory()
        );

        $this->assertInstanceOf(GitHubCommit::class, $sut->create($data));
    }

    public function provideHeadCommits(): Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            if (false === empty($item['head_commit'])) {
                yield [$item['head_commit']];
            }
        }
    }

    public function provideCommits(): Generator
    {
        foreach (JsonSource::create()->getGitHubPushEventData() as $item) {
            foreach ($item['commits'] as $commit) {
                yield [$commit];
            }
        }
    }
}
