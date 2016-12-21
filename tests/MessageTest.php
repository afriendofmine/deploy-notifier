<?php

namespace Afom\DeployNotifier\Tests;

use Afom\DeployNotifier\Message;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $message = new Message('foo', 'bar', 'gray');

        $this->assertSame('foo', $message->getFrom());
        $this->assertSame('bar', $message->getBody());
        $this->assertSame('gray', $message->getColor());

        $message->setFrom('foo-test');
        $this->assertSame('foo-test', $message->getFrom());

        $message->setBody('bar-test');
        $this->assertSame('bar-test', $message->getBody());

        $message->setColor('red');
        $this->assertSame('red', $message->getColor());
    }
}
