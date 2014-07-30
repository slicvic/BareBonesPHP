<?php
/**
 * A basic response wrapper/helper.
 * 
 * @package Candy
 * @author  Victor Lantigua
 */
class Candy_Response {
    // HTTP status codes and messages
    public static $messages = array(
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',

        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',

        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    );
    
    /**
     * @var string      The response body
     */
    protected $body;
    
    /**
     * @var  string     The response protocol
     */
    protected $protocol = 'HTTP/1.1';
    
    /**
     * @var  string      The content type
     */
    protected $contentType = 'text/html';
    
    /**
     * @var  string      The response charset
     */
    protected $charset = 'utf-8';
    
    /**
     * @var  int        The response status code
     */
    protected $status = 200;
    
    /**
     * Sets or gets the response body
     * 
     * @param string $body
     * @return string|Candy_Response
     */
    public function body($body = NULL)
    {
        if ($body === NULL)
            return $this->body;
        $this->body = (string)$body;
        return $this;
    }
    
    /**
     * Sets or gets the content type
     * 
     * @param string $type
     * @return string|Candy_Response
     */
    public function contentType($type = NULL)
    {
        if ($type === NULL)
            return $this->contentType;
        $this->contentType = (string)$type;
        return $this;
    }

    /**
     * Sets or gets the status code
     * 
     * @param int $status
     * @return int|Candy_Response
     */
    public function status($status = NULL)
    {
        if ($status === NULL)
            return $this->status;
        $this->status = (int)$status;
        return $this;
    }
    
    /**
     * Renders the response to a string.
     * 
     * @return string
     */
    public function render()
    {
        header($this->protocol.' '.$this->status.' '.Candy_Response::$messages[$this->status]);
        header('content-type: '.$this->contentType.'; charset='.$this->charset);

        $output = $this->body;

        return $output;
    }

    /**
     * Magic method, returns the output of [Candy_View::render].
     */
    public function __toString() 
    {
        return $this->render();
    }
}
