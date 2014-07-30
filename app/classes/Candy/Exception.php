<?php defined('APPPATH') or die('No direct script access.');
/**
 * Candy exception class. This class logs exceptions.
 * 
 * @package Candy
 * @author  Victor Lantigua
 */
class Candy_Exception extends Exception {
    /**
     * @var string  Log filename
     */
    protected $log = 'logs/errors.php';
    
    /**
     * Constructor
     * 
     * @param type      $message     Error message
     * @param long      $code        The exception code
     * @param Exception $previous    Previous exception
     */
    public function __construct($message = NULL, $code = 0, Exception $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
        
        $this->logException();
    }
    
    /**
     * Writes the exception to the log file.
     */
    protected function logException()
    {
        $message = sprintf("[%s] %s Candy_Exception: %s\n", date('d-M-Y H:i:s'), $this->code, $this->message);
        
        file_put_contents(APPPATH.$this->log, $message, FILE_APPEND | LOCK_EX);
    }
}