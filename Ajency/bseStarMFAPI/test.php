<?php
include 'class-amfg-bse-star-mf.php';
include 'class-amfg-bse-star-mf-fund.php';
include 'class-amfg-bse-star-mf-additional.php';

print "<pre>";

$user_id = 1248901;
$member_id = 12489;
$password = 'pass123';
$pass_key_string = 'abcdefghij';

$star_mf_additional = new AMFG_BSE_Star_MF_Additional();
$encrypted_password = $response = $star_mf_additional->amfg_starmf_login(
    $user_id,
    $member_id,
    $password,
    $pass_key_string,
    true);

$clients = [
    1 => [
        'id' => 'montest1', 'name' => 'V VARUN KUMAR','pan' => 'ADXPV6128J',
    ],
    2 => [
        'id' => 'montest2', 'name' => 'Amar Singh', 'pan' => 'BLUPS4233F',
    ],
    3 => [
        'id' => 'montest3', 'name' => 'DURAISAMY MANIKANDAN', 'pan' => 'BNZPM2501F',
    ],
    4 => [
        'id' => 'montest4', 'name' => 'Alloha wani', 'pan' => 'AAXPF1344F',
    ],
    5 => [
        'id' => 'montest5', 'name' => 'Anton Furtad', 'pan' => 'AAXPF1344F',
    ],
    6 => [
        'id' => 'montest6', 'name' => 'Amar', 'pan' => 'BLUPS4233F',
    ],
    7 => [
        'id' => 'montest7', 'name' => 'SURYABHAN YADAV', 'pan' => 'AHEPY8216D',
    ],
    8 => [
        'id' => 'montest8', 'name' => 'R ANANDABABU', 'pan' => 'AVVPA4236A',
    ],
    9 => [
        'id' => 'montest9', 'name' => 'Antonio Furtado', 'pan' => 'AAXPF1344F',
    ],
];

$user = 4;

