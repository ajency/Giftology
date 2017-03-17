<?php

namespace BSEStarMF\MFOrder;

class switchOrderEntryParamResponse
{

    /**
     * @var string $switchOrderEntryParamResult
     */
    protected $switchOrderEntryParamResult = null;

    /**
     * @param string $switchOrderEntryParamResult
     */
    public function __construct($switchOrderEntryParamResult)
    {
      $this->switchOrderEntryParamResult = $switchOrderEntryParamResult;
    }

    /**
     * @return string
     */
    public function getSwitchOrderEntryParamResult()
    {
      return $this->switchOrderEntryParamResult;
    }

    /**
     * @param string $switchOrderEntryParamResult
     * @return \BSEStarMF\MFOrder\switchOrderEntryParamResponse
     */
    public function setSwitchOrderEntryParamResult($switchOrderEntryParamResult)
    {
      $this->switchOrderEntryParamResult = $switchOrderEntryParamResult;
      return $this;
    }

}
