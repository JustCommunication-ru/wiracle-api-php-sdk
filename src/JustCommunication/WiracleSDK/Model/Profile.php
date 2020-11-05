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
    protected $name;

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
}