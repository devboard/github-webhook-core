<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\User\GitHubUserApiUrl;
use Devboard\GitHub\User\GitHubUserAvatarUrl;
use Devboard\GitHub\User\GitHubUserGravatarId;
use Devboard\GitHub\User\GitHubUserHtmlUrl;
use Devboard\GitHub\User\GitHubUserId;
use Devboard\GitHub\User\GitHubUserLogin;
use Devboard\GitHub\User\GitHubUserType;
use Devboard\GitHub\User\GitHubUserTypeFactory;

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
    /** @var GitHubUserType */
    private $githubUserType;
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
        GitHubUserType $githubUserType,
        GitHubUserAvatarUrl $avatarUrl,
        GitHubUserGravatarId $gravatarId,
        GitHubUserHtmlUrl $htmlUrl,
        GitHubUserApiUrl $apiUrl,
        bool $siteAdmin
    ) {
        $this->userId         = $userId;
        $this->login          = $login;
        $this->githubUserType = $githubUserType;
        $this->avatarUrl      = $avatarUrl;
        $this->gravatarId     = $gravatarId;
        $this->htmlUrl        = $htmlUrl;
        $this->apiUrl         = $apiUrl;
        $this->siteAdmin      = $siteAdmin;
    }

    public function getUserId(): GitHubUserId
    {
        return $this->userId;
    }

    public function getLogin(): GitHubUserLogin
    {
        return $this->login;
    }

    public function getGitHubUserType(): GitHubUserType
    {
        return $this->githubUserType;
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
            'userId'         => $this->userId->getValue(),
            'login'          => (string) $this->login,
            'githubUserType' => (string) $this->githubUserType,
            'avatarUrl'      => (string) $this->avatarUrl,
            'gravatarId'     => (string) $this->gravatarId,
            'htmlUrl'        => (string) $this->htmlUrl,
            'apiUrl'         => (string) $this->apiUrl,
            'siteAdmin'      => $this->siteAdmin,
        ];
    }

    public static function deserialize(array $data): Sender
    {
        return new self(
            new GitHubUserId($data['userId']),
            new GitHubUserLogin($data['login']),
            GitHubUserTypeFactory::create($data['githubUserType']),
            new GitHubUserAvatarUrl($data['avatarUrl']),
            new GitHubUserGravatarId($data['gravatarId']),
            new GitHubUserHtmlUrl($data['htmlUrl']),
            new GitHubUserApiUrl($data['apiUrl']),
            $data['siteAdmin']
        );
    }
}
