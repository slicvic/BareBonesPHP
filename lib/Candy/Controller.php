<?php defined('APPPATH') or die('No direct script access.');
/**
 * Controller base class. All controllers should extend this class.
 * 
 * @package Candy
 * @author  Victor Lantigua
 */
abstract class Candy_Controller {
    /**
     * @var Request
     */
    protected $request;
    
    /**
     * @var Response
     */
    protected $response;

    public function __construct()
    {
        $this->request = new Candy_Request;
        $this->response = new Candy_Response;
    }

    /**
     * Returns the page layout
     * @return View
     */
    public function getResponse()
    {
        return $this->response;
    }
}
