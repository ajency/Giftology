<?php

class orderEntryParam
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
     * @var string $UserID
     */
    protected $UserID = null;

    /**
     * @var string $MemberId
     */
    protected $MemberId = null;

    /**
     * @var string $ClientCode
     */
    protected $ClientCode = null;

    /**
     * @var string $SchemeCd
     */
    protected $SchemeCd = null;

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
     * @var string $Qty
     */
    protected $Qty = null;

    /**
     * @var string $AllRedeem
     */
    protected $AllRedeem = null;

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
     * @var string $RefNo
     */
    protected $RefNo = null;

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
     * @var string $DPC
     */
    protected $DPC = null;

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
     * @param string $UserID
     * @param string $MemberId
     * @param string $ClientCode
     * @param string $SchemeCd
     * @param string $BuySell
     * @param string $BuySellType
     * @param string $DPTxn
     * @param string $OrderVal
     * @param string $Qty
     * @param string $AllRedeem
     * @param string $FolioNo
     * @param string $Remarks
     * @param string $KYCStatus
     * @param string $RefNo
     * @param string $SubBrCode
     * @param string $EUIN
     * @param string $EUINVal
     * @param string $MinRedeem
     * @param string $DPC
     * @param string $IPAdd
     * @param string $Password
     * @param string $PassKey
     * @param string $Parma1
     * @param string $Param2
     * @param string $Param3
     */
    public function __construct($TransCode, $TransNo, $OrderId, $UserID, $MemberId, $ClientCode, $SchemeCd, $BuySell, $BuySellType, $DPTxn, $OrderVal, $Qty, $AllRedeem, $FolioNo, $Remarks, $KYCStatus, $RefNo, $SubBrCode, $EUIN, $EUINVal, $MinRedeem, $DPC, $IPAdd, $Password, $PassKey, $Parma1, $Param2, $Param3)
    {
      $this->TransCode = $TransCode;
      $this->TransNo = $TransNo;
      $this->OrderId = $OrderId;
      $this->UserID = $UserID;
      $this->MemberId = $MemberId;
      $this->ClientCode = $ClientCode;
      $this->SchemeCd = $SchemeCd;
      $this->BuySell = $BuySell;
      $this->BuySellType = $BuySellType;
      $this->DPTxn = $DPTxn;
      $this->OrderVal = $OrderVal;
      $this->Qty = $Qty;
      $this->AllRedeem = $AllRedeem;
      $this->FolioNo = $FolioNo;
      $this->Remarks = $Remarks;
      $this->KYCStatus = $KYCStatus;
      $this->RefNo = $RefNo;
      $this->SubBrCode = $SubBrCode;
      $this->EUIN = $EUIN;
      $this->EUINVal = $EUINVal;
      $this->MinRedeem = $MinRedeem;
      $this->DPC = $DPC;
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
     */
    public function setOrderId($OrderId)
    {
      $this->OrderId = $OrderId;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserID()
    {
      return $this->UserID;
    }

    /**
     * @param string $UserID
     * @return orderEntryParam
     */
    public function setUserID($UserID)
    {
      $this->UserID = $UserID;
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
     * @return orderEntryParam
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
     * @return orderEntryParam
     */
    public function setClientCode($ClientCode)
    {
      $this->ClientCode = $ClientCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getSchemeCd()
    {
      return $this->SchemeCd;
    }

    /**
     * @param string $SchemeCd
     * @return orderEntryParam
     */
    public function setSchemeCd($SchemeCd)
    {
      $this->SchemeCd = $SchemeCd;
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
     */
    public function setOrderVal($OrderVal)
    {
      $this->OrderVal = $OrderVal;
      return $this;
    }

    /**
     * @return string
     */
    public function getQty()
    {
      return $this->Qty;
    }

    /**
     * @param string $Qty
     * @return orderEntryParam
     */
    public function setQty($Qty)
    {
      $this->Qty = $Qty;
      return $this;
    }

    /**
     * @return string
     */
    public function getAllRedeem()
    {
      return $this->AllRedeem;
    }

    /**
     * @param string $AllRedeem
     * @return orderEntryParam
     */
    public function setAllRedeem($AllRedeem)
    {
      $this->AllRedeem = $AllRedeem;
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
     */
    public function setKYCStatus($KYCStatus)
    {
      $this->KYCStatus = $KYCStatus;
      return $this;
    }

    /**
     * @return string
     */
    public function getRefNo()
    {
      return $this->RefNo;
    }

    /**
     * @param string $RefNo
     * @return orderEntryParam
     */
    public function setRefNo($RefNo)
    {
      $this->RefNo = $RefNo;
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
     */
    public function setMinRedeem($MinRedeem)
    {
      $this->MinRedeem = $MinRedeem;
      return $this;
    }

    /**
     * @return string
     */
    public function getDPC()
    {
      return $this->DPC;
    }

    /**
     * @param string $DPC
     * @return orderEntryParam
     */
    public function setDPC($DPC)
    {
      $this->DPC = $DPC;
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
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
     * @return orderEntryParam
     */
    public function setParam3($Param3)
    {
      $this->Param3 = $Param3;
      return $this;
    }

}
