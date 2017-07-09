<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHubWebhook\Core\Repo\RepoEndpointsFactory;
use PhpSpec\ObjectBehavior;

class RepoEndpointsFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoEndpointsFactory::class);
    }

    public function it_will_return_github_endpoints_instance()
    {
        $data = [
            'url'      => '..',
            'html_url' => '..',
        ];

        $this->create($data)->shouldReturnAnInstanceOf(RepoEndpoints::class);
    }
}
