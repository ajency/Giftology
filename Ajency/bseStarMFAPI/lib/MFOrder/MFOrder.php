<?php

class MFOrder extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'getPassword' => '\\getPassword',
      'getPasswordResponse' => '\\getPasswordResponse',
      'orderEntryParam' => '\\orderEntryParam',
      'orderEntryParamResponse' => '\\orderEntryParamResponse',
      'spreadOrderEntryParam' => '\\spreadOrderEntryParam',
      'spreadOrderEntryParamResponse' => '\\spreadOrderEntryParamResponse',
      'switchOrderEntryParam' => '\\switchOrderEntryParam',
      'switchOrderEntryParamResponse' => '\\switchOrderEntryParamResponse',
      'sipOrderEntryParam' => '\\sipOrderEntryParam',
      'sipOrderEntryParamResponse' => '\\sipOrderEntryParamResponse',
      'xsipOrderEntryParam' => '\\xsipOrderEntryParam',
      'xsipOrderEntryParamResponse' => '\\xsipOrderEntryParamResponse',
      'Decrypt' => '\\Decrypt',
      'DecryptResponse' => '\\DecryptResponse',
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
        $wsdl = 'http://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc?singleWsdl';
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
     * @param orderEntryParam $parameters
     * @return orderEntryParamResponse
     */
    public function orderEntryParam(orderEntryParam $parameters)
    {
      return $this->__soapCall('orderEntryParam', array($parameters));
    }

    /**
     * @param spreadOrderEntryParam $parameters
     * @return spreadOrderEntryParamResponse
     */
    public function spreadOrderEntryParam(spreadOrderEntryParam $parameters)
    {
      return $this->__soapCall('spreadOrderEntryParam', array($parameters));
    }

    /**
     * @param switchOrderEntryParam $parameters
     * @return switchOrderEntryParamResponse
     */
    public function switchOrderEntryParam(switchOrderEntryParam $parameters)
    {
      return $this->__soapCall('switchOrderEntryParam', array($parameters));
    }

    /**
     * @param sipOrderEntryParam $parameters
     * @return sipOrderEntryParamResponse
     */
    public function sipOrderEntryParam(sipOrderEntryParam $parameters)
    {
      return $this->__soapCall('sipOrderEntryParam', array($parameters));
    }

    /**
     * @param xsipOrderEntryParam $parameters
     * @return xsipOrderEntryParamResponse
     */
    public function xsipOrderEntryParam(xsipOrderEntryParam $parameters)
    {
      return $this->__soapCall('xsipOrderEntryParam', array($parameters));
    }

    /**
     * @param Decrypt $parameters
     * @return DecryptResponse
     */
    public function Decrypt(Decrypt $parameters)
    {
      return $this->__soapCall('Decrypt', array($parameters));
    }

}
