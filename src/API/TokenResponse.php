<?php

namespace JustCommunication\WiracleSDK\API;

class TokenResponse extends AbstractResponse
{
    /**
     * @var string
     */
    protected $token = '';

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @inheritDoc
     */
    public function setResponseData(array $data)
    {
        if (!isset($data['result'])) {
            throw new WiracleAPIException('Result missed from response data');
        }

        $this->token = $data['result'];

        parent::setResponseData($data);
    }
}
