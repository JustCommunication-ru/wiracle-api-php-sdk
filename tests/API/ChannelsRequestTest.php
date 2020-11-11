<?php

class ChannelsRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testRequest()
    {
        $request = new \JustCommunication\WiracleSDK\API\ChannelsRequest(1);

        $this->assertEquals('GET', $request->getHttpMethod());
        $this->assertEquals('/api/profile/channels', $request->getUri());
        $this->assertEquals([
            'query' => [
                'profile_id' => 1
            ]
        ], $request->createHttpClientParams());
    }
}