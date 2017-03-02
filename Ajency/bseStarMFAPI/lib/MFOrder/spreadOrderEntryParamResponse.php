<?php

class spreadOrderEntryParamResponse
{

    /**
     * @var string $spreadOrderEntryParamResult
     */
    protected $spreadOrderEntryParamResult = null;

    /**
     * @param string $spreadOrderEntryParamResult
     */
    public function __construct($spreadOrderEntryParamResult)
    {
      $this->spreadOrderEntryParamResult = $spreadOrderEntryParamResult;
    }

    /**
     * @return string
     */
    public function getSpreadOrderEntryParamResult()
    {
      return $this->spreadOrderEntryParamResult;
    }

    /**
     * @param string $spreadOrderEntryParamResult
     * @return spreadOrderEntryParamResponse
     */
    public function setSpreadOrderEntryParamResult($spreadOrderEntryParamResult)
    {
      $this->spreadOrderEntryParamResult = $spreadOrderEntryParamResult;
      return $this;
    }

}
