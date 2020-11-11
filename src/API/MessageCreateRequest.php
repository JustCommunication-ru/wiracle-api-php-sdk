<?php

namespace JustCommunication\WiracleSDK\API;

use JustCommunication\WiracleSDK\Model\Message\Message;
use JustCommunication\WiracleSDK\Model\Message\TextPart;
use JustCommunication\WiracleSDK\Model\Message\ImagePart;

class MessageCreateRequest extends AbstractRequest
{
    const URI = '/api/post/add';
    const HTTP_METHOD = 'POST';
    const RESPONSE_CLASS = MessageCreateResponse::class;

    /**
     * @var int
     */
    protected $profile_id;

    /**
     * @var int
     */
    protected $channel_id;

    /**
     * @var Message
     */
    protected $message;

    /**
     * @param int $profile_id
     * @param int $channel_id
     * @param string $text
     *
     * @return MessageCreateRequest
     */
    static function withPlainText($profile_id, $channel_id, $text)
    {
        $message = new Message([
            new TextPart($text)
        ]);

        return self::withMessage($profile_id, $channel_id, $message);
    }

    /**
     * @param int $profile_id
     * @param int $channel_id
     * @param string $src
     * @param int|null $width
     * @param int|null $height
     *
     * @return MessageCreateRequest
     */
    static function withImage($profile_id, $channel_id, $src, $width = null, $height = null)
    {
        $message = new Message([
            new ImagePart($src, $width, $height)
        ]);

        return self::withMessage($profile_id, $channel_id, $message);
    }

    /**
     * @param int $profile_id
     * @param int $channel_id
     * @param Message $message
     *
     * @return MessageCreateRequest
     */
    static function withMessage($profile_id, $channel_id, Message $message)
    {
        $request = new self();
        $request
            ->setMessage($message)
            ->setProfileId($profile_id)
            ->setChannelId($channel_id)
        ;

        return $request;
    }

    /**
     * @param int $profile_id
     * @param int $channel_id
     * @param Message $message
     * @return MessageCreateRequest
     *
     * @deprecated use MessageCreateRequest::withMessage method
     */
    static function withParts($profile_id, $channel_id, Message $message)
    {
        return self::withMessage($profile_id, $channel_id, $message);
    }

    /**
     * @return int
     */
    public function getProfileId()
    {
        return $this->profile_id;
    }

    /**
     * @param int $profile_id
     * @return MessageCreateRequest
     */
    public function setProfileId($profile_id)
    {
        $this->profile_id = $profile_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getChannelId()
    {
        return $this->channel_id;
    }

    /**
     * @param int $channel_id
     * @return MessageCreateRequest
     */
    public function setChannelId($channel_id)
    {
        $this->channel_id = $channel_id;
        return $this;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     * @return MessageCreateRequest
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function createHttpClientParams()
    {
        $params = [
            'form_params' => [
                'profile_id' => $this->getProfileId(),
                'channel_id' => $this->getChannelId()
            ]
        ];

        if ($this->message) {
            $params['form_params']['message'] = $this->message->toArray();
        }

        return $params;
    }
}
