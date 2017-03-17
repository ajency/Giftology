<?php
include 'class-amfg-bse-star-mf.php';
include 'class-amfg-bse-star-mf-fund.php';
include 'class-amfg-bse-star-mf-additional.php';


print "<pre>";

$UserId = '1248901';
$MemberId = '12489';
$Password = 'pass123';
$PassKey = 'abcdefghij';

$star_mf_additional = new AMFG_BSE_Star_MF_Additional();
$passKeyAdditional = $response = $star_mf_additional->amfg_starmf_login($UserId,$MemberId,$Password,$PassKey, true);
print_r($passKeyAdditional);

$ClientCode = 'montest9';
$Url = 'http://google.com'; // Back to Admin screen with fetching order status

$CLIENT_ACCNO_1= '0000015561234567';
$CLIENT_MICRNO_1= '403229002';
$CLIENT_CLIENT_NEFT_IFSCCODE_1= 'ICIC0000015';
$CLIENT_default_bank_flag_1= 'Y';

/*print_r($star_mf_additional->amfg_starmf_client_mandate_registration($UserId,$passKeyAdditional['data'],$MemberId,$ClientCode,50000,
    $CLIENT_CLIENT_NEFT_IFSCCODE_1 , $CLIENT_ACCNO_1 ));*/


print_r($star_mf_additional->amfg_starmf_generate_payment_link($UserId,$passKeyAdditional['data'],$MemberId,$ClientCode,$Url));
