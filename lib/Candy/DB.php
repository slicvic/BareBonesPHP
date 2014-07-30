<?php defined('APPPATH') or die('No direct script access.');
/**
 * Database connection helper. This class provides connection instance management.
 * 
 * You may get a database instance using `Candy_DB::getConnection('name')` where
 * name is the connection name defined in config/database.php.
 * 
 * @package Candy
 * @author  Victor Lantigua
 */
abstract class Candy_DB {
    /**
     * @var PDO[] Database connection instances 
     */
    private static $connections = array();
    
    /**
     * Returns a PDO instance representing a connection to a database.
     * 
     *      $db = Candy_DB::getConnection('production');
     * 
     * @param   string  $name           Connection name
     * @return  PDO|NULL                PDO object or NULL
     * @throws  Candy_Exception
     * @see     config/database.php     To configure your database connection
     */
    public static function getConnection($name)
    {
        if (isset(self::$connections[$name]))
            return self::$connections[$name];

        $config = include APPPATH.'config/database.php';

        if ( ! isset($config['connections'][$name]))
        {
            throw new Candy_Exception('Database connection '.$name.' not defined in configuration');
        }

        $config = $config['connections'][$name];

        try 
        {
            self::$connections[$name] = new PDO("{$config['driver']}:host={$config['hostname']};dbname={$config['database']}", $config['username'], $config['password']);
        } 
        catch (PDOException $ex) 
        {
            throw new Candy_Exception($ex->getMessage(), $ex->getCode());        
        }

        return self::$connections[$name];
    }
}