<?php

namespace JustCommunication\WiracleSDK\API\MessagePart;

class ImagePart extends AbstractPart
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
        $array = parent::toArray();

        return array_merge($array, ['width' => $this->width, 'height' => $this->height]);
    }
}
