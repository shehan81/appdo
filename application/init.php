<?php
require_once('boot.php');


class App {
    
    protected static $uri;
    
    protected static $controller = 'default';
    
    protected static $action = 'index';
    
    protected static $params = [];
    
    public function __construct($uri) {
        self::resolveURI($uri);
    }

    public static function run(){
        
        if(self::$controller){
            $class_name = ucfirst(self::$controller) . 'Controller';
            if(class_exists($class_name)){
                $class_obj = new $class_name();
                $class_obj->setParams(self::$params);
            }else{
                throw new Exception('Invalid Class!!!');
            }
            
            if(self::$action){
                $method_name = strtolower(self::$action) . 'Action';
                if(method_exists($class_obj, $method_name)){
                    $class_obj->$method_name();
                    
                    //render view
                    $view = new View($class_obj->getData(), self::$controller, self::$action);
                    $content = $view->render();
                    
                    //layout
                    $layout = new View(compact('content'), '', 'layout');
                    echo $layout->render();
                    
                }else{
                    throw new Exception('Invalid Method!!!');
                }
            }
            
        }
    }
    
    public static function resolveURI($uri = ""){
        $uri_params = explode("?", $uri);
        $uri_parts = explode("/", $uri_params[0]);
        
        if(!empty($uri_params[1])){
            parse_str($uri_params[1], self::$params);
        }
        
        if(!empty($uri_parts[1])){
            self::$controller = $uri_parts[1];
        }
        
        if(!empty($uri_parts[2])){
            self::$action = $uri_parts[2];
        }
    }
    
    public static function getParams(){
        return self::$params;
    }
}
