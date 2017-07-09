<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Event\PushEvent;

use Devboard\GitHub\User\GitHubUserEmailAddress;
use Devboard\GitHub\User\GitHubUserLogin;

/**
 * @see PusherSpec
 * @see PusherTest
 */
class Pusher
{
    /** @var GitHubUserLogin */
    private $login;
    /** @var GitHubUserEmailAddress */
    private $emailAddress;

    public function __construct(GitHubUserLogin $login, GitHubUserEmailAddress $emailAddress)
    {
        $this->login        = $login;
        $this->emailAddress = $emailAddress;
    }

    public static function create(string $login, string $emailAddress): Pusher
    {
        return new self(new GitHubUserLogin($login), new GitHubUserEmailAddress($emailAddress));
    }

    public function getLogin(): GitHubUserLogin
    {
        return $this->login;
    }

    public function getEmailAddress(): GitHubUserEmailAddress
    {
        return $this->emailAddress;
    }
}
