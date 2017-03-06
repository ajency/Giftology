<?php

class sipOrderEntryParamResponse
{

    /**
     * @var string $sipOrderEntryParamResult
     */
    protected $sipOrderEntryParamResult = null;

    /**
     * @param string $sipOrderEntryParamResult
     */
    public function __construct($sipOrderEntryParamResult)
    {
      $this->sipOrderEntryParamResult = $sipOrderEntryParamResult;
    }

    /**
     * @return string
     */
    public function getSipOrderEntryParamResult()
    {
      return $this->sipOrderEntryParamResult;
    }

    /**
     * @param string $sipOrderEntryParamResult
     * @return sipOrderEntryParamResponse
     */
    public function setSipOrderEntryParamResult($sipOrderEntryParamResult)
    {
      $this->sipOrderEntryParamResult = $sipOrderEntryParamResult;
      return $this;
    }

}
