<?php

class Database_Initiator
{
    public static function Database_Initiate($database_type)
    {
        switch($database_type)
        {
            case 'MongoDB':
                return null;
            case 'MySQL':
                return new MySQL_Database();
        }
    }
}