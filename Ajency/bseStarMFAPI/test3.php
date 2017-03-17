<?php
include 'class-amfg-bse-star-mf.php';
include 'class-amfg-bse-star-mf-fund.php';
include 'class-amfg-bse-star-mf-additional.php';


$user_id = '1248901';
$member_id = '12489';
$password = 'pass123';
$pass_key = 'abcdefghij';

$star_mf_additional = new AMFG_BSE_Star_MF_Additional();
$encrypted_password = $response = $star_mf_additional->amfg_starmf_login($user_id,$member_id,$password,$pass_key,true);
print_r($encrypted_password);

$cleint_code = $_GET['client_code'];
$order_no = $_GET['order_no'];

print_r($star_mf_additional->amfg_starmf_order_status($cleint_code,$user_id,$encrypted_password['data'],$order_no));
