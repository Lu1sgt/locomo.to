<?php

class User 
{
    private int $account_id;
    private string $username;
    private $profile_image;
    private string $email;  
    private string $password;
    /**
     * Summary of __construct
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->account_id = 0;
        $this->username = "";
        $this->password = "";
        $this->email = "";

        if (isset($data["username"]) && 
        isset($data["email"]) && 
        isset($data["password"])) {

            $this->username = $data["username"];
            $this->email = $data["email"];
            $this->password = $data["password"];
        }

        if (isset($data["account_id"]))
        {
            $this->account_id = $data["account_id"];
        }
    }
    
    /**
     * Summary of from_account_id
     * @param int $account_id
     * @return bool|User
     */
    public function from_account_id(int $account_id)
    {
        $result = Application::$db->search('Users', ['account_id' => $account_id]);
        if ($result === false) 
            return false;
        $rows = $result->fetchArray(SQLITE3_ASSOC);
        if ($rows === false)
            return false;

        $user = [
            'username' => $rows['username'],
            'account_id' => $rows['account_id'],
            'email' => $rows['email'],
            'password' => ''
        ];

        return new self($user);
    }

    /**
     * Summary of from_username
     * @param string $username
     * @return bool|User
     */
    public function from_username(string $username)
    {
        $result = Application::$db->search('Users', ['username' => $username]);
        if ($result === false)
            return false;
        $rows = $result->fetchArray(SQLITE3_ASSOC);
        if ($rows === false)
            return false;

        $user = [
            'username' => $rows['username'],
            'account_id' => $rows['account_id'],
            'email' => $rows['email'],
            'password' => ''
        ];

        return new self($user);
    }

    /**
     * Summary of check_if_username_exist
     * @param string $username
     * @return bool
     */
    public static function check_if_username_exist(string $username) : bool
    {
        $result = Application::$db->search('Users', ['username'=> $username]);
        if ($result === false) 
            return false;
        $rows = $result->fetchArray(SQLITE3_ASSOC);
        return $rows !== false;
    }

    /**
     * Summary of password_authenticate
     * @param string $username
     * @param string $password
     * @return bool
     */
    public static function password_authenticate(string $username, string $password): bool
    {
        $result = Application::$db->search('Users', ['username'=> $username]);
        $row_count = 0;
        $row_gathered = [];

        while ($row = $result->fetchArray(SQLITE3_ASSOC))
        {
            $row_gathered = $row; 
            $row_count++;
        }
        if($row_count !== 1)
        {
            return false;
        }
        return password_verify($password, $row_gathered['password']);
    }

    /**
     * Summary of register
     * @return void
     * TODO: a boolean return for if the query is successful or not
     */
    public function register(): void
    {
        $user = $this->to_array();

        // I forgot to unset 'account_id', the default value is '0' and if it already
        // exists in the database, then it throws an error. 
        unset($user['account_id']);
        Application::$db->create("Users", $user);
    }

    /**
     * Summary of to_array
     * @return array{account_id: int, email: string, password: string, username: string}
     */
    public function to_array()
    {
        return [
            "username"=> $this->username,
            "email"=> $this->email,
            "password"=> $this->password,
            "account_id" => $this->account_id
        ];
    } 
}