<?php

namespace Afom\DeployNotifier;

interface DeployNotifierInterface
{
    /**
     * @param Message $message
     *
     * @throws DeployNotifierException
     */
    public function sendNotification(Message $message);
}
