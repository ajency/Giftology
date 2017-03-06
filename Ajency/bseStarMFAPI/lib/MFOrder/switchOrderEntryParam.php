<?php

class switchOrderEntryParam
{

    /**
     * @var string $TransCode
     */
    protected $TransCode = null;

    /**
     * @var string $TransNo
     */
    protected $TransNo = null;

    /**
     * @var string $OrderId
     */
    protected $OrderId = null;

    /**
     * @var string $UserId
     */
    protected $UserId = null;

    /**
     * @var string $MemberId
     */
    protected $MemberId = null;

    /**
     * @var string $ClientCode
     */
    protected $ClientCode = null;

    /**
     * @var string $FromSchemeCd
     */
    protected $FromSchemeCd = null;

    /**
     * @var string $ToSchemeCd
     */
    protected $ToSchemeCd = null;

    /**
     * @var string $BuySell
     */
    protected $BuySell = null;

    /**
     * @var string $BuySellType
     */
    protected $BuySellType = null;

    /**
     * @var string $DPTxn
     */
    protected $DPTxn = null;

    /**
     * @var string $OrderVal
     */
    protected $OrderVal = null;

    /**
     * @var string $SwitchUnits
     */
    protected $SwitchUnits = null;

    /**
     * @var string $AllUnitsFlag
     */
    protected $AllUnitsFlag = null;

    /**
     * @var string $FolioNo
     */
    protected $FolioNo = null;

    /**
     * @var string $Remarks
     */
    protected $Remarks = null;

    /**
     * @var string $KYCStatus
     */
    protected $KYCStatus = null;

    /**
     * @var string $SubBrCode
     */
    protected $SubBrCode = null;

    /**
     * @var string $EUIN
     */
    protected $EUIN = null;

    /**
     * @var string $EUINVal
     */
    protected $EUINVal = null;

    /**
     * @var string $MinRedeem
     */
    protected $MinRedeem = null;

    /**
     * @var string $IPAdd
     */
    protected $IPAdd = null;

    /**
     * @var string $Password
     */
    protected $Password = null;

    /**
     * @var string $PassKey
     */
    protected $PassKey = null;

    /**
     * @var string $Parma1
     */
    protected $Parma1 = null;

    /**
     * @var string $Param2
     */
    protected $Param2 = null;

    /**
     * @var string $Param3
     */
    protected $Param3 = null;

    /**
     * @param string $TransCode
     * @param string $TransNo
     * @param string $OrderId
     * @param string $UserId
     * @param string $MemberId
     * @param string $ClientCode
     * @param string $FromSchemeCd
     * @param string $ToSchemeCd
     * @param string $BuySell
     * @param string $BuySellType
     * @param string $DPTxn
     * @param string $OrderVal
     * @param string $SwitchUnits
     * @param string $AllUnitsFlag
     * @param string $FolioNo
     * @param string $Remarks
     * @param string $KYCStatus
     * @param string $SubBrCode
     * @param string $EUIN
     * @param string $EUINVal
     * @param string $MinRedeem
     * @param string $IPAdd
     * @param string $Password
     * @param string $PassKey
     * @param string $Parma1
     * @param string $Param2
     * @param string $Param3
     */
    public function __construct($TransCode, $TransNo, $OrderId, $UserId, $MemberId, $ClientCode, $FromSchemeCd, $ToSchemeCd, $BuySell, $BuySellType, $DPTxn, $OrderVal, $SwitchUnits, $AllUnitsFlag, $FolioNo, $Remarks, $KYCStatus, $SubBrCode, $EUIN, $EUINVal, $MinRedeem, $IPAdd, $Password, $PassKey, $Parma1, $Param2, $Param3)
    {
      $this->TransCode = $TransCode;
      $this->TransNo = $TransNo;
      $this->OrderId = $OrderId;
      $this->UserId = $UserId;
      $this->MemberId = $MemberId;
      $this->ClientCode = $ClientCode;
      $this->FromSchemeCd = $FromSchemeCd;
      $this->ToSchemeCd = $ToSchemeCd;
      $this->BuySell = $BuySell;
      $this->BuySellType = $BuySellType;
      $this->DPTxn = $DPTxn;
      $this->OrderVal = $OrderVal;
      $this->SwitchUnits = $SwitchUnits;
      $this->AllUnitsFlag = $AllUnitsFlag;
      $this->FolioNo = $FolioNo;
      $this->Remarks = $Remarks;
      $this->KYCStatus = $KYCStatus;
      $this->SubBrCode = $SubBrCode;
      $this->EUIN = $EUIN;
      $this->EUINVal = $EUINVal;
      $this->MinRedeem = $MinRedeem;
      $this->IPAdd = $IPAdd;
      $this->Password = $Password;
      $this->PassKey = $PassKey;
      $this->Parma1 = $Parma1;
      $this->Param2 = $Param2;
      $this->Param3 = $Param3;
    }

