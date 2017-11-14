<?php

class BaseController {
    
    protected $data;
    
    protected $params;
    
    public function __construct() {
        session_start();
        Helper::isLoggedIn();
    }
    
    public function getData(){
        return $this->data;
    }
    
    public function setParams($params){
       $this->params = $params;
       
       if(isset($_POST) && count($_POST) > 0){
           $this->params = $_POST;
       }
    }
    
    public function getParams(){
       return $this->params;
    }
    
}
