<?php

namespace JustCommunication\WiracleSDK\Model;

class Channel extends AbstractModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $access_level;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Channel
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
     * @return Channel
     */
    public function setCreated($created)
    {
        $this->created = $created;
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
     * @return Channel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessLevel()
    {
        return $this->access_level;
    }

    /**
     * @param string $access_level
     */
    public function setAccessLevel($access_level)
    {
        $this->access_level = $access_level;
    }
}
