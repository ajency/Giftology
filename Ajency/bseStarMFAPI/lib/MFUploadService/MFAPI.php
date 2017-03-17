<?php

namespace BSEStarMF\MFUploadService;

class MFAPI
{

    /**
     * @var string $Flag
     */
    protected $Flag = null;

    /**
     * @var string $UserId
     */
    protected $UserId = null;

    /**
     * @var string $EncryptedPassword
     */
    protected $EncryptedPassword = null;

    /**
     * @var string $param
     */
    protected $param = null;

    /**
     * @param string $Flag
     * @param string $UserId
     * @param string $EncryptedPassword
     * @param string $param
     */
    public function __construct($Flag, $UserId, $EncryptedPassword, $param)
    {
      $this->Flag = $Flag;
      $this->UserId = $UserId;
      $this->EncryptedPassword = $EncryptedPassword;
      $this->param = $param;
    }

    /**
     * @return string
     */
    public function getFlag()
    {
      return $this->Flag;
    }

    /**
     * @param string $Flag
     * @return \BSEStarMF\MFUploadService\MFAPI
     */
    public function setFlag($Flag)
    {
      $this->Flag = $Flag;
      return $this;
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
     * @return \BSEStarMF\MFUploadService\MFAPI
     */
    public function setUserId($UserId)
    {
      $this->UserId = $UserId;
      return $this;
    }

    /**
     * @return string
     */
    public function getEncryptedPassword()
    {
      return $this->EncryptedPassword;
    }

    /**
     * @param string $EncryptedPassword
     * @return \BSEStarMF\MFUploadService\MFAPI
     */
    public function setEncryptedPassword($EncryptedPassword)
    {
      $this->EncryptedPassword = $EncryptedPassword;
      return $this;
    }

    /**
     * @return string
     */
    public function getParam()
    {
      return $this->param;
    }

    /**
     * @param string $param
     * @return \BSEStarMF\MFUploadService\MFAPI
     */
    public function setParam($param)
    {
      $this->param = $param;
      return $this;
    }

}
