<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Commit;

use Devboard\GitHub\Commit\GitHubCommitCommitter;
use Devboard\GitHub\Webhook\Core\Commit\GitHubCommitCommitterFactory;
use PhpSpec\ObjectBehavior;

class GitHubCommitCommitterFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubCommitCommitterFactory::class);
    }

    public function it_will_create_committer_from_given_branch_data()
    {
        $data = [
            'committer' => [
                'name'  => 'John Smith',
                'email' => 'nobody@example.com',
            ],
            'timestamp' => '2016-06-14T01:01:08+02:00',
        ];

        $this->create($data)->shouldReturnAnInstanceOf(GitHubCommitCommitter::class);
    }
}
