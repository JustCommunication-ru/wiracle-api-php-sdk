<?php

namespace JustCommunication\WiracleSDK\Model;

class Profile extends AbstractModel
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
    protected $login;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $formatted_name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $char;

    /**
     * @var string
     */
    protected $photo;

    /**
     * @var integer
     */
    protected $count_new_notifications;

    /**
     * @var boolean
     */
    protected $only_subscribers;

    /**
     * @var string
     */
    protected $town;

    /**
     * @var string
     */
    protected $website;

    /**
     * @var string
     */
    protected $facebook;

    /**
     * @var string
     */
    protected $twitter;

    /**
     * @var string
     */
    protected $vkontakte;

    /**
     * @var Channel[]
     */
    protected $channels;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Profile
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
     * @return Profile
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return Profile
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Profile
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormattedName()
    {
        return $this->formatted_name;
    }

    /**
     * @param string $formatted_name
     * @return Profile
     */
    public function setFormattedName($formatted_name)
    {
        $this->formatted_name = $formatted_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Profile
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Profile
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Profile
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getChar()
    {
        return $this->char;
    }

    /**
     * @param string $char
     * @return Profile
     */
    public function setChar($char)
    {
        $this->char = $char;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return Profile
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return Channel[]
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @param Channel[] $channels
     * @return Profile
     */
    public function setChannels($channels)
    {
        $this->channels = $channels;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountNewNotifications()
    {
        return $this->count_new_notifications;
    }

    /**
     * @param int $count_new_notifications
     * @return Profile
     */
    public function setCountNewNotifications($count_new_notifications)
    {
        $this->count_new_notifications = $count_new_notifications;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOnlySubscribers()
    {
        return $this->only_subscribers;
    }

    /**
     * @param bool $only_subscribers
     * @return Profile
     */
    public function setOnlySubscribers($only_subscribers)
    {
        $this->only_subscribers = $only_subscribers;
        return $this;
    }

    /**
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param string $town
     * @return Profile
     */
    public function setTown($town)
    {
        $this->town = $town;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     * @return Profile
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param string $facebook
     * @return Profile
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
        return $this;
    }

    /**
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param string $twitter
     * @return Profile
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * @return string
     */
    public function getVkontakte()
    {
        return $this->vkontakte;
    }

    /**
     * @param string $vkontakte
     * @return Profile
     */
    public function setVkontakte($vkontakte)
    {
        $this->vkontakte = $vkontakte;
        return $this;
    }
}
