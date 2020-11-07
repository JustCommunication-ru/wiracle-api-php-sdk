<?php

namespace JustCommunication\WiracleSDK\Model\Message;

class Message
{
    /**
     * @var PartInterface[]
     */
    protected $parts = [];

    /**
     * @param PartInterface $part
     * @return $this
     */
    public function addPart(PartInterface $part)
    {
        $this->parts[] = $part;

        return $this;
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
