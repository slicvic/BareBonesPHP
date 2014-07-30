<?php defined('APPPATH') or die('No direct script access.');
/**
 * An object wrapper for HTML pages with embedded PHP, called "views".
 * Variables can be assigned with the view object and referenced locally within
 * the view.
 * 
 * @package Candy
 * @author  Victor Lantigua
 */
class Candy_View {
   /**
    * Returns a new Candy_View object.
    *
    *       // Loads views/members/home.php
    *       $view = Candy_View::factory('members/home');
    *
    * @param   string  $file   View filename
    * @param   array   $data   Array of values
    * @return  Candy_View
    */
    public static function factory($file, array $data = NULL)
    {
        return new Candy_View($file, $data);
    }
    
    /**
     * @var string View filename 
     */
    private $file = NULL;
    
    /**
     * @var array Array of local variables 
     */
    private $data = array();
    
   /**
    * Sets the initial view filename and local data. Views should almost
    * always only be created using [Candy_View::factory].
    *
    *       $view = new Candy_View($file);
    *
    * @param   string  $file   View filename
    * @param   array   $data   Array of values
    * @return  void
    */
    public function __construct($file, array $data = NULL) 
    {
        // Load view file
        $file = APPPATH.'views/'.$file.'.php';

        if (file_exists($file) === FALSE)
        {
            throw new Candy_Exception('The requested view '.$file.' could not be found');
        }

        $this->file = $file;

        // Set view data
        if ($data !== NULL)
        {
            $this->data = $data;
        }
    }
    
   /**
    * Renders the view object to a string. Local data are merged
    * and extracted to create local variables within the view file.
    *
    *       $output = $view->render();
    *
    * @param   string  $file   View filename
    * @return  string
    * @throws  Candy_Exception
    */
    public function render()
    {
        // Import the view variables to local namespace
        extract($this->data, EXTR_SKIP);

        // Capture the view output
        ob_start();

        try
        {
            // Load the view within the current scope
            include $this->file;
        }
        catch (Exception $ex)
        {
            // Delete the output buffer
            ob_end_clean();

            // Re-throw the exception
            throw new Candy_Exception($ex->getMessage(), $this->getCode());        
        }

        // Get the captured output and close the buffer
        return ob_get_clean();
    }

   /**
    * Assigns a variable by name. Assigned values will be available as a
    * variable within the view file:
    *
    *       // This value can be accessed as $foo within the view
    *       $view->set('foo', 'my value');
    *
    * You can also use an array to set several values at once:
    *
    *       // Create the values $food and $beverage in the view
    *       $view->set(array('food' => 'bread', 'beverage' => 'water'));
    *
    * @param   string  $key    Variable name or an array of variables
    * @param   mixed   $value  Value
    * @return  $this
    */
    public function set($key, $value = NULL)
    {
        if (is_array($key))
        {
            foreach($key as $name => $value)
            {
                $this->data[$name] = $value;
            }
        }
        else
        {
            $this->data[$key] = $value;
        }
        
        return $this;
    }
    
    /**
     * Magic method, returns the output of [Candy_View::render].
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
    
   /**
    * Magic method, calls [Candy_View::set] with the same parameters.
    *
    *       $view->foo = 'something';
    *
    * @param   string  $key    Variable name
    * @param   mixed   $value  Value
    * @return  void
    */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }
}