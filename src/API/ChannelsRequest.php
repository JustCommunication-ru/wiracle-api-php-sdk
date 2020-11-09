<?php

namespace JustCommunication\WiracleSDK\API;

class ChannelsRequest extends AbstractRequest
{
    const URI = '/api/profile/channels';
    const HTTP_METHOD = 'GET';
    const RESPONSE_CLASS = ChannelsResponse::class;

    /**
     * @var int
     */
    protected $profile_id;

    /**
     * ChannelsRequest constructor.
     *
     * @param int $profile_id
     */
    public function __construct($profile_id)
    {
        $this->profile_id = $profile_id;
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
     * @return ChannelsRequest
     */
    public function setProfileId($profile_id)
    {
        $this->profile_id = $profile_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function createHttpClientParams()
    {
        return [
            'query' => [
                'profile_id' => $this->profile_id
            ]
        ];
    }
}
