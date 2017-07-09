<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Event\PushEvent;

use DevboardLib\GitHubWebhook\Core\Event\PushEvent\PushEventState;
use PhpSpec\ObjectBehavior;

class PushEventStateSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(false, false, false);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PushEventState::class);
    }

    public function it_exposes_if_event_is_creating_a_new_branch_or_tag()
    {
        $this->isCreated()->shouldReturn(false);
    }

    public function it_exposes_if_event_is_deleting_a_branch_or_tag()
    {
        $this->isDeleted()->shouldReturn(false);
    }

    public function it_exposes_if_event_is_forced()
    {
        $this->isForced()->shouldReturn(false);
    }
}
