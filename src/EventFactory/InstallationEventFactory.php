<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\EventFactory;

use DevboardLib\GitHubWebhook\Core\Event\InstallationEvent;
use DevboardLib\GitHubWebhook\Core\Event\InstallationEvent\InstallationAction;
use DevboardLib\GitHubWebhook\Core\EventFactory;
use DevboardLib\GitHubWebhook\Core\EventFactory\InstallationEvent\InstallationFactory;

/**
 * @see InstallationEventFactorySpec
 * @see InstallationEventFactoryTest
 */
class InstallationEventFactory implements EventFactory
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

    public function create(array $data): InstallationEvent
    {
        return new InstallationEvent(
            new InstallationAction($data['action']),
            $this->installationFactory->create($data['installation']),
            $this->senderFactory->create($data['sender'])
        );
    }
}
