<?php
use JustCommunication\WiracleSDK\API\MessageCreateRequest;
use PHPUnit\Framework\TestCase;

class MessageCreateTest extends TestCase
{
    public function testMessageCreateWithEmptyMessage()
    {
        $messageCreateRequest = new MessageCreateRequest();
        $messageCreateRequest
            ->setChannelId(1)
            ->setProfileId(1)
        ;

        $this->assertEquals([
            'form_params' => [
                'profile_id' => 1,
                'channel_id' => 1
            ]
        ], $messageCreateRequest->createHttpClientParams());
    }

    public function testMessageCreateWithMessageWithEmptyParts()
    {
        $messageCreateRequest = new MessageCreateRequest();
        $messageCreateRequest
            ->setChannelId(1)
            ->setProfileId(1)
        ;

        $message = new JustCommunication\WiracleSDK\Model\Message\Message();

        $messageCreateRequest->setMessage($message);

        $this->assertEquals([
            'form_params' => [
                'profile_id' => 1,
                'channel_id' => 1,
                'message' => []
            ]
        ], $messageCreateRequest->createHttpClientParams());
    }

    public function testMessageCreateWithPlainText()
    {
        $messageCreateRequest = MessageCreateRequest::withPlainText(1, 1, 'Blablabla');

        $this->assertEquals([
            'form_params' => [
                'profile_id' => 1,
                'channel_id' => 1,
                'message' => [
                    [
                        'type' => 'text',
                        'content' => 'Blablabla'
                    ]
                ]
            ]
        ], $messageCreateRequest->createHttpClientParams());
    }

    public function testMessageCreateWithImage()
    {
        $messageCreateRequest = MessageCreateRequest::withImage(1, 1, 'http://wiracle.ru/logo.png');

        $this->assertEquals([
            'form_params' => [
                'profile_id' => 1,
                'channel_id' => 1,
                'message' => [
                    [
                        'type' => 'image',
                        'content' => 'http://wiracle.ru/logo.png',
                        'width' => null,
                        'height' => null
                    ]
                ]
            ]
        ], $messageCreateRequest->createHttpClientParams());
    }

    public function testMessageCreateComplexWithParts()
    {
        $message = new JustCommunication\WiracleSDK\Model\Message\Message([
            new JustCommunication\WiracleSDK\Model\Message\HeaderPart('Header'),
            new JustCommunication\WiracleSDK\Model\Message\TextPart('Text')
        ]);

        $message
            ->addPart(new JustCommunication\WiracleSDK\Model\Message\ImagePart('https://wiracle.ru/images/app_banner/512x512.png', 512, 512))
            ->addPart(new JustCommunication\WiracleSDK\Model\Message\CutlinePart())
            ->addPart(new JustCommunication\WiracleSDK\Model\Message\TextPart('Text 2'))
        ;

        $messageCreateRequest = MessageCreateRequest::withMessage(1, 1, $message);

        $this->assertEquals([
            'form_params' => [
                'profile_id' => 1,
                'channel_id' => 1,
                'message' => [
                    [
                        'type' => 'header',
                        'content' => 'Header'
                    ],
                    [
                        'type' => 'text',
                        'content' => 'Text'
                    ],
                    [
                        'type' => 'image',
                        'content' => 'https://wiracle.ru/images/app_banner/512x512.png',
                        'width' => 512,
                        'height' => 512
                    ],
                    [
                        'type' => 'cutline',
                    ],
                    [
                        'type' => 'text',
                        'content' => 'Text 2'
                    ]
                ]
            ]
        ], $messageCreateRequest->createHttpClientParams());
    }
}
