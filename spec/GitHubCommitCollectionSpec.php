<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\CommitCollection;
use PhpSpec\ObjectBehavior;

class CommitCollectionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommitCollection::class);
    }
}
