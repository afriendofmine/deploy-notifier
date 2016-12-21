<?php

namespace Afom\DeployNotifier\Tests\Notifiers;

use Afom\DeployNotifier\Message;
use Afom\DeployNotifier\Notifiers\HipChatNotifier;
use GorkaLaucirica\HipchatAPIv2Client\API\RoomAPI;

class HipChatNotifierTest extends \PHPUnit_Framework_TestCase
{
    /** @var HipChatNotifier */
    private $hipChatNotifier;

    /** @var \PHPUnit_Framework_MockObject_MockObject|RoomAPI */
    private $client;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Message */
    private $message;

    public function setUp()
    {
        $this->client = $this->createClientMock();
        $this->message = $this->createMessageMock();

        $this->hipChatNotifier = new HipChatNotifier($this->client, 123);
    }

    public function testSendNotification()
    {
        $this->client->expects($this->once())
            ->method('sendRoomNotification')
            ->with(123, $this->isInstanceOf(\GorkaLaucirica\HipchatAPIv2Client\Model\Message::class));

        $this->hipChatNotifier->sendNotification($this->message);
    }

    /**
     * @expectedException \Afom\DeployNotifier\Exception\DeployNotifierException
     */
    public function testSendNotificationWillThrowDeployNotifierException()
    {
        $this->client->expects($this->once())
            ->method('sendRoomNotification')
            ->with(123, $this->isInstanceOf(\GorkaLaucirica\HipchatAPIv2Client\Model\Message::class))
            ->willThrowException(new \Exception);

        $this->hipChatNotifier->sendNotification($this->message);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RoomAPI
     */
    private function createClientMock()
    {
        return $this->getMockBuilder(RoomAPI::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Message
     */
    private function createMessageMock()
    {
        return $this->getMockBuilder(Message::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
