<?php


 function autoload_0696792d89d8cc95ad67a2ac96c0a494($class)
{
    $classes = array(
        'MFUploadService' => __DIR__ .'/MFUploadService.php',
        'getPassword' => __DIR__ .'/getPassword.php',
        'getPasswordResponse' => __DIR__ .'/getPasswordResponse.php',
        'MFAPI' => __DIR__ .'/MFAPI.php',
        'MFAPIResponse' => __DIR__ .'/MFAPIResponse.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_0696792d89d8cc95ad67a2ac96c0a494');

// Do nothing. The rest is just leftovers from the code generation.
{
}
