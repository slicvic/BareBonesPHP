<?php defined('APPPATH') or die('No direct script access.');
/**
 * Example controller.
 */
class Controller_Welcome extends Candy_Controller {    
   /**
    * Index Page for this controller.
    *
    * Maps to the following URLs
    *       http://example.com/index.php/welcome
    *       http://example.com/index.php/welcome/index
    *
    * Since this controller is set as the default controller in 
    * app/bootstrap.php, it's displayed at http://example.com/
    *
    * So any other public methods prefixed with "page_" will
    * map to /index.php/welcome/<method_name>
    */
    public function page_index()
    {      
        // Instantiating a model
        //$welcomeModel = Candy_Model::factory('Welcome');
        //$welcomeModel = new Model_Welcome;
    
        $view = Candy_View::factory('welcome/index');
        
        $layout = Candy_View::factory('layout');
        $layout->content = $view;
        
        $this->response->body($layout);
    }
}