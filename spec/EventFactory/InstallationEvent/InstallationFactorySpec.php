<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent;

use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHub\Installation\InstallationAccount;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationAccountFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationFactory;
use PhpSpec\ObjectBehavior;

class InstallationFactorySpec extends ObjectBehavior
{
    public function let(InstallationAccountFactory $accountFactory)
    {
        $this->beConstructedWith($accountFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationFactory::class);
    }

    public function it_will_create_installation_value_object_from_given_array(
        InstallationAccountFactory $accountFactory,
        InstallationAccount $installationAccount
    ) {
        $accountFactory->create(['account-data'])
            ->shouldBeCalled()
            ->willReturn($installationAccount);

        $data = [
            'id'                   => 50001,
            'account'              => ['account-data'],
            'repository_selection' => 'all',
            'access_tokens_url'    => 'https://api.github.com/installations/50001/access_tokens',
            'repositories_url'     => 'https://api.github.com/installation/repositories',
            'html_url'             => 'https://github.com/organizations/devboard-org-test/settings/installations/50001',
            'app_id'               => 1234,
            'permissions'          => [
                'contents' => 'read',
                'issues'   => 'write',
            ],
            'events'               => [
                'commit_comment',
                'issues',
                'issue_comment',
                'push',
            ],
            'created_at'           => 1498339969,
            'updated_at'           => 1498339969,
        ];

        $this->create($data)
            ->shouldReturnAnInstanceOf(GitHubInstallation::class);
    }
}
