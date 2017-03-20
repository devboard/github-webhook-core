<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\Repo;

use Devboard\GitHub\Repo\GitHubRepoApiUrl;
use Devboard\GitHub\Repo\GitHubRepoEndpoints;
use Devboard\GitHub\Repo\GitHubRepoHtmlUrl;

/**
 * @see GitHubRepoEndpointsFactorySpec
 * @see GitHubRepoEndpointsFactoryTest
 */
class GitHubRepoEndpointsFactory
{
    public function create(array $data): GitHubRepoEndpoints
    {
        return new GitHubRepoEndpoints(
            new GitHubRepoApiUrl($data['url']),
            new GitHubRepoHtmlUrl($data['html_url'])
        );
    }
}
