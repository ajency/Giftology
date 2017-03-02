<?php

class sipOrderEntryParam
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
     * @var string $SchemeCode
     */
    protected $SchemeCode = null;

    /**
     * @var string $MemberCode
     */
    protected $MemberCode = null;

    /**
     * @var string $ClientCode
     */
    protected $ClientCode = null;

    /**
     * @var string $UserID
     */
    protected $UserID = null;

    /**
     * @var string $InternalRefNo
     */
    protected $InternalRefNo = null;

    /**
     * @var string $TransMode
     */
    protected $TransMode = null;

    /**
     * @var string $DpTxnMode
     */
    protected $DpTxnMode = null;

    /**
     * @var string $StartDate
     */
    protected $StartDate = null;

    /**
     * @var string $FrequencyType
     */
    protected $FrequencyType = null;

    /**
     * @var string $FrequencyAllowed
     */
    protected $FrequencyAllowed = null;

    /**
     * @var string $InstallmentAmount
     */
    protected $InstallmentAmount = null;

    /**
     * @var string $NoOfInstallment
     */
    protected $NoOfInstallment = null;

    /**
     * @var string $Remarks
     */
    protected $Remarks = null;

    /**
     * @var string $FolioNo
     */
    protected $FolioNo = null;

    /**
     * @var string $FirstOrderFlag
     */
    protected $FirstOrderFlag = null;

    /**
     * @var string $SubberCode
     */
    protected $SubberCode = null;

    /**
     * @var string $Euin
     */
    protected $Euin = null;

    /**
     * @var string $EuinVal
     */
    protected $EuinVal = null;

    /**
     * @var string $DPC
     */
    protected $DPC = null;

    /**
     * @var string $RegId
     */
    protected $RegId = null;

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
     * @param string $SchemeCode
     * @param string $MemberCode
     * @param string $ClientCode
     * @param string $UserID
     * @param string $InternalRefNo
     * @param string $TransMode
     * @param string $DpTxnMode
     * @param string $StartDate
     * @param string $FrequencyType
     * @param string $FrequencyAllowed
     * @param string $InstallmentAmount
     * @param string $NoOfInstallment
     * @param string $Remarks
     * @param string $FolioNo
     * @param string $FirstOrderFlag
     * @param string $SubberCode
     * @param string $Euin
     * @param string $EuinVal
     * @param string $DPC
     * @param string $RegId
     * @param string $IPAdd
     * @param string $Password
     * @param string $PassKey
     * @param string $Param1
     * @param string $Param2
     * @param string $Param3
     */
    public function __construct($TransactionCode, $UniqueRefNo, $SchemeCode, $MemberCode, $ClientCode, $UserID, $InternalRefNo, $TransMode, $DpTxnMode, $StartDate, $FrequencyType, $FrequencyAllowed, $InstallmentAmount, $NoOfInstallment, $Remarks, $FolioNo, $FirstOrderFlag, $SubberCode, $Euin, $EuinVal, $DPC, $RegId, $IPAdd, $Password, $PassKey, $Param1, $Param2, $Param3)
    {
      $this->TransactionCode = $TransactionCode;
      $this->UniqueRefNo = $UniqueRefNo;
      $this->SchemeCode = $SchemeCode;
      $this->MemberCode = $MemberCode;
      $this->ClientCode = $ClientCode;
      $this->UserID = $UserID;
      $this->InternalRefNo = $InternalRefNo;
      $this->TransMode = $TransMode;
      $this->DpTxnMode = $DpTxnMode;
      $this->StartDate = $StartDate;
      $this->FrequencyType = $FrequencyType;
      $this->FrequencyAllowed = $FrequencyAllowed;
      $this->InstallmentAmount = $InstallmentAmount;
      $this->NoOfInstallment = $NoOfInstallment;
      $this->Remarks = $Remarks;
      $this->FolioNo = $FolioNo;
      $this->FirstOrderFlag = $FirstOrderFlag;
      $this->SubberCode = $SubberCode;
      $this->Euin = $Euin;
      $this->EuinVal = $EuinVal;
      $this->DPC = $DPC;
      $this->RegId = $RegId;
      $this->IPAdd = $IPAdd;
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
     * @return sipOrderEntryParam
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
     * @return sipOrderEntryParam
     */
    public function setUniqueRefNo($UniqueRefNo)
    {
      $this->UniqueRefNo = $UniqueRefNo;
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
     * @return sipOrderEntryParam
     */
    public function setSchemeCode($SchemeCode)
    {
      $this->SchemeCode = $SchemeCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getMemberCode()
    {
      return $this->MemberCode;
    }

    /**
     * @param string $MemberCode
     * @return sipOrderEntryParam
     */
    public function setMemberCode($MemberCode)
    {
      $this->MemberCode = $MemberCode;
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
     * @return sipOrderEntryParam
     */
    public function setClientCode($ClientCode)
    {
      $this->ClientCode = $ClientCode;
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
     * @return sipOrderEntryParam
     */
    public function setUserID($UserID)
    {
      $this->UserID = $UserID;
      return $this;
    }

    /**
     * @return string
     */
    public function getInternalRefNo()
    {
      return $this->InternalRefNo;
    }

    /**
     * @param string $InternalRefNo
     * @return sipOrderEntryParam
     */
    public function setInternalRefNo($InternalRefNo)
    {
      $this->InternalRefNo = $InternalRefNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getTransMode()
    {
      return $this->TransMode;
    }

    /**
     * @param string $TransMode
     * @return sipOrderEntryParam
     */
    public function setTransMode($TransMode)
    {
      $this->TransMode = $TransMode;
      return $this;
    }

    /**
     * @return string
     */
    public function getDpTxnMode()
    {
      return $this->DpTxnMode;
    }

    /**
     * @param string $DpTxnMode
     * @return sipOrderEntryParam
     */
    public function setDpTxnMode($DpTxnMode)
    {
      $this->DpTxnMode = $DpTxnMode;
      return $this;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
      return $this->StartDate;
    }

    /**
     * @param string $StartDate
     * @return sipOrderEntryParam
     */
    public function setStartDate($StartDate)
    {
      $this->StartDate = $StartDate;
      return $this;
    }

    /**
     * @return string
     */
    public function getFrequencyType()
    {
      return $this->FrequencyType;
    }

    /**
     * @param string $FrequencyType
     * @return sipOrderEntryParam
     */
    public function setFrequencyType($FrequencyType)
    {
      $this->FrequencyType = $FrequencyType;
      return $this;
    }

    /**
     * @return string
     */
    public function getFrequencyAllowed()
    {
      return $this->FrequencyAllowed;
    }

    /**
     * @param string $FrequencyAllowed
     * @return sipOrderEntryParam
     */
    public function setFrequencyAllowed($FrequencyAllowed)
    {
      $this->FrequencyAllowed = $FrequencyAllowed;
      return $this;
    }

    /**
     * @return string
     */
    public function getInstallmentAmount()
    {
      return $this->InstallmentAmount;
    }

    /**
     * @param string $InstallmentAmount
     * @return sipOrderEntryParam
     */
    public function setInstallmentAmount($InstallmentAmount)
    {
      $this->InstallmentAmount = $InstallmentAmount;
      return $this;
    }

    /**
     * @return string
     */
    public function getNoOfInstallment()
    {
      return $this->NoOfInstallment;
    }

    /**
     * @param string $NoOfInstallment
     * @return sipOrderEntryParam
     */
    public function setNoOfInstallment($NoOfInstallment)
    {
      $this->NoOfInstallment = $NoOfInstallment;
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
     * @return sipOrderEntryParam
     */
    public function setRemarks($Remarks)
    {
      $this->Remarks = $Remarks;
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
     * @return sipOrderEntryParam
     */
    public function setFolioNo($FolioNo)
    {
      $this->FolioNo = $FolioNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getFirstOrderFlag()
    {
      return $this->FirstOrderFlag;
    }

    /**
     * @param string $FirstOrderFlag
     * @return sipOrderEntryParam
     */
    public function setFirstOrderFlag($FirstOrderFlag)
    {
      $this->FirstOrderFlag = $FirstOrderFlag;
      return $this;
    }

    /**
     * @return string
     */
    public function getSubberCode()
    {
      return $this->SubberCode;
    }

    /**
     * @param string $SubberCode
     * @return sipOrderEntryParam
     */
    public function setSubberCode($SubberCode)
    {
      $this->SubberCode = $SubberCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getEuin()
    {
      return $this->Euin;
    }

    /**
     * @param string $Euin
     * @return sipOrderEntryParam
     */
    public function setEuin($Euin)
    {
      $this->Euin = $Euin;
      return $this;
    }

    /**
     * @return string
     */
    public function getEuinVal()
    {
      return $this->EuinVal;
    }

    /**
     * @param string $EuinVal
     * @return sipOrderEntryParam
     */
    public function setEuinVal($EuinVal)
    {
      $this->EuinVal = $EuinVal;
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
     * @return sipOrderEntryParam
     */
    public function setDPC($DPC)
    {
      $this->DPC = $DPC;
      return $this;
    }

    /**
     * @return string
     */
    public function getRegId()
    {
      return $this->RegId;
    }

    /**
     * @param string $RegId
     * @return sipOrderEntryParam
     */
    public function setRegId($RegId)
    {
      $this->RegId = $RegId;
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
     * @return sipOrderEntryParam
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
     * @return sipOrderEntryParam
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
     * @return sipOrderEntryParam
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
     * @return sipOrderEntryParam
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
     * @return sipOrderEntryParam
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
     * @return sipOrderEntryParam
     */
    public function setParam3($Param3)
    {
      $this->Param3 = $Param3;
      return $this;
    }

}
