<?php

namespace JustCommunication\WiracleSDK\API;

use JustCommunication\WiracleSDK\API\Model\Message\Message;

class MessageCreateRequest extends AbstractRequest
{
    const URI = '/api/post/add';
    const HTTP_METHOD = 'POST';
    const RESPONSE_CLASS = MessageCreateResponse::class;

    /**
     * @var string
     */
    protected $profile_id;

    /**
     * @var string
     */
    protected $channel_id;

    /**
     * @var string
     */
    protected $message_text;

    /**
     * @var array
     */
    protected $message_parts;

    static function withPlainText($profile_id, $channel_id, $text)
    {
        $request = new self();
        $request
            ->setMessageText($text)
            ->setProfileId($profile_id)
            ->setChannelId($channel_id);

        return $request;
    }

    static function withParts($profile_id, $channel_id, Message $message)
    {
        $request = new self();
        $request
            ->setMessageText($message->toArray())
            ->setProfileId($profile_id)
            ->setChannelId($channel_id);

        return $request;
    }

    /**
     * @return string
     */
    public function getProfileId()
    {
        return $this->profile_id;
    }

    /**
     * @param string $profile_id
     * @return MessageCreateRequest
     */
    public function setProfileId($profile_id)
    {
        $this->profile_id = $profile_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getChannelId()
    {
        return $this->channel_id;
    }

    /**
     * @param string $channel_id
     * @return MessageCreateRequest
     */
    public function setChannelId($channel_id)
    {
        $this->channel_id = $channel_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageText()
    {
        return $this->message_text;
    }

    /**
     * @param mixed $message_text
     * @return MessageCreateRequest
     */
    public function setMessageText($message_text)
    {
        $this->message_text = $message_text;
        return $this;
    }

    /**
     * @return array
     */
    public function getMessageParts()
    {
        return $this->message_parts;
    }

    /**
     * @param array $message_parts
     * @return MessageCreateRequest
     */
    public function setMessageParts($message_parts)
    {
        $this->message_parts = $message_parts;
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

        if ($this->message_text) {
            $params['form_params']['message'] = $this->message_text;
        } else if ($this->message_parts) {
            $params['form_params']['message'] = $this->message_parts;
        }

        return $params;
    }
}
