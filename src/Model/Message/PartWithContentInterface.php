<?php

namespace JustCommunication\WiracleSDK\Model\Message;

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
