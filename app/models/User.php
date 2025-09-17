<?php

class User 
{
    private int $user_id;
    private string $name;
    private string $account_name;
    private $profile;

    public static function check_if_username_exist(string $username) 
    {
     ;
    }

    public function set_name(string $name): void
    {
        $this->name = $name;
    }

    public function get_name(): string
    {
        return $this->name;
    } 
}