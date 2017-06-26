<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core;

use Symfony\Component\Finder\Finder;

class GitHubProductionTestData
{
    /**
     * @var string
     */
    private $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public static function create(): GitHubProductionTestData
    {
        return new self(__DIR__.'/../tmp/github-data-dump/_all2/');
    }

    public function getGitHubPushEventData(): \Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('push') as $file) {
                $content = file_get_contents($file->getRealPath());

                yield json_decode($content, true);
            }
        }
    }

    private function loadAllFilesMatchingEventType(string $eventType): Finder
    {
        $finder = new Finder();
        $finder->in($this->basePath)
            ->name('*___'.$eventType.'___*')
            ->sortByName()
            ->files();

        return $finder;
    }
}
