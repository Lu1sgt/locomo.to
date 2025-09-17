<?php

class Home extends Controller 
{
    public function index($name = "") : void 
    {
        $placeholder = [
            'Content' => '',
            'Title' => 'This'
        ];
        //model
        $user = $this->model('User');

        // view
        $user->set_name($name);
        $layout = $this->get_layout("main");
        $placeholder['Content'] = $this->get_view("home/index",['name' => $user->get_name()]);
        $this->view($this->set_placeholders($placeholder, $layout));
    }
}