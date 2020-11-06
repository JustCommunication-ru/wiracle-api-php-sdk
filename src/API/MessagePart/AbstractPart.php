<?php

namespace JustCommunication\WiracleSDK\API\MessagePart;

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

