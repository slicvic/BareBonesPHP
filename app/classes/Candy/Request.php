<?php
/**
 * A basic request wrapper/helper.
 * 
 * @package Candy
 * @author  Victor Lantigua
 */
class Candy_Request {
    /**
     * HTTP Methods
     */
    const GET       = 'GET';
    const POST      = 'POST';
    const PUT       = 'PUT';
    const DELETE    = 'DELETE';
    const HEAD      = 'HEAD';
    const OPTIONS   = 'OPTIONS';
    const TRACE     = 'TRACE';
    const CONNECT   = 'CONNECT';

    /**
     * @var boolean     Whether this request is ajax
     */
    public $isAjax;
    
    /**
     * @var string      The HTTP method
     */
    public $method;

    public function __construct() 
    {
        $this->isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        $this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : NULL;
    }
    
    /**
     * Returns HTTP POST parameters. 
     * 
     * @param string $key
     * @return array|string
     */
    public function post($key = NULL) 
    {
        if ($key === NULL)
            return $_POST;
        return array_key_exists($key, $_POST) ? $_POST[$key] : NULL;
    }
    
    /**
     * Returns HTTP query string.
     * 
     * @param type $key
     * @return array|string
     */
    public function query($key = NULL)
    {
        if ($key === NULL)
            return $_GET;
        return array_key_exists($key, $_GET) ? $_GET[$key] : NULL;
    }
}
