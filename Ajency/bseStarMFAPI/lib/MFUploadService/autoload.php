<?php


 function autoload_889b5eabc9f805196daa0564021f3c5a($class)
{
    $classes = array(
        'BSEStarMF\MFUploadService\MFUploadService' => __DIR__ .'/MFUploadService.php',
        'BSEStarMF\MFUploadService\getPassword' => __DIR__ .'/getPassword.php',
        'BSEStarMF\MFUploadService\getPasswordResponse' => __DIR__ .'/getPasswordResponse.php',
        'BSEStarMF\MFUploadService\MFAPI' => __DIR__ .'/MFAPI.php',
        'BSEStarMF\MFUploadService\MFAPIResponse' => __DIR__ .'/MFAPIResponse.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_889b5eabc9f805196daa0564021f3c5a');

// Do nothing. The rest is just leftovers from the code generation.
{
}
