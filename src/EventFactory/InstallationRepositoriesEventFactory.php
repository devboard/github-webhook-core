<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Repo\GitHubRepoFullName;
use Devboard\GitHub\Repo\GitHubRepoId;
use Devboard\GitHub\Webhook\Core\Event\InstallationRepositoriesEvent;
use Devboard\GitHub\Webhook\Core\Event\InstallationRepositoriesEvent\InstallationRepositoriesAction;
use Devboard\GitHub\Webhook\Core\EventFactory\InstallationEvent\InstallationFactory;

/**
 * @see InstallationRepositoriesEventFactorySpec
 * @see InstallationRepositoriesEventFactoryTest
 */
class InstallationRepositoriesEventFactory
{
    /** @var InstallationFactory */
    private $installationFactory;
    /** @var SenderFactory */
    private $senderFactory;

    public function __construct(
        InstallationFactory $installationFactory,
        SenderFactory $senderFactory
    ) {
        $this->installationFactory = $installationFactory;
        $this->senderFactory       = $senderFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'installation';
    }

    public function create(array $data): InstallationRepositoriesEvent
    {
        $added   = [];
        $removed = [];

        foreach ($data['repositories_added'] as $item) {
            $added[] = [
                'id'       => new GitHubRepoId($item['id']),
                'fullName' => GitHubRepoFullName::createFromString($item['full_name']),
            ];
        }
        foreach ($data['repositories_removed'] as $item) {
            $removed[] = [
                'id'       => new GitHubRepoId($item['id']),
                'fullName' => GitHubRepoFullName::createFromString($item['full_name']),
            ];
        }

        return new InstallationRepositoriesEvent(
            new InstallationRepositoriesAction($data['action']),
            $this->installationFactory->create($data['installation']),
            $added,
            $removed,
            $this->senderFactory->create($data['sender'])
        );
    }
}
