<?php

class Register extends Controller 
{
    /**
     * Summary of index
     * @return void
     */
    public function index()
    {
        require_once Application::$working_directory . "/app/models/User.php";
        $placeholder = [
            "Title" => "Register"
        ];
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // sanitizes, validates, checks whether account already exists!
            $sanitized_data = $this->sanitized_validate();

            if (!array_key_exists('ERROR', $sanitized_data)) {
                // registers users after validation, and redirects to home.
                $user = new User($sanitized_data);
                $user->register();            
                Application::session_destroy();
                Application::redirect('/login');
            }
            
            $data = $sanitized_data;
        }
        // if method is GET, and if validation has failed.
        $layout = $this->get_layout("test");
        $placeholder['Content'] = $this->get_view("register/index.php", $data);
        $this->view($this->set_placeholders($placeholder, $layout));
    }

    /**
     * Only used with $_POST data
     * 
     * @return array<array|string>|array{email: string, password: string, username: string} Returns a 'User' object compatible associative array
     */
    private function sanitized_validate() : array
    {   
        $confirm_password = strip_tags(htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8'));
        $data = [
            'username' => trim(strip_tags(htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'))),
            'email' => trim(strip_tags(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'))),
            'password' => trim(strip_tags(htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8')))
        ];

        if (empty($data['username'])) {
            $data['ERROR']['username'] = 'USERNAME_ERROR';
        }
        if (empty($data['password'])) {
            $data['ERROR']['password'] = 'PASSWORD_ERROR';
        }
        if (empty($data['email'])) {
            $data['ERROR']['email'] = 'EMAIL_ERROR';
        }
        if (User::check_if_username_exist($data['username']))
        {
            $data['ERROR']['username'] = 'USERNAME_EXISTS';
        }
        if ($confirm_password !== $data['password'])
        {
            $data['ERROR']['password'] = 'PASSWORDS DO NOT MATCH!';
        }
        if (array_key_exists("ERROR", $data)) {
            $error = $data['ERROR'];
            $data = [];
            $data['ERROR'] = $error;
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}