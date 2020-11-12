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

    public function testCreateHttpClientWithDefault()
    {
        $client = new WiracleClient('username', 'token');

        $this->assertEquals(10, $client->getHttpClient()->getConfig('timeout'));
    }

    public function testCreateHttpClientWithArray()
    {
        $client = new WiracleClient('username', 'token', [
            'timeout' => 20
        ]);

        $this->assertEquals(20, $client->getHttpClient()->getConfig('timeout'));
    }

    public function testCreateHttpClientWithCustomHttpClient()
    {
        $httpClient = new \GuzzleHttp\Client([
            'timeout' => 15
        ]);

        $client = new WiracleClient('username', 'token', $httpClient);
        $this->assertEquals(15, $client->getHttpClient()->getConfig('timeout'));

        $httpClient = new \GuzzleHttp\Client([
            'timeout' => 25
        ]);

        $client = new WiracleClient('username', 'token');
        $this->assertEquals(10, $client->getHttpClient()->getConfig('timeout'));

        $client->setHttpClient($httpClient);
        $this->assertEquals(25, $client->getHttpClient()->getConfig('timeout'));
    }
}
