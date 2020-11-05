<?php
namespace JustCommunication\WiracleSDK\API;

abstract class AbstractResponse implements ResponseInterface
{
    protected $response_data;

    /**
     * @inheritDoc
     */
    public function setResponseData(array $response_data)
    {
        $this->response_data = $response_data;
    }
}