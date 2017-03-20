<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Commit;

use Devboard\GitHub\Commit\GitHubCommitAuthor;
use Devboard\GitHub\Commit\GitHubCommitCommitter;
use Devboard\GitHub\GitHubCommit;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitAuthorFactory;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitCommitterFactory;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitFactory;
use PhpSpec\ObjectBehavior;

class GitHubCommitFactorySpec extends ObjectBehavior
{
    public function let(GitHubCommitCommitterFactory $commitCommitterFactory, GitHubCommitAuthorFactory $authorFactory)
    {
        $this->beConstructedWith($commitCommitterFactory, $authorFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubCommitFactory::class);
    }

    public function it_will_create_commit_from_given_branch_data(
        GitHubCommitCommitterFactory $commitCommitterFactory,
        GitHubCommitAuthorFactory $authorFactory,
        GitHubCommitAuthor $author,
        GitHubCommitCommitter $committer
    ) {
        $data = [
            'id'        => 'abc123',
            'message'   => 'Commit message',
            'timestamp' => '2016-06-14T01:01:08+02:00',
        ];

        $commitCommitterFactory->create($data)
            ->shouldBeCalled()
            ->willReturn($committer);
        $authorFactory->create($data)
            ->shouldBeCalled()
            ->willReturn($author);

        $this->create($data)->shouldReturnAnInstanceOf(GitHubCommit::class);
    }
}
