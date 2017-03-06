<?php

class Decrypt
{

    /**
     * @var string $pwd
     */
    protected $pwd = null;

    /**
     * @param string $pwd
     */
    public function __construct($pwd)
    {
      $this->pwd = $pwd;
    }

    /**
     * @return string
     */
    public function getPwd()
    {
      return $this->pwd;
    }

    /**
     * @param string $pwd
     * @return Decrypt
     */
    public function setPwd($pwd)
    {
      $this->pwd = $pwd;
      return $this;
    }

}
