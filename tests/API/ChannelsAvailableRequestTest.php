<?php

class ChannelsAvailableRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testRequest()
    {
        $request = new \JustCommunication\WiracleSDK\API\ChannelsAvailableRequest(1);

        $this->assertEquals('GET', $request->getHttpMethod());
        $this->assertEquals('/api/profile/channels/available', $request->getUri());
        $this->assertEquals([
            'query' => [
                'profile_id' => 1
            ]
        ], $request->createHttpClientParams());
    }
}