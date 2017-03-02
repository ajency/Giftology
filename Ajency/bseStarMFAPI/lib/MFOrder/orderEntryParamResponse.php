<?php

class orderEntryParamResponse
{

    /**
     * @var string $orderEntryParamResult
     */
    protected $orderEntryParamResult = null;

    /**
     * @param string $orderEntryParamResult
     */
    public function __construct($orderEntryParamResult)
    {
      $this->orderEntryParamResult = $orderEntryParamResult;
    }

    /**
     * @return string
     */
    public function getOrderEntryParamResult()
    {
      return $this->orderEntryParamResult;
    }

    /**
     * @param string $orderEntryParamResult
     * @return orderEntryParamResponse
     */
    public function setOrderEntryParamResult($orderEntryParamResult)
    {
      $this->orderEntryParamResult = $orderEntryParamResult;
      return $this;
    }

}
