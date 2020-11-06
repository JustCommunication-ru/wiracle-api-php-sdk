<?php

namespace JustCommunication\WiracleSDK\API;

use JustCommunication\WiracleSDK\Model\Channel;
use JustCommunication\WiracleSDK\Model\Profile;

class ChannelsAvailableResponse extends AbstractResponse
{
    /**
     * @var Profile[]
     */
    protected $profiles = [];

    /**
     * @return Profile[]
     */
    public function getProfiles()
    {
        return $this->profiles;
    }

    /**
     * @inheritDoc
     */
    public function setResponseData(array $data)
    {
        if (!isset($data['result'])) {
            throw new WiracleAPIException('Result missed from response data');
        }

        foreach ($data['result'] as $profile_data) {
            $profile = new Profile();
            $profile->mapData($profile_data);

            $channels = [];
            foreach ($profile_data['channels'] as $channel_data) {
                $channel = new Channel();
                $channel->mapData($channel_data);

                $channels[] = $channel;
            }

            $profile->setChannels($channels);

            $this->profiles[] = $profile;
        }

        parent::setResponseData($data);
    }
}
