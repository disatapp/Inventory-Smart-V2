<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('login/js/login.js');
    }
    
    function index() {
        $this->view->render('login/index', true);
    }
    
    function submit() {
    	if(!empty($_POST['name']) || !empty($_POST['pwd'])){
			$user = $_POST['name'];
			$pwd = $_POST['pwd'];
			if($this->model->login($user, $pwd)){
				echo "true";
				
			} else {
				echo "false";
			}
		}else{
			echo "false";
		}
    }
}