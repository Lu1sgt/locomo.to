<?php 

class Authenticator
{
    private $database;
    
    /**
     * Database Implementation Needed!!!
     */

    /**
     * Summary of authenticate_by_username
     * @param string $username
     * @param string $password
     * @return bool
     */
    public static function authenticate_by_username(string $username, string $password) : bool 
    {
        return User::check_if_username_exist($username) &&
        password_verify($password, Application::$db->search('Accounts', ['username' => $username]));
    }
}