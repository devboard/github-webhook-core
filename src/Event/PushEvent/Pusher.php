<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Event\PushEvent;

use DevboardLib\GitHub\User\UserEmailAddress;
use DevboardLib\GitHub\User\UserLogin;

/**
 * @see PusherSpec
 * @see PusherTest
 */
class Pusher
{
    /** @var UserLogin */
    private $login;
    /** @var UserEmailAddress */
    private $emailAddress;

    public function __construct(UserLogin $login, UserEmailAddress $emailAddress)
    {
        $this->login        = $login;
        $this->emailAddress = $emailAddress;
    }

    public static function create(string $login, string $emailAddress): Pusher
    {
        return new self(new UserLogin($login), new UserEmailAddress($emailAddress));
    }

    public function getLogin(): UserLogin
    {
        return $this->login;
    }

    public function getEmailAddress(): UserEmailAddress
    {
        return $this->emailAddress;
    }
}
