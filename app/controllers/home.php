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
            'Title' => 'This'
        ];
        //model
        
        // $user = $this->model('User');

        // view
        $layout = $this->get_layout("main");
        $placeholder['Content'] = $this->get_view("home/index.php");
        $this->view($this->set_placeholders($placeholder, $layout));
    }
    
}