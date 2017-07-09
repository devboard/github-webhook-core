<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Event;

use Devboard\GitHub\Account\GitHubAccountType;
use Devboard\GitHub\Account\GitHubAccountTypeFactory;
use Devboard\GitHub\User\GitHubUserApiUrl;
use Devboard\GitHub\User\GitHubUserAvatarUrl;
use Devboard\GitHub\User\GitHubUserGravatarId;
use Devboard\GitHub\User\GitHubUserHtmlUrl;
use Devboard\GitHub\User\GitHubUserId;
use Devboard\GitHub\User\GitHubUserLogin;

/**
 * @see SenderSpec
 * @see SenderTest
 */
class Sender
{
    /** @var GitHubUserId */
    private $userId;
    /** @var GitHubUserLogin */
    private $login;
    /** @var GitHubAccountType */
    private $gitHubAccountType;
    /** @var GitHubUserAvatarUrl */
    private $avatarUrl;
    /** @var GitHubUserGravatarId */
    private $gravatarId;
    /** @var GitHubUserHtmlUrl */
    private $htmlUrl;
    /** @var GitHubUserApiUrl */
    private $apiUrl;
    /** @var bool */
    private $siteAdmin;

    public function __construct(
        GitHubUserId $userId,
        GitHubUserLogin $login,
        GitHubAccountType $gitHubAccountType,
        GitHubUserAvatarUrl $avatarUrl,
        GitHubUserGravatarId $gravatarId,
        GitHubUserHtmlUrl $htmlUrl,
        GitHubUserApiUrl $apiUrl,
        bool $siteAdmin
    ) {
        $this->userId            = $userId;
        $this->login             = $login;
        $this->gitHubAccountType = $gitHubAccountType;
        $this->avatarUrl         = $avatarUrl;
        $this->gravatarId        = $gravatarId;
        $this->htmlUrl           = $htmlUrl;
        $this->apiUrl            = $apiUrl;
        $this->siteAdmin         = $siteAdmin;
    }

    public function getUserId(): GitHubUserId
    {
        return $this->userId;
    }

    public function getLogin(): GitHubUserLogin
    {
        return $this->login;
    }

    public function getGitHubAccountType(): GitHubAccountType
    {
        return $this->gitHubAccountType;
    }

    public function getAvatarUrl(): GitHubUserAvatarUrl
    {
        return $this->avatarUrl;
    }

    public function getGravatarId(): GitHubUserGravatarId
    {
        return $this->gravatarId;
    }

    public function getHtmlUrl(): GitHubUserHtmlUrl
    {
        return $this->htmlUrl;
    }

    public function getApiUrl(): GitHubUserApiUrl
    {
        return $this->apiUrl;
    }

    public function isSiteAdmin(): bool
    {
        return $this->siteAdmin;
    }

    public function serialize(): array
    {
        return [
            'userId'            => $this->userId->getValue(),
            'login'             => (string) $this->login,
            'gitHubAccountType' => (string) $this->gitHubAccountType,
            'avatarUrl'         => (string) $this->avatarUrl,
            'gravatarId'        => (string) $this->gravatarId,
            'htmlUrl'           => (string) $this->htmlUrl,
            'apiUrl'            => (string) $this->apiUrl,
            'siteAdmin'         => $this->siteAdmin,
        ];
    }

    public static function deserialize(array $data): Sender
    {
        return new self(
            new GitHubUserId($data['userId']),
            new GitHubUserLogin($data['login']),
            GitHubAccountTypeFactory::create($data['gitHubAccountType']),
            new GitHubUserAvatarUrl($data['avatarUrl']),
            new GitHubUserGravatarId($data['gravatarId']),
            new GitHubUserHtmlUrl($data['htmlUrl']),
            new GitHubUserApiUrl($data['apiUrl']),
            $data['siteAdmin']
        );
    }
}
