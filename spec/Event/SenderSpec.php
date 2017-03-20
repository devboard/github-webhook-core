<?php

declare(strict_types=1);

namespace spec\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\User\GitHubUserApiUrl;
use Devboard\GitHub\User\GitHubUserAvatarUrl;
use Devboard\GitHub\User\GitHubUserGravatarId;
use Devboard\GitHub\User\GitHubUserHtmlUrl;
use Devboard\GitHub\User\GitHubUserId;
use Devboard\GitHub\User\GitHubUserLogin;
use Devboard\GitHub\User\GitHubUserType;
use Devboard\GitHub\Webhook\Core\Event\Sender;
use PhpSpec\ObjectBehavior;

class SenderSpec extends ObjectBehavior
{
    public function let(
        GitHubUserId $userId,
        GitHubUserLogin $login,
        GitHubUserType $githubUserType,
        GitHubUserAvatarUrl $avatarUrl,
        GitHubUserGravatarId $gravatarId,
        GitHubUserHtmlUrl $htmlUrl,
        GitHubUserApiUrl $apiUrl
    ) {
        $this->beConstructedWith(
            $userId,
            $login,
            $githubUserType,
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
        GitHubUserType $githubUserType,
        GitHubUserAvatarUrl $avatarUrl,
        GitHubUserGravatarId $gravatarId,
        GitHubUserHtmlUrl $htmlUrl,
        GitHubUserApiUrl $apiUrl
    ) {
        $this->getUserId()->shouldReturn($userId);
        $this->getLogin()->shouldReturn($login);
        $this->getGitHubUserType()->shouldReturn($githubUserType);
        $this->getAvatarUrl()->shouldReturn($avatarUrl);
        $this->getGravatarId()->shouldReturn($gravatarId);
        $this->getHtmlUrl()->shouldReturn($htmlUrl);
        $this->getApiUrl()->shouldReturn($apiUrl);
        $this->isSiteAdmin()->shouldReturn(false);
    }
}
