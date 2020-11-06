<?php

namespace JustCommunication\WiracleSDK\Model;

class Account extends AbstractModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var integer
     */
    protected $count_new_notifications;

    /**
     * @var Profile
     */
    protected $current_profile;

    /**
     * @var Profile[]
     */
    protected $profiles;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Account
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $created
     * @return Account
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
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
     * @return Account
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountNewNotifications()
    {
        return $this->count_new_notifications;
    }

    /**
     * @param string $count_new_notifications
     * @return Account
     */
    public function setCountNewNotifications($count_new_notifications)
    {
        $this->count_new_notifications = $count_new_notifications;
        return $this;
    }

    /**
     * @return Profile
     */
    public function getCurrentProfile()
    {
        return $this->current_profile;
    }

    /**
     * @param Profile $current_profile
     * @return Account
     */
    public function setCurrentProfile($current_profile)
    {
        $this->current_profile = $current_profile;
        return $this;
    }

    /**
     * @return Profile[]
     */
    public function getProfiles()
    {
        return $this->profiles;
    }

    /**
     * @param Profile[] $profiles
     * @return Account
     */
    public function setProfiles($profiles)
    {
        $this->profiles = $profiles;
        return $this;
    }
}
