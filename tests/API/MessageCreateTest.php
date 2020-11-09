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
}
