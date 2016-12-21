<?php

namespace Afom\DeployNotifier;

class Message
{
    /** @var string */
    private $from;

    /** @var string */
    private $body;

    /** @var string */
    private $color;

    /** @var boolean */
    private $html = false;

    /**
     * @param string $from
     * @param string $body
     * @param string $color
     */
    public function __construct($from = '', $body = '', $color = '')
    {
        $this->from = $from;
        $this->body = $body;
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return boolean
     */
    public function isHtml()
    {
        return $this->html;
    }

    /**
     * @param boolean $html
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }
}