    /**
     * @return string
     */
    public function getTransCode()
    {
      return $this->TransCode;
    }

    /**
     * @param string $TransCode
     * @return switchOrderEntryParam
     */
    public function setTransCode($TransCode)
    {
      $this->TransCode = $TransCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getTransNo()
    {
      return $this->TransNo;
    }

    /**
     * @param string $TransNo
     * @return switchOrderEntryParam
     */
    public function setTransNo($TransNo)
    {
      $this->TransNo = $TransNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
      return $this->OrderId;
    }

    /**
     * @param string $OrderId
     * @return switchOrderEntryParam
     */
    public function setOrderId($OrderId)
    {
      $this->OrderId = $OrderId;
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
     * @return switchOrderEntryParam
     */
    public function setUserId($UserId)
    {
      $this->UserId = $UserId;
      return $this;
    }

    /**
     * @return string
     */
    public function getMemberId()
    {
      return $this->MemberId;
    }

    /**
     * @param string $MemberId
     * @return switchOrderEntryParam
     */
    public function setMemberId($MemberId)
    {
      $this->MemberId = $MemberId;
      return $this;
    }

    /**
     * @return string
     */
    public function getClientCode()
    {
      return $this->ClientCode;
    }

    /**
     * @param string $ClientCode
     * @return switchOrderEntryParam
     */
    public function setClientCode($ClientCode)
    {
      $this->ClientCode = $ClientCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getFromSchemeCd()
    {
      return $this->FromSchemeCd;
    }

    /**
     * @param string $FromSchemeCd
     * @return switchOrderEntryParam
     */
    public function setFromSchemeCd($FromSchemeCd)
    {
      $this->FromSchemeCd = $FromSchemeCd;
      return $this;
    }

    /**
     * @return string
     */
    public function getToSchemeCd()
    {
      return $this->ToSchemeCd;
    }

    /**
     * @param string $ToSchemeCd
     * @return switchOrderEntryParam
     */
    public function setToSchemeCd($ToSchemeCd)
    {
      $this->ToSchemeCd = $ToSchemeCd;
      return $this;
    }

    /**
     * @return string
     */
    public function getBuySell()
    {
      return $this->BuySell;
    }

    /**
     * @param string $BuySell
     * @return switchOrderEntryParam
     */
    public function setBuySell($BuySell)
    {
      $this->BuySell = $BuySell;
      return $this;
    }

    /**
     * @return string
     */
    public function getBuySellType()
    {
      return $this->BuySellType;
    }

    /**
     * @param string $BuySellType
     * @return switchOrderEntryParam
     */
    public function setBuySellType($BuySellType)
    {
      $this->BuySellType = $BuySellType;
      return $this;
    }

    /**
     * @return string
     */
    public function getDPTxn()
    {
      return $this->DPTxn;
    }

    /**
     * @param string $DPTxn
     * @return switchOrderEntryParam
     */
    public function setDPTxn($DPTxn)
    {
      $this->DPTxn = $DPTxn;
      return $this;
    }

    /**
     * @return string
     */
    public function getOrderVal()
    {
      return $this->OrderVal;
    }

    /**
     * @param string $OrderVal
     * @return switchOrderEntryParam
     */
    public function setOrderVal($OrderVal)
    {
      $this->OrderVal = $OrderVal;
      return $this;
    }

    /**
     * @return string
     */
    public function getSwitchUnits()
    {
      return $this->SwitchUnits;
    }

    /**
     * @param string $SwitchUnits
     * @return switchOrderEntryParam
     */
    public function setSwitchUnits($SwitchUnits)
    {
      $this->SwitchUnits = $SwitchUnits;
      return $this;
    }

    /**
     * @return string
     */
    public function getAllUnitsFlag()
    {
      return $this->AllUnitsFlag;
    }

    /**
     * @param string $AllUnitsFlag
     * @return switchOrderEntryParam
     */
    public function setAllUnitsFlag($AllUnitsFlag)
    {
      $this->AllUnitsFlag = $AllUnitsFlag;
      return $this;
    }

    /**
     * @return string
     */
    public function getFolioNo()
    {
      return $this->FolioNo;
    }

    /**
     * @param string $FolioNo
     * @return switchOrderEntryParam
     */
    public function setFolioNo($FolioNo)
    {
      $this->FolioNo = $FolioNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getRemarks()
    {
      return $this->Remarks;
    }

    /**
     * @param string $Remarks
     * @return switchOrderEntryParam
     */
    public function setRemarks($Remarks)
    {
      $this->Remarks = $Remarks;
      return $this;
    }

    /**
     * @return string
     */
    public function getKYCStatus()
    {
      return $this->KYCStatus;
    }

    /**
     * @param string $KYCStatus
     * @return switchOrderEntryParam
     */
    public function setKYCStatus($KYCStatus)
    {
      $this->KYCStatus = $KYCStatus;
      return $this;
    }

    /**
     * @return string
     */
    public function getSubBrCode()
    {
      return $this->SubBrCode;
    }

    /**
     * @param string $SubBrCode
     * @return switchOrderEntryParam
     */
    public function setSubBrCode($SubBrCode)
    {
      $this->SubBrCode = $SubBrCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getEUIN()
    {
      return $this->EUIN;
    }

    /**
     * @param string $EUIN
     * @return switchOrderEntryParam
     */
    public function setEUIN($EUIN)
    {
      $this->EUIN = $EUIN;
      return $this;
    }

    /**
     * @return string
     */
    public function getEUINVal()
    {
      return $this->EUINVal;
    }

    /**
     * @param string $EUINVal
     * @return switchOrderEntryParam
     */
    public function setEUINVal($EUINVal)
    {
      $this->EUINVal = $EUINVal;
      return $this;
    }

    /**
     * @return string
     */
    public function getMinRedeem()
    {
      return $this->MinRedeem;
    }

    /**
     * @param string $MinRedeem
     * @return switchOrderEntryParam
     */
    public function setMinRedeem($MinRedeem)
    {
      $this->MinRedeem = $MinRedeem;
      return $this;
    }

    /**
     * @return string
     */
    public function getIPAdd()
    {
      return $this->IPAdd;
    }

    /**
     * @param string $IPAdd
     * @return switchOrderEntryParam
     */
    public function setIPAdd($IPAdd)
    {
      $this->IPAdd = $IPAdd;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
      return $this->Password;
    }

    /**
     * @param string $Password
     * @return switchOrderEntryParam
     */
    public function setPassword($Password)
    {
      $this->Password = $Password;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassKey()
    {
      return $this->PassKey;
    }

    /**
     * @param string $PassKey
     * @return switchOrderEntryParam
     */
    public function setPassKey($PassKey)
    {
      $this->PassKey = $PassKey;
      return $this;
    }

    /**
     * @return string
     */
    public function getParma1()
    {
      return $this->Parma1;
    }

    /**
     * @param string $Parma1
     * @return switchOrderEntryParam
     */
    public function setParma1($Parma1)
    {
      $this->Parma1 = $Parma1;
      return $this;
    }

    /**
     * @return string
     */
    public function getParam2()
    {
      return $this->Param2;
    }

    /**
     * @param string $Param2
     * @return switchOrderEntryParam
     */
    public function setParam2($Param2)
    {
      $this->Param2 = $Param2;
      return $this;
    }

    /**
     * @return string
     */
    public function getParam3()
    {
      return $this->Param3;
    }

    /**
     * @param string $Param3
     * @return switchOrderEntryParam
     */
    public function setParam3($Param3)
    {
      $this->Param3 = $Param3;
      return $this;
    }

}
