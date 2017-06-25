<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Webhook\Core\EventFactory\MarketplacePurchaseEventFactory;
use PhpSpec\ObjectBehavior;

class MarketplacePurchaseEventFactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(MarketplacePurchaseEventFactory::class);
    }
}
