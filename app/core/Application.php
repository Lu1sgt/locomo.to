<?php

class Application 
{
    private $controller = 'home';
    private string $method = 'index';
    private array $params = [];

    /**
     * Not used yet. 
     * @var  
     */
    private $working_directory;

    /**
     * $db is a singleton. This is to prevent
     * ghost database objects that might lead to errors.
     * @var Database_Interface
     */
    public static Database_Interface $db;

    public function __construct($directory) 
    {
        self::$db = Database_Initiator::Database_Initiate(DB_TYPE);

        $this->working_directory = $directory;
        // Cleans and parses the URL
        $url = $this->parse_url();
        if ($this->get_controller($url[0])) 
        {
            unset($url[0]);
        }

        require_once "../app/controllers/{$this->controller}.php";
        
        // Instantiates the controller
        $this->controller = new $this->controller;

        if (isset($url[1]) && $this->get_method($url[1]))
        {
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];
        
        // Executes URL Request
        $this->controller->{$this->method}(...$this->params);
    }
    private function parse_url() 
    {
        if(!isset($_GET['url']))
        {
            return [];
        }
        // makes array
        return $request = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
    private function get_controller(string $controller): bool 
    {
        if(file_exists("../app/controllers/$controller.php"))
        {

            $this->controller = $controller;
            return true;
        }
        return false;
    }
    private function get_method(string $method) 
    {
        if(method_exists($this->controller, $method))
        {
            $this->method = $method;
            return true;
        }
        return false;
    }
}