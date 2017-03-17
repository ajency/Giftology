<?php

namespace BSEStarMF\MFOrder;

class DecryptResponse
{

    /**
     * @var string $DecryptResult
     */
    protected $DecryptResult = null;

    /**
     * @param string $DecryptResult
     */
    public function __construct($DecryptResult)
    {
      $this->DecryptResult = $DecryptResult;
    }

    /**
     * @return string
     */
    public function getDecryptResult()
    {
      return $this->DecryptResult;
    }

    /**
     * @param string $DecryptResult
     * @return \BSEStarMF\MFOrder\DecryptResponse
     */
    public function setDecryptResult($DecryptResult)
    {
      $this->DecryptResult = $DecryptResult;
      return $this;
    }

}
