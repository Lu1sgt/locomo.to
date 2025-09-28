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
        //model
        
        // $user = $this->model('User');

        // view
        $layout = $this->get_layout("main");
        $placeholder['Content'] = $this->get_view("home/index.php");
        $this->view($this->set_placeholders($placeholder, $layout));
    }    

    public function logout() : void 
    {
        Application::session_destroy();
        Application::redirect("/login");
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