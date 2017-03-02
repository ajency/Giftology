<?php


 function autoload_37f77b4400f27ba6c5b4b006df318ccb($class)
{
    $classes = array(
        'MFOrder' => __DIR__ .'/MFOrder.php',
        'getPassword' => __DIR__ .'/getPassword.php',
        'getPasswordResponse' => __DIR__ .'/getPasswordResponse.php',
        'orderEntryParam' => __DIR__ .'/orderEntryParam.php',
        'orderEntryParamResponse' => __DIR__ .'/orderEntryParamResponse.php',
        'spreadOrderEntryParam' => __DIR__ .'/spreadOrderEntryParam.php',
        'spreadOrderEntryParamResponse' => __DIR__ .'/spreadOrderEntryParamResponse.php',
        'switchOrderEntryParam' => __DIR__ .'/switchOrderEntryParam.php',
        'switchOrderEntryParamResponse' => __DIR__ .'/switchOrderEntryParamResponse.php',
        'sipOrderEntryParam' => __DIR__ .'/sipOrderEntryParam.php',
        'sipOrderEntryParamResponse' => __DIR__ .'/sipOrderEntryParamResponse.php',
        'xsipOrderEntryParam' => __DIR__ .'/xsipOrderEntryParam.php',
        'xsipOrderEntryParamResponse' => __DIR__ .'/xsipOrderEntryParamResponse.php',
        'Decrypt' => __DIR__ .'/Decrypt.php',
        'DecryptResponse' => __DIR__ .'/DecryptResponse.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_37f77b4400f27ba6c5b4b006df318ccb');

// Do nothing. The rest is just leftovers from the code generation.
{
}
