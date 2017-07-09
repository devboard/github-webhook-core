<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core\Commit;

use Devboard\Thesting\Source\JsonSource;
use DevboardLib\GitHub\GitHubCommit;
use DevboardLib\GitHubWebhook\Core\Commit\GitHubCommitAuthorFactory;
use DevboardLib\GitHubWebhook\Core\Commit\GitHubCommitCommitterFactory;
use DevboardLib\GitHubWebhook\Core\Commit\GitHubCommitFactory;
use Generator;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Commit\GitHubCommitFactory
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
