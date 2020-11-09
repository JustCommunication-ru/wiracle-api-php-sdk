<?php

namespace JustCommunication\WiracleSDK\Model\Message;

class Message
{
    /**
     * @var PartInterface[]
     */
    protected $parts = [];

    /**
     * Message constructor.
     * @param PartInterface[]|null $parts
     */
    public function __construct(array $parts = null)
    {
        if ($parts) {
            $this->setParts($parts);
        }
    }

    /**
     * @param PartInterface[] $parts
     * @return $this
     */
    public function setParts(array $parts)
    {
        $this->parts = [];
        $this->addParts($parts);

        return $this;
    }

    /**
     * @param PartInterface[] $parts
     * @return $this
     */
    public function addParts(array $parts)
    {
        foreach ($parts as $part) {
            $this->addPart($part);
        }

        return $this;
    }

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
