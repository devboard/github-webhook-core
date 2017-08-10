<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\Webhook\Core\Event\PullRequestReviewCommentEvent;
use PhpSpec\ObjectBehavior;

class PullRequestReviewCommentEventSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestReviewCommentEvent::class);
    }
}
