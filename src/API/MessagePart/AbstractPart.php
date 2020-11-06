<?php

namespace JustCommunication\WiracleSDK\API\MessagePart;

abstract class AbstractPart implements PartInterface
{
    const TYPE = null;

    public $content = '';

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getType()
    {
        return $this::TYPE;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function toArray()
    {
        return ['type' => $this->getType(), 'content' => $this->getContent()];
    }
}

