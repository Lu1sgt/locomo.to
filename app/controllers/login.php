<?php

class Login extends Controller
{
    /**
     * Summary of index
     * @return void
     */
    public function index()
    {
        if (isset($_SESSION["username"]) && !empty($_SESSION["username"]))
        {
            Application::redirect("/home");
        }
        
        require_once Application::$working_directory . "/app/models/User.php";
        $placeholder = [
             "Title" => "Locomo.to - Log in"
        ];
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sanitized_data = $this->sanitized_authenticate();
            if(!array_key_exists('ERROR', $sanitized_data))
            {
                $_SESSION['username'] = $sanitized_data['username'];
                Application::redirect('/');
            }
            
            $data = $sanitized_data;    
        }
        $layout = $this->get_layout("test");
        $placeholder['Content'] = $this->get_view("login/index.php", $data);
        $this->view($this->set_placeholders($placeholder, $layout));
    }

    /**
     * Only used with $_POST data
     * @return array<array|string>|array{password: string, username: string}
     */
    private function sanitized_authenticate() : array
    {   
        $data = [
            'username' => trim(strip_tags(htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'))),
            'password' => trim(strip_tags(htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8')))
        ];

        if (empty($data['username'])) {
            $data['ERROR']['username'] = 'USERNAME_ERROR';
        }
        if (empty($data['password'])) {
            $data['ERROR']['password'] = 'PASSWORD_ERROR';
        }
        if (!User::check_if_username_exist($data['username']))
        {
            $data['ERROR']['username'] = 'USERNAME_DOES_NOT_EXIST!';
        }
        else if (!User::password_authenticate($data['password'], $data['username']))
        {
            $data['ERROR']['password'] = 'WRONG PASSWORD!';
        }
        if (array_key_exists("ERROR", $data)) {
            $error = $data['ERROR'];
            $data = [];
            $data['ERROR'] = $error;
            return $data;
        }
        
        return $data;
    }
}