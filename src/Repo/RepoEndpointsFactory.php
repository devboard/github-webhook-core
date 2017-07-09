<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Repo;

use DevboardLib\GitHub\Repo\RepoApiUrl;
use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHub\Repo\RepoHtmlUrl;

/**
 * @see RepoEndpointsFactorySpec
 * @see RepoEndpointsFactoryTest
 */
class RepoEndpointsFactory
{
    public function create(array $data): RepoEndpoints
    {
        return new RepoEndpoints(
            new RepoApiUrl($data['url']),
            new RepoHtmlUrl($data['html_url'])
        );
    }
}
