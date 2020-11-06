<?php

use JustCommunication\WiracleSDK\WiracleClient;

class WiracleClientTest extends PHPUnit_Framework_TestCase
{
    public function testCreateChannelsAvailableRequest()
    {
        $client = new WiracleClient('username', 'token');

        $request = new \JustCommunication\WiracleSDK\API\ChannelsAvailableRequest(1);
        $this->assertEquals('GET', $request->getHttpMethod());
        $this->assertEquals('/api/profile/channels/available', $request->getUri());
        $this->assertEquals(\JustCommunication\WiracleSDK\API\ChannelsAvailableResponse::class, $request->getResponseClass());
    }

    public function testCallUndefinedMethod()
    {
        $client = new WiracleClient('username', 'token');

        $this->expectException(BadMethodCallException::class);
        $client->callSomeUndefinedRequest(new \JustCommunication\WiracleSDK\API\MessageCreateRequest());
    }

    public function testGetToken()
    {
        $this->markTestSkipped('Please specify username and password to run this method');
        $token = WiracleClient::getToken('', '');
    }
}
