<?php

class MFAPIResponse
{

    /**
     * @var string $MFAPIResult
     */
    protected $MFAPIResult = null;

    /**
     * @param string $MFAPIResult
     */
    public function __construct($MFAPIResult)
    {
      $this->MFAPIResult = $MFAPIResult;
    }

    /**
     * @return string
     */
    public function getMFAPIResult()
    {
      return $this->MFAPIResult;
    }

    /**
     * @param string $MFAPIResult
     * @return MFAPIResponse
     */
    public function setMFAPIResult($MFAPIResult)
    {
      $this->MFAPIResult = $MFAPIResult;
      return $this;
    }

}
