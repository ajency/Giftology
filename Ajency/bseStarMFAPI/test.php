<?php
include 'class-amfg-bse-star-mf.php';

$parameters = [
    'TransCode' => 'transCode',
    'TransNo' => 'transNo',
    'OrderId' => 'orderId',
    'UserID' => 'userID',
    'MemberId' => 'memberId',
    'ClientCode' => 'clientCode',
    'SchemeCd' => 'schemeCd',
    'BuySell' => 'buySell',
    'BuySellType' => 'buySellType',
    'DPTxn' => 'dPTxn',
    'OrderVal' => 'orderVal',
    'Qty' => 'qty',
    'AllRedeem' => 'allRedeem',
    'FolioNo' => 'folioNo',
    'Remarks' => 'remarks',
    'KYCStatus' => 'kYCStatus',
    'RefNo' => 'refNo',
    'SubBrCode' => 'subBrCode',
    'EUIN' => 'eUIN',
    'EUINVal' => 'eUINVal',
    'MinRedeem' => 'minRedeem',
    'DPC' => 'dPC',
    'IPAdd' => 'iPAdd',
    'Password' => 'password',
    'PassKey' => 'passKey',
    'Parma1' => 'parma1',
    'Param2' => 'param2',
    'Param3' => 'param3',
];
$star_mf = new AMFG_BSE_Star_MF();
$response = $star_mf->amfg_starmf_create_fund($parameters,true);
print_r($response);

