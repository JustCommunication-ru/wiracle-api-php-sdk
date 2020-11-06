<?php

namespace JustCommunication\WiracleSDK\API\MessagePart;

class ImagePart extends AbstractPartWithContent
{
    const TYPE = 'image';

    public $width;
    public $height;

    public function __construct($content, $width = null, $height = null)
    {
        $this->width = $width;
        $this->height = $height;

        parent::__construct($content);
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), ['width' => $this->width, 'height' => $this->height]);
    }
}
