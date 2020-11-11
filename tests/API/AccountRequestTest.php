<?php

class AccountRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testRequest()
    {
        $request = new \JustCommunication\WiracleSDK\API\AccountRequest();

        $this->assertEquals('GET', $request->getHttpMethod());
        $this->assertEquals('/api/account', $request->getUri());
        $this->assertEquals([], $request->createHttpClientParams());
    }
}