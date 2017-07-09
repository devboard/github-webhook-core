<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Commit;

use DevboardLib\GitHub\Commit\CommitAuthor;
use DevboardLib\GitHub\Commit\CommitCommitter;
use DevboardLib\GitHub\GitHubCommit;
use DevboardLib\GitHubWebhook\Core\Commit\CommitAuthorFactory;
use DevboardLib\GitHubWebhook\Core\Commit\CommitCommitterFactory;
use DevboardLib\GitHubWebhook\Core\Commit\CommitFactory;
use PhpSpec\ObjectBehavior;

class CommitFactorySpec extends ObjectBehavior
{
    public function let(CommitCommitterFactory $commitCommitterFactory, CommitAuthorFactory $authorFactory)
    {
        $this->beConstructedWith($commitCommitterFactory, $authorFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommitFactory::class);
    }

    public function it_will_create_commit_from_given_branch_data(
        CommitCommitterFactory $commitCommitterFactory,
        CommitAuthorFactory $authorFactory,
        CommitAuthor $author,
        CommitCommitter $committer
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
