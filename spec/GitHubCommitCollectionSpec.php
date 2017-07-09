<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\GitHubCommitCollection;
use PhpSpec\ObjectBehavior;

class GitHubCommitCollectionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubCommitCollection::class);
    }
}
