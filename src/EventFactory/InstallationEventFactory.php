<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\EventFactory;

use Devboard\GitHub\Webhook\Core\Event\InstallationEvent;
use Devboard\GitHub\Webhook\Core\Event\InstallationEvent\InstallationAction;
use Devboard\GitHub\Webhook\Core\EventFactory;
use Devboard\GitHub\Webhook\Core\EventFactory\InstallationEvent\InstallationFactory;

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
