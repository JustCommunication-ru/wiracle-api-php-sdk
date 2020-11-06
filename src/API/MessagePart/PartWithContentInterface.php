<?php

namespace JustCommunication\WiracleSDK\API\MessagePart;

interface PartWithContentInterface extends PartInterface
{
    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     */
    public function setContent($content);
}
