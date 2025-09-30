<?php

class Home extends Controller 
{
    /**
     * Summary of index
     * @return void
     */
    public function index() : void 
    {
        if(!isset($_SESSION["username"]) && empty($_SESSION["username"])) 
        {
            Application::redirect("/login");
        }
        $placeholder = [
            'Content' => '',
            'Title' => 'Car'
        ];

        $data = [
            'username' => ''
        ];
        //model
        
        $data['username'] = $_SESSION['username'];
        // $user = $this->model('User');

        // view
        $layout = $this->get_layout("main");
        $placeholder['Content'] = $this->get_view("home/index.php", $data);
        $this->view($this->set_placeholders($placeholder, $layout));
    }    

    public function logout() : void 
    {
        $body = file_get_contents("php://input");

    if ($body === 'logout') {
        // Do your logout logic (e.g. session_destroy(), etc.)
        Application::session_destroy();
        // Return a response
        Application::redirect("/login");
        exit;
    } else {
        http_response_code(400);
        echo "Invalid request";
    }
    }

    public function landingpage() : void {
        $placeholder = [
            'pagetitle' => 'locomotive.com',
            'landingpage' => ''

        ];
 
        $data = [
            'landingpage' => '<h1>Welcome to Locomotive</h1><p>Your gateway to seamless travel experiences. 
            Explore our services and book your next journey with us today!</p>'
            ,'message' => 'supit si jepoy dizon'
        ];

        $layout = $this->get_layout("layout");
        $placeholder["landingpage"] = $this->get_view("home/landingpage.php", $data);
        $this->view($this->set_placeholders($placeholder, $layout));
    }
}