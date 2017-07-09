<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Commit;

use DevboardLib\GitHub\Commit\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Commit\GitHubCommitAuthorFactory;
use PhpSpec\ObjectBehavior;

class GitHubCommitAuthorFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubCommitAuthorFactory::class);
    }

    public function it_will_create_author_from_given_branch_data()
    {
        $data = [
            'author' => [
                'name'  => 'John Smith',
                'email' => 'nobody@example.com',
            ],
            'timestamp'=> '2016-06-14T01:01:08+02:00',
        ];

        $this->create($data)->shouldReturnAnInstanceOf(CommitAuthor::class);
    }
}
