<?php

declare(strict_types=1);

namespace Devboard\GitHub\Webhook\Core\Event\PushEvent;

/**
 * @see PushEventStateSpec
 * @see PushEventStateTest
 */
class PushEventState
{
    /** @var bool */
    private $created;
    /** @var bool */
    private $deleted;
    /** @var bool */
    private $forced;

    public function __construct(bool $created, bool $deleted, bool $forced)
    {
        $this->created = $created;
        $this->deleted = $deleted;
        $this->forced  = $forced;
    }

    public function isCreated(): bool
    {
        return $this->created;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function isForced(): bool
    {
        return $this->forced;
    }
}
