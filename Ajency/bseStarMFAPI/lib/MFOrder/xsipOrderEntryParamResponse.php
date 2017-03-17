<?php

namespace BSEStarMF\MFOrder;

class xsipOrderEntryParamResponse
{

    /**
     * @var string $xsipOrderEntryParamResult
     */
    protected $xsipOrderEntryParamResult = null;

    /**
     * @param string $xsipOrderEntryParamResult
     */
    public function __construct($xsipOrderEntryParamResult)
    {
      $this->xsipOrderEntryParamResult = $xsipOrderEntryParamResult;
    }

    /**
     * @return string
     */
    public function getXsipOrderEntryParamResult()
    {
      return $this->xsipOrderEntryParamResult;
    }

    /**
     * @param string $xsipOrderEntryParamResult
     * @return \BSEStarMF\MFOrder\xsipOrderEntryParamResponse
     */
    public function setXsipOrderEntryParamResult($xsipOrderEntryParamResult)
    {
      $this->xsipOrderEntryParamResult = $xsipOrderEntryParamResult;
      return $this;
    }

}
