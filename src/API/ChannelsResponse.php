<?php

namespace JustCommunication\WiracleSDK\API;

use JustCommunication\WiracleSDK\Model\Channel;

class ChannelsResponse extends AbstractResponse
{
    /**
     * @var Channel[]
     */
    protected $channels = [];

    /**
     * @return Channel[]
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @inheritDoc
     */
    public function setResponseData(array $data)
    {
        if (!isset($data['result'])) {
            throw new WiracleAPIException('Result missed from response data');
        }

        foreach ($data['result'] as $channel_data) {
            $channel = new Channel();
            $channel->mapData($channel_data);

            $this->channels[] = $channel;
        }

        parent::setResponseData($data);
    }
}
