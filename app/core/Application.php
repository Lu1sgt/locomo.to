<?php

class Application 
{
    private $controller = '';
    private string $method = 'index';
    private array $params = [];
    public static $working_directory;

    /**
     * $db is a singleton. This is to prevent
     * ghost database objects that might lead to errors.
     * @var Database_Interface
     */
    public static Database_Interface $db;

    public function __construct($directory) 
    {
        self::$working_directory = $directory;
        self::$db = Database_Initiator::Database_Initiate(DB_TYPE);

        // Cleans and parses the URL
        $url = $this->parse_url();
        
        if ($this->get_controller($url[0])) 
        {
            unset($url[0]);
        }
        else {

            /**
             * TODO: Create a better 404 echo; 
             */
            self::not_found();
        }

        require_once self::$working_directory . "/app/controllers/{$this->controller}.php";
        
        // Instantiates the controller
        $this->controller = new $this->controller;

        if (isset($url[1]))
        {
            if (!$this->get_method($url[1]))
            {
                self::not_found();
            }
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        if (self::parameter_count($this->controller, $this->method) != count($this->params))
        {
            self::not_found();
        }
        
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
        if($controller == "" || $controller == "/")
        {
            $this->controller = 'home';
            return true;
        }
        else if(file_exists(self::$working_directory . "/app/controllers/$controller.php"))
        {

            $this->controller = $controller;
            return true;
        }
        return false;
    }
    private function get_method(string $method) 
    {
        if(is_callable([$this->controller, $method]))
        {
            $this->method = $method;
            return true;
        }
        return false;
    }

    public static function session_destroy()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public static function not_found()
    {
        $controller = new Controller();
        $view = $controller->get_view("not_found/index.html");
        $controller->view( $view);
        http_response_code(404);
        exit;
    }

    public static function redirect(string $url)
    {
        header("Location: $url");
        exit;
    }

    public static function parameter_count(object $object, string $method)
    {
        $reflection = new ReflectionClass($object);
        $method = $reflection->getMethod($method);
        return $method->getNumberOfParameters();
    }
}