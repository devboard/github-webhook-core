<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\CompareChangesUrl;
use PhpSpec\ObjectBehavior;

class CompareChangesUrlSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('https://github.com/devboard-test/super-library/compare/9049f1265b7d...0d1a26e67d8f');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CompareChangesUrl::class);
    }

    public function it_should_expose_value()
    {
        $this->getValue()->shouldReturn('https://github.com/devboard-test/super-library/compare/9049f1265b7d...0d1a26e67d8f');
    }

    public function it_should_be_castable_to_string()
    {
        $this->__toString()->shouldReturn('https://github.com/devboard-test/super-library/compare/9049f1265b7d...0d1a26e67d8f');
    }
}
