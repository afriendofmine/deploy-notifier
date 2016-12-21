<?php

namespace Afom\DeployNotifier\Tests\Factory;

use Afom\DeployNotifier\Factory\DeployNotifierFactory;
use Afom\DeployNotifier\Notifiers\HipChatNotifier;

class DeployNotifierFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var DeployNotifierFactory */
    private $deployNotifierFactory;

    public function setUp()
    {
        $config = [
            'hipchat' => [
                'room_id'    => 23123,
                'room_token' => 'super-secret',
            ],
        ];

        $this->deployNotifierFactory = new DeployNotifierFactory($config);
    }

    public function testGetHipChatNotifier()
    {
        $this->assertInstanceOf(HipChatNotifier::class ,$this->deployNotifierFactory->create(DeployNotifierFactory::HIPCHAT));
    }

    public function testDefaultNotifier()
    {
        $this->assertInstanceOf(HipChatNotifier::class ,$this->deployNotifierFactory->create('foo'));
    }
}
