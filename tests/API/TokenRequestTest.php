<?php

class TokenRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testRequest()
    {
        $request = new \JustCommunication\WiracleSDK\API\TokenRequest('email@email.ru', '123');

        $this->assertEquals('POST', $request->getHttpMethod());
        $this->assertEquals('/api/token', $request->getUri());
        $this->assertEquals([
            'form_params' => [
                'email' => 'email@email.ru',
                'password' => md5('123')
            ]
        ], $request->createHttpClientParams());
    }
}