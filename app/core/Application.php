<?php

class Application 
{
    private string $controller = 'home';
    private string $method = 'index';
    private array $params = [];

    public function __construct() 
    {
        // Cleans and parses the URL
        $url = this->parse_url();
        if ($this->get_controller($url[0])) 
        {
            unset($url[0]);
        }

        require_once "../app/controllers/{$url[0]}.php";
        
        // Instantiates the controller
        $this->controller = new $this->controller;

        if ($this->get_method($url[1]))
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