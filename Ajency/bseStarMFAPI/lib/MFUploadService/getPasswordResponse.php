<?php

namespace BSEStarMF\MFUploadService;

class getPasswordResponse
{

    /**
     * @var string $getPasswordResult
     */
    protected $getPasswordResult = null;

    /**
     * @param string $getPasswordResult
     */
    public function __construct($getPasswordResult)
    {
      $this->getPasswordResult = $getPasswordResult;
    }

    /**
     * @return string
     */
    public function getGetPasswordResult()
    {
      return $this->getPasswordResult;
    }

    /**
     * @param string $getPasswordResult
     * @return \BSEStarMF\MFUploadService\getPasswordResponse
     */
    public function setGetPasswordResult($getPasswordResult)
    {
      $this->getPasswordResult = $getPasswordResult;
      return $this;
    }

}
