<?php

namespace JustCommunication\WiracleSDK\Model\Message;

abstract class AbstractPartWithContent extends AbstractPart implements PartWithContentInterface
{
    protected $content;

    public function __construct($content)
    {
        $this->setContent($content);
    }

    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), ['content' => $this->getContent()]);
    }
}

