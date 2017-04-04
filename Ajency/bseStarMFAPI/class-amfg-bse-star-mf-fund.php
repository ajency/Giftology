<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<?php
include 'lib/MFOrder/autoload.php';

class AMFG_BSE_Star_MF_Fund extends AMFG_BSE_Star_MF {

    const MF_ORDER_SVC = 'http://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc';
    const MF_UPLOAD_SERVICE_SVC = 'http://bsestarmfdemo.bseindia.com/MFUploadService/MFUploadService.svc/Basic';
    const CREATE_FUND_ACTION = 'http://bsestarmf.in/MFOrderEntry/orderEntryParam';
    const GET_PASSWORD_ACTION = 'http://bsestarmf.in/MFOrderEntry/getPassword';
    const GET_PASSWORD_ACTION_ADDITIONAL = 'http://bsestarmfdemo.bseindia.com/2016/01/IMFUploadService/getPassword';
    const MFAPI_ACTION = 'http://bsestarmfdemo.bseindia.com/2016/01/IMFUploadService/MFAPI';

    /**
     * @param array $parameters
     * @param bool $debug
     * Adding a Fund via the STAR MF API
     */
    function amfg_starmf_login ($user_id, $password, $pass_key, $debug = false) {

        try {

            $options = self::amfg_starmf_set_debug_option($debug);
            $service = new \BSEStarMF\MFOrder\MFOrder($options);

            $headers = self::amfg_starmf_set_wsa_headers(self::GET_PASSWORD_ACTION,self::MF_ORDER_SVC);
            $service->__setSoapHeaders($headers);

            $parameters = new \BSEStarMF\MFOrder\getPassword(
                $user_id,
                $password,
                $pass_key
            );
            $response = $service->getPassword($parameters);
            $status = self::amfg_starmf_response_formatter($response->getGetPasswordResult());
        } catch (Exception $e) {
            $status = self::amfg_starmf_exception_response_formatter($e);
        }
        return $status;
    }

    function amfg_starmf_create_fund ($TransCode, $TransNo, $OrderId,
                                      $UserID, $MemberId, $ClientCode,
                                      $SchemeCd, $BuySell, $BuySellType,
                                      $DPTxn, $OrderVal, $Qty,
                                      $AllRedeem, $FolioNo, $Remarks,
                                      $KYCStatus, $RefNo, $SubBrCode,
                                      $EUIN, $EUINVal, $MinRedeem,
                                      $DPC, $IPAdd, $Password,
                                      $PassKey, $Parma1, $Param2,
                                      $Param3, $debug = false) {
        try {

            $options = self::amfg_starmf_set_debug_option($debug);
            $service = new \BSEStarMF\MFOrder\MFOrder($options);

            $headers = self::amfg_starmf_set_wsa_headers(self::CREATE_FUND_ACTION,self::MF_ORDER_SVC);
            $service->__setSoapHeaders($headers);

            $parameters = new \BSEStarMF\MFOrder\orderEntryParam(
                $TransCode, $TransNo, $OrderId,
                $UserID, $MemberId, $ClientCode,
                $SchemeCd, $BuySell, $BuySellType,
                $DPTxn, $OrderVal, $Qty,
                $AllRedeem, $FolioNo, $Remarks,
                $KYCStatus, $RefNo, $SubBrCode,
                $EUIN, $EUINVal, $MinRedeem,
                $DPC, $IPAdd, $Password,
                $PassKey, $Parma1, $Param2,
                $Param3
            );
            $response = $service->orderEntryParam($parameters);

            print_r($response->getOrderEntryParamResult());

            $status = self::amfg_starmf_response_formatter($response->getOrderEntryParamResult());
        } catch (Exception $e) {
            $status = self::amfg_starmf_exception_response_formatter($e);
        }
        return $status;
    }

}