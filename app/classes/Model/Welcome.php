<?php defined('APPPATH') or die('No direct script access.');
/**
 * Example model.
 */
class Model_Welcome extends Candy_Model {
    public static function getWelcomeMessages()
    {
        try 
        {
            // Get the PDO connection object
            $db = self::db('default');
            
            // Perform query
            $query = $db->query("SELECT * FROM messages");
            
            // Fetch results
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        } 
        catch(PDOException $ex) 
        {
            return FALSE;
        }
    } 
}