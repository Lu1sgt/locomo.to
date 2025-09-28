<?php

class Database_Initiator
{
    public static function Database_Initiate($database_type): MySQL_Database | SQLite_Database | null
    {
        switch($database_type)
        {
            case 'MySQL':
                require_once 'MySQL_Database.php';
                return new MySQL_Database();
            case 'SQLite':
                require_once 'SQLite_Database.php';
                return new SQLite_Database(Application::$working_directory . "/app/db/SQLite_Dev.sql");
            default:
                return null;
        }
    }
}