<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core;

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
}
