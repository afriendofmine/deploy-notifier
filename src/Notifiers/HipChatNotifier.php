<?php

namespace Afom\DeployNotifier\Notifiers;

use Afom\DeployNotifier\Exception\DeployNotifierException;
use GorkaLaucirica\HipchatAPIv2Client\API\RoomAPI;
use Afom\DeployNotifier\DeployNotifierInterface;
use Afom\DeployNotifier\Message;

class HipChatNotifier implements DeployNotifierInterface
{
    /** @var RoomAPI */
    private $client;

    /** @var string */
    private $roomID;

    /**
     * @param RoomAPI $client
     * @param string  $roomID
     */
    public function __construct(RoomAPI $client, $roomID)
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
            return $this->client->sendRoomNotification($this->roomID, $hipChatMessage);
        } catch (\Exception $exception) {
            throw new DeployNotifierException($exception->getMessage(), $exception->getCode());
        }
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
