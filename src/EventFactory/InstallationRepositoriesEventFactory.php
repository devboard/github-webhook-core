<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\EventFactory;

use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\Event\InstallationRepositoriesEvent;
use DevboardLib\GitHubWebhook\Core\Event\InstallationRepositoriesEvent\InstallationRepositoriesAction;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationFactory;

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
                'id'       => new RepoId($item['id']),
                'fullName' => RepoFullName::createFromString($item['full_name']),
            ];
        }
        foreach ($data['repositories_removed'] as $item) {
            $removed[] = [
                'id'       => new RepoId($item['id']),
                'fullName' => RepoFullName::createFromString($item['full_name']),
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
