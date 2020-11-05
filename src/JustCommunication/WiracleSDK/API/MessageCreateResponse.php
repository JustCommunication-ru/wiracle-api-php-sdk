<?php
namespace JustCommunication\WiracleSDK\API;

class MessageCreateResponse extends AbstractResponse
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function setResponseData(array $data)
    {
        if (!isset($data['result'])) {
            throw new WiracleAPIException('Result missed from response data');
        }

        $this->id = $data['result']['id'];
        parent::setResponseData($data);
    }
}