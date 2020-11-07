<?php

namespace JustCommunication\WiracleSDK\Model\Message;

abstract class AbstractPart implements PartInterface
{
    const TYPE = null;

    public function getType()
    {
        return $this::TYPE;
    }

    public function toArray()
    {
        return ['type' => $this->getType()];
    }
}

