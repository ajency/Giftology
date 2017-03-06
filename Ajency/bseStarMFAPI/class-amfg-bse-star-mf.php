<?php
include 'lib/MFOrder/autoload.php';
include 'lib/MFUploadService/autoload.php';
include 'class-amfg-bse-star-mf-config.php';
include 'class-amfg-bse-star-mf-common.php';

class AMFG_BSE_Star_MF {

    /**
     * @param array $parameters
     * @param bool $debug
     * Adding a Fund via the STAR MF API
     */


    function amfg_starmf_login ($parameters, $debug = false) {

        try {

            $parameters = new getPassword();

        } catch (Exception $e) {

        }
    }

    function amfg_starmf_create_fund ($parameters, $debug = false) {

        $status = [];
        $status['success'] = false;
        try {

            $options = AMFG_BSE_Star_MF_Common::amfg_starmf_set_debug_option($debug);
            $service = new MFOrder($options);

            $headers = AMFG_BSE_Star_MF_Common::amfg_starmf_set_wsa_headers(AMFG_BSE_Star_MF_Config::CREATE_FUND_ACTION,AMFG_BSE_Star_MF_Config::MF_ORDER_SVC);
            $service->__setSoapHeaders($headers);

            $parameters = new orderEntryParam(
                $parameters['TransCode'], $parameters['TransNo'], $parameters['OrderId'],
                $parameters['UserID'], $parameters['MemberId'], $parameters['ClientCode'],
                $parameters['SchemeCd'], $parameters['BuySell'], $parameters['BuySellType'],
                $parameters['DPTxn'], $parameters['OrderVal'], $parameters['Qty'],
                $parameters['AllRedeem'], $parameters['FolioNo'], $parameters['Remarks'],
                $parameters['KYCStatus'], $parameters['RefNo'], $parameters['SubBrCode'],
                $parameters['EUIN'], $parameters['EUINVal'], $parameters['MinRedeem'],
                $parameters['DPC'], $parameters['IPAdd'], $parameters['Password'],
                $parameters['PassKey'], $parameters['Parma1'], $parameters['Param2'],
                $parameters['Param3']
            );
            $response = $service->orderEntryParam($parameters);

            print "<pre>";
            print_r($service->__getLastResponseHeaders())."<br>"."<br>"."<br>";

            //These are functional messages, might have to take care of common return messages
            $status = AMFG_BSE_Star_MF_Common::amfg_starmf_response_formatter(false,'No Message Found', $response->getOrderEntryParamResult());

        } catch (Exception $e) {

            $status = AMFG_BSE_Star_MF_Common::amfg_starmf_exception_response_formatter($e);

        }
        return $status;

    }

    /**
     * @param MFAPI $parameters
     * @param bool $debug
     *
     * Adding a client to the STAR MF platform via SOAP API
     */

    function amfg_starmf_add_client ($parameters, $debug = false) {

        try {

            $options = [];
            if($debug) {

                $options = [
                    "trace"=>1,
                    "exceptions"=>1
                ];
            }

            $service = new MFUploadService($options);

            $headers = $this->amfg_starmf_get_wsa_headers(AMFG_BSE_Star_MF_Config::MFAPI_ACTION,AMFG_BSE_Star_MF_Config::MF_UPLOAD_SERVICE_SVC);
            $service->__setSoapHeaders($headers);

            $parameters = new MFAPI($parameters);
            $response = $service->MFAPI($parameters);

            echo $response->getMFAPIResult()."\n\n\n";


        } catch (Exception $e) {
            print_r($e)."\n\n\n";
        }

    }

    function _amfg_starmf_set_debug_option ($debug) {
        $options = [];
        if($debug) {
            $options = [
                "trace"=>1,
                "exceptions"=>1
            ];
        }
        return $options;
    }

    function _amfg_starmf_set_wsa_headers ($action, $svc) {

        $headers = [];

        $headers[] = new SoapHeader('http://www.w3.org/2005/08/addressing',
            'Action',
            $action);

        $headers[] = new SoapHeader('http://www.w3.org/2005/08/addressing',
            'To',
            $svc);

        return $headers;
    }

    function _amfg_starmf_response_formatter($result, $message, $data) {

        if(is_bool($result)) {
            return [
                'success' => $result,
                'message' => $message,
                'data' => $data,
            ];
        } else {
            return false;
        }

    }

}