<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core;

use Devboard\GitHub\Webhook\Core\GitHubCommitCollection;
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
