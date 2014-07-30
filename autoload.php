<?php

function __autoload($class)
{
    $class = str_replace('_', '/', $class);

    // Check in application folder
    $path = APPPATH.'classes/'.$class.'.php';

    if (file_exists($path) === FALSE)
    {
        throw new Candy_Exception('The requested '.$path.' could not be found', 500);
    }

    require $path;
}
