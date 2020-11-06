<?php

namespace JustCommunication\WiracleSDK\API\MessagePart;

interface PartInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return array
     */
    public function getContent();

    /**
     * @return array
     */
    public function toArray();
}
