<?php


 function autoload_4aa36a6120b2170780fbda27f6d4a393($class)
{
    $classes = array(
        'BSEStarMF\MFOrder\MFOrder' => __DIR__ .'/MFOrder.php',
        'BSEStarMF\MFOrder\getPassword' => __DIR__ .'/getPassword.php',
        'BSEStarMF\MFOrder\getPasswordResponse' => __DIR__ .'/getPasswordResponse.php',
        'BSEStarMF\MFOrder\orderEntryParam' => __DIR__ .'/orderEntryParam.php',
        'BSEStarMF\MFOrder\orderEntryParamResponse' => __DIR__ .'/orderEntryParamResponse.php',
        'BSEStarMF\MFOrder\spreadOrderEntryParam' => __DIR__ .'/spreadOrderEntryParam.php',
        'BSEStarMF\MFOrder\spreadOrderEntryParamResponse' => __DIR__ .'/spreadOrderEntryParamResponse.php',
        'BSEStarMF\MFOrder\switchOrderEntryParam' => __DIR__ .'/switchOrderEntryParam.php',
        'BSEStarMF\MFOrder\switchOrderEntryParamResponse' => __DIR__ .'/switchOrderEntryParamResponse.php',
        'BSEStarMF\MFOrder\sipOrderEntryParam' => __DIR__ .'/sipOrderEntryParam.php',
        'BSEStarMF\MFOrder\sipOrderEntryParamResponse' => __DIR__ .'/sipOrderEntryParamResponse.php',
        'BSEStarMF\MFOrder\xsipOrderEntryParam' => __DIR__ .'/xsipOrderEntryParam.php',
        'BSEStarMF\MFOrder\xsipOrderEntryParamResponse' => __DIR__ .'/xsipOrderEntryParamResponse.php',
        'BSEStarMF\MFOrder\Decrypt' => __DIR__ .'/Decrypt.php',
        'BSEStarMF\MFOrder\DecryptResponse' => __DIR__ .'/DecryptResponse.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_4aa36a6120b2170780fbda27f6d4a393');

// Do nothing. The rest is just leftovers from the code generation.
{
}
