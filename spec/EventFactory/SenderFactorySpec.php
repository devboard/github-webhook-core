<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Webhook\Core\Event\Sender;
use Devboard\GitHub\Webhook\Core\EventFactory\SenderFactory;
use PhpSpec\ObjectBehavior;

class SenderFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(SenderFactory::class);
    }

    public function it_will_create_pusher_value_object_from_given_array()
    {
        $data = [
            'login'       => 'devboard-test',
            'id'          => 1,
            'avatar_url'  => 'avatar-url',
            'gravatar_id' => '',
            'url'         => 'github-url',
            'html_url'    => 'github-html-url',
            'type'        => 'User',
            'site_admin'  => false,
        ];

        $this->create($data)
            ->shouldReturnAnInstanceOf(Sender::class);
    }
}