$CLIENT_CODE= $clients[$user]['id']; //mandatory for all the cases
$CLIENT_HOLDING= 'SI'; //mandatory for all the cases
$CLIENT_TAXSTATUS= '01'; //mandatory for all the cases
$CLIENT_OCCUPATIONCODE= '01'; //mandatory for all the cases
$CLIENT_APPNAME1= $clients[$user]['name']; //mandatory for all the cases
$CLIENT_APPNAME2= ''; //non-mandatory. Mandatory if the holding is JO or AS
$CLIENT_APPNAME3= ''; //non-mandatory
$CLIENT_DOB= '10/12/1980'; //mandatory for all the cases
$CLIENT_GENDER= 'M'; //mandatory for all the cases
$CLIENT_FATHERHUSBAND= ''; //if tax status is 02 i.e. on behalf of minor varchar then mandatory or else non mandatory
$CLIENT_PAN= $clients[$user]['pan']; //non mandatory if the tax status is 02 i.e. on behalf of minor; else mandatory
$CLIENT_NOMINEE= '';
$CLIENT_NOMINEE_RELATION= ''; //mandatory if client niminee is given else non mandatory
$CLIENT_GUARDIANPAN= ''; //if tax status is 02 i.e. on behalf of minor then mandatory or else non mandatory
$CLIENT_TYPE= 'P'; //mandatory for all the cases | D = Demat ; P = Physical
$CLIENT_DEFAULTDP= ''; //mandatory if value is "D" in client type | values = CDSL/NSDL
$CLIENT_CDSLDPID= ''; //mandatory if value is "C" in client default DP
$CLIENT_CDSLCLTID= ''; //mandatory if value is "C" in client default DP
$CLIENT_NSDLDPID= ''; //mandatory if value is "N" in client default DP
$CLIENT_NSDLCLTID= ''; //mandatory if value is "N" in client default DP
$CLIENT_ACCTYPE_1= 'SB'; //Can we add the same account for everyone
$CLIENT_ACCNO_1= '0000015561234567';
$CLIENT_MICRNO_1= '403229002';
$CLIENT_CLIENT_NEFT_IFSCCODE_1= 'ICIC0000015';
$CLIENT_default_bank_flag_1= 'Y';
$CLIENT_ACCTYPE_2= '';
$CLIENT_ACCNO_2= '';
$CLIENT_MICRNO_2= '';
$CLIENT_CLIENT_NEFT_IFSCCODE_2= '';
$CLIENT_default_bank_flag_2= '';
$CLIENT_ACCTYPE_3= '';
$CLIENT_ACCNO_3= '';
$CLIENT_MICRNO_3= '';
$CLIENT_CLIENT_NEFT_IFSCCODE_3= '';
$CLIENT_default_bank_flag_3= '';
$CLIENT_ACCTYPE_4= '';
$CLIENT_ACCNO_4= '';
$CLIENT_MICRNO_4= '';
$CLIENT_CLIENT_NEFT_IFSCCODE_4= '';
$CLIENT_default_bank_flag_4= '';
$CLIENT_ACCTYPE_5= '';
$CLIENT_ACCNO_5= '';
$CLIENT_MICRNO_5= '';
$CLIENT_CLIENT_NEFT_IFSCCODE_5= '';
$CLIENT_default_bank_flag_5= '';
$CLIENT_CHEQUENAME_5= '';
$CLIENT_ADD1= 'Hno 23/I; Grace Church; Bata Showroom'; //mandatory
$CLIENT_ADD2= '';
$CLIENT_ADD3= '';
$CLIENT_CITY= 'Margao'; //mandatory
$CLIENT_STATE= 'GO'; //mandatory
$CLIENT_PINCODE= '403601'; //mandatory
$CLIENT_COUNTRY= 'India'; //mandatory
$CLIENT_RESIPHONE= '';
$CLIENT_RESIFAX= '';
$CLIENT_OFFICEPHONE= '';
$CLIENT_OFFICEFAX= '';
$CLIENT_EMAIL= 'antonio+'.$clients[$user]['id'].'$@ajency.in';//mandatory
$CLIENT_COMMMODE= 'E'; //mandatory | P/E/M
$CLIENT_DIVPAYMODE= '01'; //mandatory | 01/02/03/04/05
$CLIENT_PAN2= '';  //mandatory if client app name 2 is given
$CLIENT_PAN3= ''; //mandatory if client app name 3 is given
$MAPIN_NO= '';
$CM_FORADD1= '';//mandatory if tax code is 21 or 24
$CM_FORADD2= '';
$CM_FORADD3= '';
$CM_FORCITY= ''; //mandatory if tax code is 21 or 24
$CM_FORPINCODE= '';//mandatory if tax code is 21 or 24
$CM_FORSTATE= '';
$CM_FORCOUNTRY= '';//mandatory if tax code is 21 or 24
$CM_FORRESIPHONE= '';
$CM_FORRESIFAX= '';
$CM_FOROFFPHONE= '';
$CM_FOROFFFAX= '';
$CM_MOBILE= '9900190516'; //mandatory

$client_create_params = [
    'Flag' => '02',
    'UserId' => $login_params['UserId'],
    'Password' =>  $passKeyAdditional['data'],
    'param' => implode('|',$input),
];

