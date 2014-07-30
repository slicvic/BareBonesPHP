<?php
// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)).'/');
// The directory in which your application specific resources are located.
define('APPPATH', DOCROOT.'app/');

// Enable the auto-loader.
require_once(DOCROOT.'autoload.php');
//spl_autoload_register(array('Loader', 'autoload'));

// Bootstrap the application
require_once(APPPATH.'bootstrap.php');

// Parse the uri and execute the request
$uri = explode('/', ( ! empty($_GET['candy_uri'])) ? $_GET['candy_uri'] : DEFAULT_CONTROLLER);

$route = array(
    'controller' => $uri[0],
    'method' => ( ! empty($uri[1])) ? 'page_'.$uri[1] : 'page_index',
    'param' => isset($uri[2]) ? $uri[2] : NULL
);

try 
{
    $controller = 'Controller_'.strtolower(ucfirst($route['controller']));
    $controller = new $controller;
    
    // Throw page not found exception if method is not callable
    if ( ! is_callable(array($controller, $route['method'])) )
    {
        throw new Candy_Exception('The requested '.$route['method'].' could not be found in '.$route['controller'].' controller', 404);
    }
    
    $controller->{$route['method']}($route['param']);
    
    echo $controller
        ->getResponse();
} 
catch (Candy_Exception $ex) 
{
    $errorView = Candy_View::factory( 'error', array('code' => $ex->getCode()) );
    echo Candy_View::factory('layout')
            ->set('content', $errorView);
}