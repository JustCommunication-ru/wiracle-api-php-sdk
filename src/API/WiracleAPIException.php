<?php
namespace JustCommunication\WiracleSDK\API;

class WiracleAPIException extends \Exception
{
    /**
     * @var string|int
     */
    protected $error_code;

    public function __construct($message, $error_code = null)
    {
        $this->error_code = $error_code;
        parent::__construct($message);
    }

    /**
     * @return int|string
     */
    public function getErrorCode()
    {
        return $this->error_code;
    }
}
