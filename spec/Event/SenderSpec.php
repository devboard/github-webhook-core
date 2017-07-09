<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Event;

use Devboard\GitHub\Account\GitHubAccountType;
use Devboard\GitHub\User\GitHubUserApiUrl;
use Devboard\GitHub\User\GitHubUserAvatarUrl;
use Devboard\GitHub\User\GitHubUserGravatarId;
use Devboard\GitHub\User\GitHubUserHtmlUrl;
use Devboard\GitHub\User\GitHubUserId;
use Devboard\GitHub\User\GitHubUserLogin;
use DevboardLib\GitHubWebhook\Core\Event\Sender;
use PhpSpec\ObjectBehavior;

class SenderSpec extends ObjectBehavior
{
    public function let(
        GitHubUserId $userId,
        GitHubUserLogin $login,
        GitHubAccountType $gitHubAccountType,
        GitHubUserAvatarUrl $avatarUrl,
        GitHubUserGravatarId $gravatarId,
        GitHubUserHtmlUrl $htmlUrl,
        GitHubUserApiUrl $apiUrl
    ) {
        $this->beConstructedWith(
            $userId,
            $login,
            $gitHubAccountType,
            $avatarUrl,
            $gravatarId,
            $htmlUrl,
            $apiUrl,
            false
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Sender::class);
    }

    public function it_should_expose_all_values_via_getters(
        GitHubUserId $userId,
        GitHubUserLogin $login,
        GitHubAccountType $gitHubAccountType,
        GitHubUserAvatarUrl $avatarUrl,
        GitHubUserGravatarId $gravatarId,
        GitHubUserHtmlUrl $htmlUrl,
        GitHubUserApiUrl $apiUrl
    ) {
        $this->getUserId()->shouldReturn($userId);
        $this->getLogin()->shouldReturn($login);
        $this->getGitHubAccountType()->shouldReturn($gitHubAccountType);
        $this->getAvatarUrl()->shouldReturn($avatarUrl);
        $this->getGravatarId()->shouldReturn($gravatarId);
        $this->getHtmlUrl()->shouldReturn($htmlUrl);
        $this->getApiUrl()->shouldReturn($apiUrl);
        $this->isSiteAdmin()->shouldReturn(false);
    }
}
