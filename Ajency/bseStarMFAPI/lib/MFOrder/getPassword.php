<?php

class getPassword
{

    /**
     * @var string $UserId
     */
    protected $UserId = null;

    /**
     * @var string $Password
     */
    protected $Password = null;

    /**
     * @var string $PassKey
     */
    protected $PassKey = null;

    /**
     * @param string $UserId
     * @param string $Password
     * @param string $PassKey
     */
    public function __construct($UserId, $Password, $PassKey)
    {
      $this->UserId = $UserId;
      $this->Password = $Password;
      $this->PassKey = $PassKey;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
      return $this->UserId;
    }

    /**
     * @param string $UserId
     * @return getPassword
     */
    public function setUserId($UserId)
    {
      $this->UserId = $UserId;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
      return $this->Password;
    }

    /**
     * @param string $Password
     * @return getPassword
     */
    public function setPassword($Password)
    {
      $this->Password = $Password;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassKey()
    {
      return $this->PassKey;
    }

    /**
     * @param string $PassKey
     * @return getPassword
     */
    public function setPassKey($PassKey)
    {
      $this->PassKey = $PassKey;
      return $this;
    }

}
