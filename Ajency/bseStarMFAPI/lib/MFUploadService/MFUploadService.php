<?php

class MFUploadService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'getPassword' => '\\getPassword',
      'getPasswordResponse' => '\\getPasswordResponse',
      'MFAPI' => '\\MFAPI',
      'MFAPIResponse' => '\\MFAPIResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'soap_version' => 2,
      'features' => 1,
    ), $options);
      if (!$wsdl) {
        $wsdl = 'http://bsestarmfdemo.bseindia.com/MFUploadService/MFUploadService.svc?singleWsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * @param getPassword $parameters
     * @return getPasswordResponse
     */
    public function getPassword(getPassword $parameters)
    {
      return $this->__soapCall('getPassword', array($parameters));
    }

    /**
     * @param MFAPI $parameters
     * @return MFAPIResponse
     */
    public function MFAPI(MFAPI $parameters)
    {
      return $this->__soapCall('MFAPI', array($parameters));
    }

}
