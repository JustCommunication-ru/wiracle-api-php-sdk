<?php

use JustCommunication\WiracleSDK\Model\Message\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testMessageWithParts()
    {
        $expected_parts = [
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
        ];

        $message = new Message();
        $message
            ->addPart(new \JustCommunication\WiracleSDK\Model\Message\TextPart('Test string'))
            ->addPart(new \JustCommunication\WiracleSDK\Model\Message\ImagePart('https://wiracle.ru/logo.png', 100, 200))
            ->addPart(new \JustCommunication\WiracleSDK\Model\Message\CutlinePart())
            ->addPart(new \JustCommunication\WiracleSDK\Model\Message\HeaderPart('I am a header'))
        ;

        $this->assertEquals($expected_parts, $message->toArray());

        $message = new Message([
            new \JustCommunication\WiracleSDK\Model\Message\TextPart('Test string'),
            new \JustCommunication\WiracleSDK\Model\Message\ImagePart('https://wiracle.ru/logo.png', 100, 200),
            new \JustCommunication\WiracleSDK\Model\Message\CutlinePart(),
            new \JustCommunication\WiracleSDK\Model\Message\HeaderPart('I am a header')
        ]);

        $this->assertEquals($expected_parts, $message->toArray());
    }
}
