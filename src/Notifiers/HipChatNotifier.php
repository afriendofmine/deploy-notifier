<?php

namespace Afom\DeployNotifier\Notifiers;

use Afom\DeployNotifier\Exception\DeployNotifierException;
use GorkaLaucirica\HipchatAPIv2Client\API\RoomAPI;
use Afom\DeployNotifier\DeployNotifierInterface;
use GorkaLaucirica\HipchatAPIv2Client\Client;
use Afom\DeployNotifier\Message;

class HipChatNotifier implements DeployNotifierInterface
{
    /** @var Client */
    private $client;

    /** @var string */
    private $roomID;

    /**
     * @param Client $client
     * @param string $roomID
     */
    public function __construct(Client $client, $roomID)
    {
        $this->client = $client;
        $this->roomID = $roomID;
    }

    /**
     * @param Message $message
     *
     * @throws DeployNotifierException
     */
    public function sendNotification(Message $message)
    {
        $hipChatMessage = $this->createHipChatMessage($message);

        try {
            return $this->getRoomAPI()->sendRoomNotification($this->roomID, $hipChatMessage);
        } catch (\Exception $exception) {
            throw new DeployNotifierException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @return RoomAPI
     */
    private function getRoomAPI()
    {
        return new RoomAPI($this->client);
    }

    /**
     * @param Message $message
     *
     * @return \GorkaLaucirica\HipchatAPIv2Client\Model\Message
     */
    private function createHipChatMessage(Message $message)
    {
        $hipChatMessage = new \GorkaLaucirica\HipchatAPIv2Client\Model\Message();
        $hipChatMessage->setFrom($message->getFrom());
        $hipChatMessage->setMessage($message->getBody());
        $hipChatMessage->setColor($message->getColor());
        $hipChatMessage->setNotify(true);

        if ($message->isHtml()) {
            $hipChatMessage->setMessageFormat('html');
        }

        return $hipChatMessage;
    }
}
