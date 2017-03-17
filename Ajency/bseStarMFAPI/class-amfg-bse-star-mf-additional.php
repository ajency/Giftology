<?php
include 'lib/MFUploadService/autoload.php';

class AMFG_BSE_Star_MF_Additional extends AMFG_BSE_Star_MF {

    const MF_ORDER_SVC = 'http://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc';
    const MF_UPLOAD_SERVICE_SVC = 'http://bsestarmfdemo.bseindia.com/MFUploadService/MFUploadService.svc/Basic';
    const CREATE_FUND_ACTION = 'http://bsestarmf.in/MFOrderEntry/orderEntryParam';
    const GET_PASSWORD_ACTION = 'http://bsestarmf.in/MFOrderEntry/getPassword';
    const GET_PASSWORD_ACTION_ADDITIONAL = 'http://bsestarmfdemo.bseindia.com/2016/01/IMFUploadService/getPassword';
    const MFAPI_ACTION = 'http://bsestarmfdemo.bseindia.com/2016/01/IMFUploadService/MFAPI';

    function amfg_starmf_login ($user_id, $member_id, $password, $pass_key, $debug = false) {

        try {

            $options = self::amfg_starmf_set_debug_option($debug);

            $service = new \BSEStarMF\MFUploadService\MFUploadService($options);

            $headers = self::amfg_starmf_set_wsa_headers(
                self::GET_PASSWORD_ACTION_ADDITIONAL,
                self::MF_UPLOAD_SERVICE_SVC);
            $service->__setSoapHeaders($headers);
            $parameters = new \BSEStarMF\MFUploadService\getPassword(
                $user_id,
                $member_id,
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

    /**
     * @param MFAPI $parameters
     * @param bool $debug
     *
     * Adding and updating a client to the STAR MF platform via SOAP API
     */
    function amfg_starmf_manage_client ($user_id,$password,
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
                                        $debug = false) {

        $flag = '02';
        $params = $CLIENT_CODE
            .'|'.$CLIENT_HOLDING
            .'|'.$CLIENT_TAXSTATUS
            .'|'.$CLIENT_OCCUPATIONCODE
            .'|'.$CLIENT_APPNAME1
            .'|'.$CLIENT_APPNAME2
            .'|'.$CLIENT_APPNAME3
            .'|'.$CLIENT_DOB
            .'|'.$CLIENT_GENDER
            .'|'.$CLIENT_FATHERHUSBAND
            .'|'.$CLIENT_PAN
            .'|'.$CLIENT_NOMINEE
            .'|'.$CLIENT_NOMINEE_RELATION
            .'|'.$CLIENT_GUARDIANPAN
            .'|'.$CLIENT_TYPE
            .'|'.$CLIENT_DEFAULTDP
            .'|'.$CLIENT_CDSLDPID
            .'|'.$CLIENT_CDSLCLTID
            .'|'.$CLIENT_NSDLDPID
            .'|'.$CLIENT_NSDLCLTID
            .'|'.$CLIENT_ACCTYPE_1
            .'|'.$CLIENT_ACCNO_1
            .'|'.$CLIENT_MICRNO_1
            .'|'.$CLIENT_CLIENT_NEFT_IFSCCODE_1
            .'|'.$CLIENT_default_bank_flag_1
            .'|'.$CLIENT_ACCTYPE_2
            .'|'.$CLIENT_ACCNO_2
            .'|'.$CLIENT_MICRNO_2
            .'|'.$CLIENT_CLIENT_NEFT_IFSCCODE_2
            .'|'.$CLIENT_default_bank_flag_2
            .'|'.$CLIENT_ACCTYPE_3
            .'|'.$CLIENT_ACCNO_3
            .'|'.$CLIENT_MICRNO_3
            .'|'.$CLIENT_CLIENT_NEFT_IFSCCODE_3
            .'|'.$CLIENT_default_bank_flag_3
            .'|'.$CLIENT_ACCTYPE_4
            .'|'.$CLIENT_ACCNO_4
            .'|'.$CLIENT_MICRNO_4
            .'|'.$CLIENT_CLIENT_NEFT_IFSCCODE_4
            .'|'.$CLIENT_default_bank_flag_4
            .'|'.$CLIENT_ACCTYPE_5
            .'|'.$CLIENT_ACCNO_5
            .'|'.$CLIENT_MICRNO_5
            .'|'.$CLIENT_CLIENT_NEFT_IFSCCODE_5
            .'|'.$CLIENT_default_bank_flag_5
            .'|'.$CLIENT_CHEQUENAME_5
            .'|'.$CLIENT_ADD1
            .'|'.$CLIENT_ADD2
            .'|'.$CLIENT_ADD3
            .'|'.$CLIENT_CITY
            .'|'.$CLIENT_STATE
            .'|'.$CLIENT_PINCODE
            .'|'.$CLIENT_COUNTRY
            .'|'.$CLIENT_RESIPHONE
            .'|'.$CLIENT_RESIFAX
            .'|'.$CLIENT_OFFICEPHONE
            .'|'.$CLIENT_OFFICEFAX
            .'|'.$CLIENT_EMAIL
            .'|'.$CLIENT_COMMMODE
            .'|'.$CLIENT_DIVPAYMODE
            .'|'.$CLIENT_PAN2
            .'|'.$CLIENT_PAN3
            .'|'.$MAPIN_NO
            .'|'.$CM_FORADD1
            .'|'.$CM_FORADD2
            .'|'.$CM_FORADD3
            .'|'.$CM_FORCITY
            .'|'.$CM_FORPINCODE
            .'|'.$CM_FORSTATE
            .'|'.$CM_FORCOUNTRY
            .'|'.$CM_FORRESIPHONE
            .'|'.$CM_FORRESIFAX
            .'|'.$CM_FOROFFPHONE
            .'|'.$CM_FOROFFFAX
            .'|'.$CM_MOBILE;

        return $this->amfg_starmf_additional ($flag, $user_id,$password, $params, $debug);

    }

    function amfg_starmf_order_status ($client_code, $user_id, $password, $order_no, $segment = 'BSEMF',$debug = false) {
        $flag = '11';
        $params = $client_code.'|'.$order_no.'|'.$segment;
        return $this->amfg_starmf_additional ($flag, $user_id,$password, $params, $debug);
    }

    function amfg_starmf_generate_payment_link ($user_id,$password,$member_code,$client_code,$redirect_url,$debug = false) {
        $flag = '03';
        $params = $member_code.'|'.$client_code.'|'.$redirect_url;
        return $this->amfg_starmf_additional ($flag, $user_id,$password, $params, $debug);
    }

    function amfg_starmf_client_mandate_registration ($user_id,$password,$member_code,$client_code,$amt, $ifsc_code, $bank_ac_no ,$debug = false) {
        $flag = '06';
        $params = $member_code.'|'.$client_code.'|'.$amt.'|'.$ifsc_code.'|'.$bank_ac_no.'|X';
        return $this->amfg_starmf_additional ($flag, $user_id,$password, $params, $debug);
    }

    function amfg_starmf_additional ($flag, $user_id,$password, $params, $debug = false) {

        try {

            $options = [];
            if($debug) {

                $options = [
                    "trace"=>1,
                    "exceptions"=>1
                ];
            }

            $service = new \BSEStarMF\MFUploadService\MFUploadService($options);

            $headers = $this->amfg_starmf_set_wsa_headers(self::MFAPI_ACTION,self::MF_UPLOAD_SERVICE_SVC);
            $service->__setSoapHeaders($headers);

            $parameters = new \BSEStarMF\MFUploadService\MFAPI($flag, $user_id,$password, $params);
            $response = $service->MFAPI($parameters);

            $status = self::amfg_starmf_response_formatter($response->getMFAPIResult());
        } catch (Exception $e) {
            $status = self::amfg_starmf_exception_response_formatter($e);
        }
        return $status;
    }

}