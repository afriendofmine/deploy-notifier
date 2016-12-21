<?php

use Afom\DeployNotifier\Message;

interface DeployNotifierInterface
{
    /**
     * @param Message $message
     *
     * @throws DeployNotifierException
     */
    public function sendNotification(Message $message);
}
