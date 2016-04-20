<?php
class Auth
{
    
    public static function handlelogin()
    {
        @session_start();
        if (self::checksession() == false) {
            Sessions::destroy();
        }
    }
 
    public static function checksession(){
        if (empty($_SESSION['USERNAME'])){
            return false;
        }
        if (empty($_SESSION['USERID'])){
            return false;
        }

        $timeout_duration = 1800;

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration)) {
            return false;   
        }

        $_SESSION['LAST_ACTIVITY'] = time();

        if (!isset($_SESSION['SESS_ID'])) {
            $_SESSION['SESS_ID'] = time();
        } else if (time() - $_SESSION['SESS_ID'] > $timeout_duration) {
            session_regenerate_id(true); 
            $_SESSION['SESS_ID'] = time();  
        }
        return true;
    }



}