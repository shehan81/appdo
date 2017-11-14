<?php
class DefaultController extends BaseController {
    
    public function indexAction(){
        Helper::redirect('/login');
    }
}
