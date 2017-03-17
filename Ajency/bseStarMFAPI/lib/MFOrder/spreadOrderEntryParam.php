<?php

namespace BSEStarMF\MFOrder;

class spreadOrderEntryParam
{

    /**
     * @var string $TransactionCode
     */
    protected $TransactionCode = null;

    /**
     * @var string $UniqueRefNo
     */
    protected $UniqueRefNo = null;

    /**
     * @var string $OrderID
     */
    protected $OrderID = null;

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
     * @var string $SchemeCode
     */
    protected $SchemeCode = null;

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
     * @var string $OrderValue
     */
    protected $OrderValue = null;

    /**
     * @var string $RedemptionAmt
     */
    protected $RedemptionAmt = null;

    /**
     * @var string $AllUnitFlag
     */
    protected $AllUnitFlag = null;

    /**
     * @var string $RedeemDate
     */
    protected $RedeemDate = null;

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
     * @var string $SubBroCode
     */
    protected $SubBroCode = null;

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
     * @var string $IPAddress
     */
    protected $IPAddress = null;

    /**
     * @var string $Password
     */
    protected $Password = null;

    /**
     * @var string $PassKey
     */
    protected $PassKey = null;

    /**
     * @var string $Param1
     */
    protected $Param1 = null;

    /**
     * @var string $Param2
     */
    protected $Param2 = null;

    /**
     * @var string $Param3
     */
    protected $Param3 = null;

    /**
     * @param string $TransactionCode
     * @param string $UniqueRefNo
     * @param string $OrderID
     * @param string $UserID
     * @param string $MemberId
     * @param string $ClientCode
     * @param string $SchemeCode
     * @param string $BuySell
     * @param string $BuySellType
     * @param string $DPTxn
     * @param string $OrderValue
     * @param string $RedemptionAmt
     * @param string $AllUnitFlag
     * @param string $RedeemDate
     * @param string $FolioNo
     * @param string $Remarks
     * @param string $KYCStatus
     * @param string $RefNo
     * @param string $SubBroCode
     * @param string $EUIN
     * @param string $EUINVal
     * @param string $MinRedeem
     * @param string $DPC
     * @param string $IPAddress
     * @param string $Password
     * @param string $PassKey
     * @param string $Param1
     * @param string $Param2
     * @param string $Param3
     */
    public function __construct($TransactionCode, $UniqueRefNo, $OrderID, $UserID, $MemberId, $ClientCode, $SchemeCode, $BuySell, $BuySellType, $DPTxn, $OrderValue, $RedemptionAmt, $AllUnitFlag, $RedeemDate, $FolioNo, $Remarks, $KYCStatus, $RefNo, $SubBroCode, $EUIN, $EUINVal, $MinRedeem, $DPC, $IPAddress, $Password, $PassKey, $Param1, $Param2, $Param3)
    {
      $this->TransactionCode = $TransactionCode;
      $this->UniqueRefNo = $UniqueRefNo;
      $this->OrderID = $OrderID;
      $this->UserID = $UserID;
      $this->MemberId = $MemberId;
      $this->ClientCode = $ClientCode;
      $this->SchemeCode = $SchemeCode;
      $this->BuySell = $BuySell;
      $this->BuySellType = $BuySellType;
      $this->DPTxn = $DPTxn;
      $this->OrderValue = $OrderValue;
      $this->RedemptionAmt = $RedemptionAmt;
      $this->AllUnitFlag = $AllUnitFlag;
      $this->RedeemDate = $RedeemDate;
      $this->FolioNo = $FolioNo;
      $this->Remarks = $Remarks;
      $this->KYCStatus = $KYCStatus;
      $this->RefNo = $RefNo;
      $this->SubBroCode = $SubBroCode;
      $this->EUIN = $EUIN;
      $this->EUINVal = $EUINVal;
      $this->MinRedeem = $MinRedeem;
      $this->DPC = $DPC;
      $this->IPAddress = $IPAddress;
      $this->Password = $Password;
      $this->PassKey = $PassKey;
      $this->Param1 = $Param1;
      $this->Param2 = $Param2;
      $this->Param3 = $Param3;
    }

    /**
     * @return string
     */
    public function getTransactionCode()
    {
      return $this->TransactionCode;
    }

    /**
     * @param string $TransactionCode
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setTransactionCode($TransactionCode)
    {
      $this->TransactionCode = $TransactionCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getUniqueRefNo()
    {
      return $this->UniqueRefNo;
    }

    /**
     * @param string $UniqueRefNo
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setUniqueRefNo($UniqueRefNo)
    {
      $this->UniqueRefNo = $UniqueRefNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getOrderID()
    {
      return $this->OrderID;
    }

    /**
     * @param string $OrderID
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setOrderID($OrderID)
    {
      $this->OrderID = $OrderID;
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setClientCode($ClientCode)
    {
      $this->ClientCode = $ClientCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getSchemeCode()
    {
      return $this->SchemeCode;
    }

    /**
     * @param string $SchemeCode
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setSchemeCode($SchemeCode)
    {
      $this->SchemeCode = $SchemeCode;
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setDPTxn($DPTxn)
    {
      $this->DPTxn = $DPTxn;
      return $this;
    }

    /**
     * @return string
     */
    public function getOrderValue()
    {
      return $this->OrderValue;
    }

    /**
     * @param string $OrderValue
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setOrderValue($OrderValue)
    {
      $this->OrderValue = $OrderValue;
      return $this;
    }

    /**
     * @return string
     */
    public function getRedemptionAmt()
    {
      return $this->RedemptionAmt;
    }

    /**
     * @param string $RedemptionAmt
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setRedemptionAmt($RedemptionAmt)
    {
      $this->RedemptionAmt = $RedemptionAmt;
      return $this;
    }

    /**
     * @return string
     */
    public function getAllUnitFlag()
    {
      return $this->AllUnitFlag;
    }

    /**
     * @param string $AllUnitFlag
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setAllUnitFlag($AllUnitFlag)
    {
      $this->AllUnitFlag = $AllUnitFlag;
      return $this;
    }

    /**
     * @return string
     */
    public function getRedeemDate()
    {
      return $this->RedeemDate;
    }

    /**
     * @param string $RedeemDate
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setRedeemDate($RedeemDate)
    {
      $this->RedeemDate = $RedeemDate;
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setRefNo($RefNo)
    {
      $this->RefNo = $RefNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getSubBroCode()
    {
      return $this->SubBroCode;
    }

    /**
     * @param string $SubBroCode
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setSubBroCode($SubBroCode)
    {
      $this->SubBroCode = $SubBroCode;
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setDPC($DPC)
    {
      $this->DPC = $DPC;
      return $this;
    }

    /**
     * @return string
     */
    public function getIPAddress()
    {
      return $this->IPAddress;
    }

    /**
     * @param string $IPAddress
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setIPAddress($IPAddress)
    {
      $this->IPAddress = $IPAddress;
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setPassKey($PassKey)
    {
      $this->PassKey = $PassKey;
      return $this;
    }

    /**
     * @return string
     */
    public function getParam1()
    {
      return $this->Param1;
    }

    /**
     * @param string $Param1
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setParam1($Param1)
    {
      $this->Param1 = $Param1;
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
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
     * @return \BSEStarMF\MFOrder\spreadOrderEntryParam
     */
    public function setParam3($Param3)
    {
      $this->Param3 = $Param3;
      return $this;
    }

}
