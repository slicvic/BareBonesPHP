<?php defined('APPPATH') or die('No direct script access.');
/**
 * Model base class. All models should extend this class.
 * 
 * @package Candy
 * @author  Victor Lantigua
 */
abstract class Candy_Model {
   /**
    * Create a new model instance.
    * 
    *       $model = Candy_Model::factory('User');
    * 
    * @param string  $name   Model name
    * @return Candy_Model
    */
    public static function factory($name)
    {
        $class = 'Model_'.$name;
        return new $class;
    }
    
   /**
    * Returns a PDO instance representing a connection to a database,
    * calls [Candy_DB::getConnection] with the same parameter. 
    * 
    * @see Candy_DB::getConnection()
    */
    public static function db($name)
    {
        return Candy_DB::getConnection($name);
    }
}
