<?php

use JustCommunication\WiracleSDK\WiracleClient;

class WiracleClientTest extends PHPUnit_Framework_TestCase
{
    public function testCallUndefinedMethod()
    {
        $client = new WiracleClient('username', 'token');

        $this->expectException(BadMethodCallException::class);
        $client->callSomeUndefinedRequest(new \JustCommunication\WiracleSDK\API\MessageCreateRequest());
    }

    public function testWiracleException()
    {
        $client = new WiracleClient('username', 'token');

        $this->expectException(\JustCommunication\WiracleSDK\API\WiracleAPIException::class);
        $this->expectExceptionMessage('Wiracle API Error: Unknown token key');

        $client->sendChannelsAvailableRequest(new \JustCommunication\WiracleSDK\API\ChannelsAvailableRequest(1));
    }
}
