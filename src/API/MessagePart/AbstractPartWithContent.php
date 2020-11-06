<?php

namespace JustCommunication\WiracleSDK\API\MessagePart;

abstract class AbstractPartWithContent extends AbstractPart implements PartWithContentInterface
{
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function toArray()
    {
        return [parent::toArray(), 'content' => $this->getContent()];
    }
}

