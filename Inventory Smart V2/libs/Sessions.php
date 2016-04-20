<?php

class Sessions {
    
    public static function init() {

        // $secure = SECURE;
        // $httponly = true;
        // if (ini_set('session.use_only_cookies', 1) === FALSE) {
        //     exit();
        // }
        // $cookieParams = session_get_cookie_params();
        // session_set_cookie_params($cookieParams["lifetime"],
        //     $cookieParams["path"], 
        //     $cookieParams["domain"], 
        //     $secure,
        //     $httponly);

        @session_start();
    }
    
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key) {
        if (isset($_SESSION[$key]))
        return $_SESSION[$key];
    }
    
    public static function destroy() {
        // //unset($_SESSION);
        // session_start();
         
        // $_SESSION = array();
        // $params = session_get_cookie_params();
        // // Delete the actual cookie. 
        // setcookie(session_name(),
        //         '', time() - 42000, 
        //         $params["path"], 
        //         $params["domain"], 
        //         $params["secure"], 
        //         $params["httponly"]);
        session_destroy();
        header('location: '.URL.'login');
        exit();

        // echo 'not logged in';
    }
}