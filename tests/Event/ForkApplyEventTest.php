<?php

declare(strict_types=1);

namespace tests\Devboard\GitHub\Webhook\Core\Event;

use Devboard\GitHub\Webhook\Core\Event\ForkApplyEvent;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-25 at 20:06:58.
 */
class ForkApplyEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ForkApplyEvent
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ForkApplyEvent();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
