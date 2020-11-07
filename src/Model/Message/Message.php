<?php

namespace JustCommunication\WiracleSDK\Model\Message;

class Message
{
    /**
     * @var PartInterface[]
     */
    public $parts = [];

    public function addPart(PartInterface $part)
    {
        $this->parts[] = $part;
    }

    public function toArray()
    {
        $array = [];

        foreach ($this->parts as $part) {
            $array[] = $part->toArray();
        }

        return $array;
    }
}

