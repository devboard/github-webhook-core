<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Event\PushEvent;

use Devboard\GitHub\User\GitHubUserEmailAddress;
use Devboard\GitHub\User\GitHubUserLogin;
use DevboardLib\GitHubWebhook\Core\Event\PushEvent\Pusher;
use PhpSpec\ObjectBehavior;

class PusherSpec extends ObjectBehavior
{
    public function let(GitHubUserLogin $login, GitHubUserEmailAddress $emailAddress)
    {
        $this->beConstructedWith($login, $emailAddress);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Pusher::class);
    }

    public function it_can_be_created_from_strings()
    {
        $this->create('devboard-test', 'nobody@example.com')->shouldReturnAnInstanceOf(Pusher::class);
    }

    public function it_should_expose_user_login_as_object(GitHubUserLogin $login)
    {
        $this->getLogin()->shouldReturn($login);
    }

    public function it_should_expose_repository_name_as_object(GitHubUserEmailAddress $emailAddress)
    {
        $this->getEmailAddress()->shouldReturn($emailAddress);
    }
}
