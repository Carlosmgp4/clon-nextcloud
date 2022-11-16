<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaa1f6c05229bd2bd53a2ff14bcc274f0
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'EasyTOTP\\' => 9,
        ),
        'B' => 
        array (
            'Base32\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'EasyTOTP\\' => 
        array (
            0 => __DIR__ . '/..' . '/rullzer/easytotp/src',
        ),
        'Base32\\' => 
        array (
            0 => __DIR__ . '/..' . '/christian-riesen/base32/src',
        ),
    );

    public static $classMap = array (
        'Base32\\Base32' => __DIR__ . '/..' . '/christian-riesen/base32/src/Base32.php',
        'Base32\\Base32Hex' => __DIR__ . '/..' . '/christian-riesen/base32/src/Base32Hex.php',
        'EasyTOTP\\Factory' => __DIR__ . '/..' . '/rullzer/easytotp/src/Factory.php',
        'EasyTOTP\\TOTP' => __DIR__ . '/..' . '/rullzer/easytotp/src/TOTP.php',
        'EasyTOTP\\TOTPInterface' => __DIR__ . '/..' . '/rullzer/easytotp/src/TOTPInterface.php',
        'EasyTOTP\\TOTPInvalidResult' => __DIR__ . '/..' . '/rullzer/easytotp/src/TOTPInvalidResult.php',
        'EasyTOTP\\TOTPInvalidResultInterface' => __DIR__ . '/..' . '/rullzer/easytotp/src/TOTPInvalidResultInterface.php',
        'EasyTOTP\\TOTPResultInterface' => __DIR__ . '/..' . '/rullzer/easytotp/src/TOTPResultInterface.php',
        'EasyTOTP\\TOTPValidResult' => __DIR__ . '/..' . '/rullzer/easytotp/src/TOTPValidResult.php',
        'EasyTOTP\\TOTPValidResultInterface' => __DIR__ . '/..' . '/rullzer/easytotp/src/TOTPValidResultInterface.php',
        'EasyTOTP\\TimeService' => __DIR__ . '/..' . '/rullzer/easytotp/src/TimeService.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaa1f6c05229bd2bd53a2ff14bcc274f0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaa1f6c05229bd2bd53a2ff14bcc274f0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaa1f6c05229bd2bd53a2ff14bcc274f0::$classMap;

        }, null, ClassLoader::class);
    }
}