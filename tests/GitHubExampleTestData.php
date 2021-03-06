<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core;

class GitHubExampleTestData
{
    public static function create(): GitHubExampleTestData
    {
        return new self();
    }

    public function getGitHubPushEventData(): array
    {
        $content = file_get_contents(__DIR__.'/testdata/push.json');

        return [json_decode($content, true)];
    }

    /**
     * Example from GitHub documentation is outdated and missing data. Dont use it until it gets updated :(.
     */
    public function getGitHubInstalationEventData(): array
    {
        $content = file_get_contents(__DIR__.'/testdata/installation.json');

        return [json_decode($content, true)];
    }

    /**
     * Example from GitHub documentation is outdated and missing data. Dont use it until it gets updated :(.
     */
    public function getGitHubInstalationRepositoriesEventData(): array
    {
        $content = file_get_contents(__DIR__.'/testdata/installation_repositories.json');

        return [json_decode($content, true)];
    }
}
