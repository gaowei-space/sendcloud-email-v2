<?php

namespace SendCloud;

/**
 * PSR-4 autoload
 *
 * @param string $class 带命名空间类名
 *
 * @return void
 */
function SC_autoload($class)
{
    $class = trim($class, '\\');
    $prefix = str_replace(
        'SendCloud',
        'src',
        substr($class, 0, strpos($class, '\\'))
    );
    $filename = str_replace(
        '\\',
        DIRECTORY_SEPARATOR,
        substr($class, strpos($class, '\\'))
    ) . '.php';
    $path = __DIR__ . DIRECTORY_SEPARATOR . $prefix . $filename;
    require "$path";

}

spl_autoload_register("\\SendCloud\\SC_autoload");
