<?php

namespace JustCommunication\WiracleSDK\API;

class AccountRequest extends AbstractRequest
{
    const URI = '/api/account';
    const HTTP_METHOD = 'GET';
    const RESPONSE_CLASS = AccountResponse::class;
}
