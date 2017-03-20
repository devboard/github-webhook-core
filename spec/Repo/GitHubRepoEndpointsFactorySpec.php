<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoEndpoints;
use Devboard\GitHub\Webhook\Core\Repo\GitHubRepoEndpointsFactory;
use PhpSpec\ObjectBehavior;

class GitHubRepoEndpointsFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubRepoEndpointsFactory::class);
    }

    public function it_will_return_github_endpoints_instance()
    {
        $data = [
            'url'      => '..',
            'html_url' => '..',
        ];

        $this->create($data)->shouldReturnAnInstanceOf(GitHubRepoEndpoints::class);
    }
}
