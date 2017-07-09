<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent;

use DevboardLib\GitHub\Installation\InstallationAccount;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationAccountFactory;
use PhpSpec\ObjectBehavior;

class InstallationAccountFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationAccountFactory::class);
    }

    public function it_will_create_installation_account_value_object_from_given_array()
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
            ->shouldReturnAnInstanceOf(InstallationAccount::class);
    }
}
