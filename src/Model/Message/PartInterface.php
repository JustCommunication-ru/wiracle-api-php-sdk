<?php

namespace JustCommunication\WiracleSDK\Model\Message;

interface PartInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return array
     */
    public function toArray();
}
