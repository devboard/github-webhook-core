<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoTimestamps;
use DevboardLib\GitHubWebhook\Core\Repo\GitHubRepoTimestampsFactory;
use PhpSpec\ObjectBehavior;

class GitHubRepoTimestampsFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubRepoTimestampsFactory::class);
    }

    public function it_will_return_github_repo_timestamps_instance()
    {
        $data = [
            'created_at' => 1457374537,
            'updated_at' => '2016-03-07T18:15:38Z',
            'pushed_at'  => 1470510162,
        ];

        $this->create($data)->shouldReturnAnInstanceOf(GitHubRepoTimestamps::class);
    }
}
