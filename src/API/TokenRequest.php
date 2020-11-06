<?php

namespace JustCommunication\WiracleSDK\API;

class TokenRequest extends AbstractRequest
{
    const URI = '/api/token';
    const HTTP_METHOD = 'POST';
    const RESPONSE_CLASS = TokenResponse::class;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * TokenRequest constructor.
     *
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return TokenRequest
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return TokenRequest
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function createHttpClientParams()
    {
        return [
            'form_params' => [
                'email' => $this->getEmail(),
                'password' => $this->getPassword()
            ]
        ];
    }
}
