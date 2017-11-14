<?php
class Helper {
    
    public static function redirect($url){
        $url = $_SERVER['REQUEST_SCHEME'] .  "://" . $_SERVER['HTTP_HOST'] . $url;
        echo "<script>location.href='". $url ."'</script>";
        exit();
        //header("Location : $url");
    }
    
    
    public static function isLogged(){
        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
           return true; 
        }
        
        return false;
    }
    
    public static function isLoggedIn(){
        if(!isset($_SESSION['user_id'])){
            self::redirect('/login');
        }
    }
}