print_r($star_mf_additional->amfg_starmf_manage_client($user_id,
    $encrypted_password['data'],
    $CLIENT_CODE,
    $CLIENT_HOLDING,
    $CLIENT_TAXSTATUS,
    $CLIENT_OCCUPATIONCODE,
    $CLIENT_APPNAME1,
    $CLIENT_APPNAME2,
    $CLIENT_APPNAME3,
    $CLIENT_DOB,
    $CLIENT_GENDER,
    $CLIENT_FATHERHUSBAND,
    $CLIENT_PAN,
    $CLIENT_NOMINEE,
    $CLIENT_NOMINEE_RELATION,
    $CLIENT_GUARDIANPAN,
    $CLIENT_TYPE,
    $CLIENT_DEFAULTDP,
    $CLIENT_CDSLDPID,
    $CLIENT_CDSLCLTID,
    $CLIENT_NSDLDPID,
    $CLIENT_NSDLCLTID,
    $CLIENT_ACCTYPE_1,
    $CLIENT_ACCNO_1,
    $CLIENT_MICRNO_1,
    $CLIENT_CLIENT_NEFT_IFSCCODE_1,
    $CLIENT_default_bank_flag_1,
    $CLIENT_ACCTYPE_2,
    $CLIENT_ACCNO_2,
    $CLIENT_MICRNO_2,
    $CLIENT_CLIENT_NEFT_IFSCCODE_2,
    $CLIENT_default_bank_flag_2,
    $CLIENT_ACCTYPE_3,
    $CLIENT_ACCNO_3,
    $CLIENT_MICRNO_3,
    $CLIENT_CLIENT_NEFT_IFSCCODE_3,
    $CLIENT_default_bank_flag_3,
    $CLIENT_ACCTYPE_4,
    $CLIENT_ACCNO_4,
    $CLIENT_MICRNO_4,
    $CLIENT_CLIENT_NEFT_IFSCCODE_4,
    $CLIENT_default_bank_flag_4,
    $CLIENT_ACCTYPE_5,
    $CLIENT_ACCNO_5,
    $CLIENT_MICRNO_5,
    $CLIENT_CLIENT_NEFT_IFSCCODE_5,
    $CLIENT_default_bank_flag_5,
    $CLIENT_CHEQUENAME_5,
    $CLIENT_ADD1,
    $CLIENT_ADD2,
    $CLIENT_ADD3,
    $CLIENT_CITY,
    $CLIENT_STATE,
    $CLIENT_PINCODE,
    $CLIENT_COUNTRY,
    $CLIENT_RESIPHONE,
    $CLIENT_RESIFAX,
    $CLIENT_OFFICEPHONE,
    $CLIENT_OFFICEFAX,
    $CLIENT_EMAIL,
    $CLIENT_COMMMODE,
    $CLIENT_DIVPAYMODE,
    $CLIENT_PAN2,
    $CLIENT_PAN3,
    $MAPIN_NO,
    $CM_FORADD1,
    $CM_FORADD2,
    $CM_FORADD3,
    $CM_FORCITY,
    $CM_FORPINCODE,
    $CM_FORSTATE,
    $CM_FORCOUNTRY,
    $CM_FORRESIPHONE,
    $CM_FORRESIFAX,
    $CM_FOROFFPHONE,
    $CM_FOROFFFAX,
    $CM_MOBILE,
    true));

$star_mf = new AMFG_BSE_Star_MF_Fund();
$encrypted_password_2 = $response = $star_mf->amfg_starmf_login($user_id,$password,$pass_key_string,true);

#http://www.kamfa.in/downloads-kyc-forms/
#https://www.bankbazaar.com/mutual-fund/types-of-mutual-funds.html

$TransCode =  'NEW';
$TransNo =  date('Ymd').rand(111111,999999);
$OrderId =  NULL;
$UserID =  $user_id;
$member_id =  $member_id;
$ClientCode =  $CLIENT_CODE;
$SchemeCd =  '1180C-DR';
$BuySell =  'P';
$BuySellType =  'FRESH';
$DPTxn =  'P';
$OrderVal =  '5009';
$Qty =  '';
$AllRedeem =  'N';
$FolioNo =  NULL;
$Remarks =  'remarks';
$KYCStatus =  'Y';
$RefNo =  NULL;
$SubBrCode =  'subBrCode';
$EUIN =  NULL;
$EUINVal =  'N';
$MinRedeem =  'Y';
$DPC =  'Y';
$IPAdd =  NULL;
$password =  $encrypted_password_2['data'];
$pass_key_string =  $pass_key_string;
$Parma1 =  '';
$Param2 =  '';
$Param3 =  '';

$star_mf->amfg_starmf_create_fund(

    $TransCode,
    $TransNo,
    $OrderId,
    $UserID,
    $member_id,
    $ClientCode,
    $SchemeCd,
    $BuySell,
    $BuySellType,
    $DPTxn,
    $OrderVal,
    $Qty,
    $AllRedeem,
    $FolioNo,
    $Remarks,
    $KYCStatus,
    $RefNo,
    $SubBrCode,
    $EUIN,
    $EUINVal,
    $MinRedeem,
    $DPC,
    $IPAdd,
    $password,
    $pass_key_string,
    $Parma1,
    $Param2,
    $Param3,
    true);

$Url = "http://mfgiftology.dev/wp-content/themes/mfgiftology/Ajency/bseStarMFAPI/test2.php";
print_r($star_mf_additional->amfg_starmf_generate_payment_link($user_id,$encrypted_password['data'],$member_id,$CLIENT_CODE,$Url));