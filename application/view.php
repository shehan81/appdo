<?php

class View {
    
    protected $path;
    
    protected $data;
    
    protected function getViewPath(){
        return ROOT . '/views';
    }
    
    public function __construct($data = [], $route = "", $action = "") {
        $this->data = $data;
        $this->path = $this->getViewPath();
        
        if($route)
            $this->path .= '/' . $route;
        
        if($action)
            $this->path .= '/' . $action . '.phtml';
        
        if(!file_exists($this->path)){
            //throw new Exception('Invalid View file!!');
        }
    }
    
    public function render(){
        $data = $this->data;
        
        ob_start();
        @require ($this->path);
        $content = ob_get_clean();
        
        return $content;
    }
}

