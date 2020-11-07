<?php

use JustCommunication\WiracleSDK\Model\Message\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testMessageWithParts()
    {
        $message = new Message();
        $message
            ->addPart(new \JustCommunication\WiracleSDK\Model\Message\TextPart('Test string'))
            ->addPart(new \JustCommunication\WiracleSDK\Model\Message\ImagePart('https://wiracle.ru/logo.png', 100, 200))
            ->addPart(new \JustCommunication\WiracleSDK\Model\Message\CutlinePart())
            ->addPart(new \JustCommunication\WiracleSDK\Model\Message\HeaderPart('I am a header'))
        ;

        $this->assertEquals([
            [
                'type' => 'text',
                'content' => 'Test string'
            ],
            [
                'type' => 'image',
                'content' => 'https://wiracle.ru/logo.png',
                'width' => 100,
                'height' => 200
            ],
            [
                'type' => 'cutline'
            ],
            [
                'type' => 'header',
                'content' => 'I am a header'
            ]
        ], $message->toArray());
    }
}
