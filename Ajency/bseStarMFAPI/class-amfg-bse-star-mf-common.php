<?php

class AMFG_BSE_Star_MF_Common {

    static function amfg_starmf_set_debug_option ($debug) {
        $options = [];
        if($debug) {
            $options = [
                "trace"=>1,
                "exceptions"=>1
            ];
        }
        return $options;
    }

    static function amfg_starmf_set_wsa_headers ($action, $svc) {

        $headers = [];

        $headers[] = new SoapHeader('http://www.w3.org/2005/08/addressing',
            'Action',
            $action);

        $headers[] = new SoapHeader('http://www.w3.org/2005/08/addressing',
            'To',
            $svc);

        return $headers;
    }

    static function amfg_starmf_exception_response_formatter(Exception $e, $log = false) {

        if($log) {
            //Do log $e
        }

        return [
            'success' => false,
            'message' => 'Internal Server Error',
            'data' => $e->getMessage(),
        ];
    }

    static function amfg_starmf_response_formatter($result, $message, $data) {

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