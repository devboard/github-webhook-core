<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event\InstallationEvent;

use Devboard\GitHub\Webhook\Core\Event\InstallationEvent\InstallationAction;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class InstallationActionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith($action = 'created');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationAction::class);
    }

    public function it_can_be_deleted_action()
    {
        $this->beConstructedWith($action = 'deleted');
    }

    public function it_throws_exception_if_receives_anything_else()
    {
        $this->shouldThrow(InvalidArgumentException::class)->during__construct($action = 'something');
    }

    public function it_will_expose_value()
    {
        $this->getValue()->shouldReturn('created');
    }

    public function it_can_be_converted_to_string()
    {
        $this->__toString()->shouldReturn('created');
    }
}
