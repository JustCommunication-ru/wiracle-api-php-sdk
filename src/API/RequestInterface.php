<?php

namespace JustCommunication\WiracleSDK\API;

interface RequestInterface
{
    /**
     * @return string
     */
    public function getUri();

    /**
     * @return string
     */
    public function getHttpMethod();

    /**
     * @return array
     */
    public function createHttpClientParams();

    /**
     * @return string
     */
    public function getResponseClass();
}
