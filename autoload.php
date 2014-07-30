<?php defined('APPPATH') or die('No direct script access.');

function __autoload($class)
{
    $class = str_replace('_', '/', $class);

    $paths = array(
        APPPATH.'classes/'.$class.'.php',
        LIBPATH.$class.'.php'
    );

    foreach($paths as $path)
    {
        if (file_exists($path)) {
            require $path;
            return TRUE;
        }
    }

    throw new Candy_Exception('The requested '.$path.' could not be found', 500);
}
