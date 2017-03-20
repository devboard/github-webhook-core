<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Event\TestData;

use Generator;
use Symfony\Component\Finder\Finder;

class TestDataProvider
{
    private $repos = [
        'devboard/devboard',
        'devboard/devboard-core',
        'devboard/github-api-facade',
        'devboard/github-api-facade-bundle',
        'devboard/github-core',
        'devboard/github-lib',
        'devboard/github-object-api-facade',
        'devboard/github-object-api-facade-bundle',
        'msvrtan/SkeletonBundle',
        'msvrtan/generator',
        'msvrtan/github-lib',
        'msvrtan/starter-edition',
        'msvrtan/broadway',
        'msvrtan/github-api-facade',
        'msvrtan/github-object-api-facade',
        'msvrtan/user-edition',
        'msvrtan/devboard',
        'msvrtan/github-api-facade-bundle',
        'msvrtan/github-object-api-facade-bundle',
        'msvrtan/devboard-core',
        'msvrtan/github-core',
        'msvrtan/skeleton-sandbox',
        'nulldevelopmenthr/SkeletonBundle',
        'nulldevelopmenthr/generator',
        'nulldevelopmenthr/starter-edition',
        'nulldevelopmenthr/user-edition',
    ];

    public function getRepos(): array
    {
        return $this->repos;
    }

    public function getGitHubPushEventData(): Generator
    {
        foreach ($this->repos as $repo) {
            $folderName = __DIR__.'/'.$repo.'/push/';

            foreach ($this->getFiles($folderName) as $file) {
                $content = file_get_contents($file->getPathname());

                yield json_decode($content, true);
            }
        }
    }

    public function getGitHubPushEventBranchesData(): Generator
    {
        foreach ($this->repos as $repo) {
            $folderName = __DIR__.'/'.$repo.'/push/branch/';

            foreach ($this->getFiles($folderName) as $file) {
                $content = file_get_contents($file->getPathname());

                yield json_decode($content, true);
            }
        }
    }

    public function getGitHubPushEventTagsData(): Generator
    {
        foreach ($this->repos as $repo) {
            $folderName = __DIR__.'/'.$repo.'/push/tag/';

            foreach ($this->getFiles($folderName) as $file) {
                $content = file_get_contents($file->getPathname());

                yield json_decode($content, true);
            }
        }
    }

    private function getFiles(string $folderName)
    {
        $finder = new Finder();

        if (false === is_dir($folderName)) {
            return [];
        }
        $finder->files()->in($folderName);

        return $finder->getIterator();
    }
}
