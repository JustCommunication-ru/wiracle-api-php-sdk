<?php

namespace JustCommunication\WiracleSDK\API;

interface ResponseInterface
{
    /**
     * @param array $data
     * @return void
     *
     * @throws WiracleAPIException
     */
    public function setResponseData(array $data);
}
