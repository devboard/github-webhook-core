<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event\InstallationRepositoriesEvent;

use Devboard\GitHub\Webhook\Core\Event\InstallationRepositoriesEvent\InstallationRepositoriesAction;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class InstallationRepositoriesActionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith($action = 'added');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationRepositoriesAction::class);
    }

    public function it_can_be_removed_action()
    {
        $this->beConstructedWith($action = 'removed');
    }

    public function it_throws_exception_if_receives_anything_else()
    {
        $this->shouldThrow(InvalidArgumentException::class)->during__construct($action = 'something');
    }

    public function it_will_expose_value()
    {
        $this->getValue()->shouldReturn('added');
    }

    public function it_can_be_converted_to_string()
    {
        $this->__toString()->shouldReturn('added');
    }
}
