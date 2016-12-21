<?php

namespace Afom\DeployNotifier\Factory;

use Afom\DeployNotifier\DeployNotifierInterface;
use Afom\DeployNotifier\Notifiers\HipChatNotifier;
use GorkaLaucirica\HipchatAPIv2Client\API\RoomAPI;
use GorkaLaucirica\HipchatAPIv2Client\Auth\OAuth2;
use GorkaLaucirica\HipchatAPIv2Client\Client;

final class DeployNotifierFactory
{
    const HIPCHAT = 'hipchat';

    /** @var array */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $type
     *
     * @return DeployNotifierInterface
     */
    public function create($type = '')
    {
        switch ($type) {
            case self::HIPCHAT:
                return $this->getHipChatNotifier();
            default:
                return $this->getHipChatNotifier();
        }
    }

    /**
     * @return HipChatNotifier
     */
    private function getHipChatNotifier()
    {
        $roomId = $this->config['hipchat']['room_id'];
        $token = $this->config['hipchat']['room_token'];

        $client = new Client(new OAuth2($token));

        return new HipChatNotifier(new RoomAPI($client), $roomId);
    }
}
