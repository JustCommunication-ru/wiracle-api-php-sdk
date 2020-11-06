<?php

namespace JustCommunication\WiracleSDK\API;

use JustCommunication\WiracleSDK\Model\Account;
use JustCommunication\WiracleSDK\Model\Profile;

class AccountResponse extends AbstractResponse
{
    /**
     * @var Account
     */
    protected $account;

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @inheritDoc
     */
    public function setResponseData(array $data)
    {
        if (!isset($data['result'])) {
            throw new WiracleAPIException('Result missed from response data');
        }

        if (!isset($data['result']['current_profile'])) {
            throw new WiracleAPIException('Current profile missed from response data');
        }

        if (!isset($data['result']['profiles'])) {
            throw new WiracleAPIException('Profiles missed from response data');
        }

        $account = new Account();
        $account->mapData($data['result']);

        $currentProfile = new Profile();
        $currentProfile->mapData($data['result']['current_profile']);

        $account->setCurrentProfile($currentProfile);

        $profiles = [];

        foreach ($data['result']['profiles'] as $profile_data) {
            $profile = new Profile();
            $profile->mapData($profile_data);

            $profiles[] = $profile;
        }

        $account->setProfiles($profiles);

        $this->account = $account;

        parent::setResponseData($data);
    }
}
