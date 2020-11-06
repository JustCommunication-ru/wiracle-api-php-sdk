<?php

namespace JustCommunication\WiracleSDK\API;

class ChannelsAvailableRequest extends AbstractRequest
{
    const URI = '/api/profile/channels/available';
    const HTTP_METHOD = 'GET';
    const RESPONSE_CLASS = ChannelsAvailableResponse::class;

    /**
     * @var int
     */
    protected $profile_id;

    /**
     * ChannelsAvailableRequest constructor.
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
     * @return ChannelsAvailableRequest
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
