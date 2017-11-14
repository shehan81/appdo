<?php

class LoginController extends BaseController {

    //having this to avoid calling the paren't constructor
    public function __construct() {
        if (isset($_SESSION['user_id'])) {
            Helper::redirect('/home');
        }
    }

    public function indexAction() {
        
    }

    public function authAction() {
        $params = $this->getParams();

        $username = $params['username'];
        $password = $params['password'];

        //load user model
        $user = User::where([["username", $username]]);

        if (!empty($user)) {
            if (password_verify($password, $user->password)) {//logged in
                session_start();
                $_SESSION['user_id'] = $user->id;
                Helper::redirect('/home');
            }
        }

        $this->data['messages'] = array('error' => 'Invalid Login');
        Helper::redirect('/login');
    }

    public function endAction() {
        session_start();

        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }
        
        session_destroy();
        Helper::redirect('/login');
    }

}
