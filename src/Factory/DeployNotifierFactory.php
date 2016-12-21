<?php

namespace Afom\DeployNotifier\Factory;

use Afom\DeployNotifier\DeployNotifierInterface;
use Afom\DeployNotifier\Notifiers\HipChatNotifier;
use GorkaLaucirica\HipchatAPIv2Client\Auth\OAuth2;
use GorkaLaucirica\HipchatAPIv2Client\Client;

final class DeployNotifierFactory
{
    const HIPCHAT = 'hipchat';

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
        $client = new Client(new OAuth2(config('deploy-notifier.notifiers.hipchat.room_token')));

        return new HipChatNotifier($client, config('deploy-notifier.notifiers.hipchat.room_id'));
    }
}
