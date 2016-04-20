<?php

class Signup extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('signup/js/signup.js');
    }
    
    function index() {
        $this->view->render('signup/index');
    }

    function submit(){
		if(isset($_POST['name'], $_POST['pwd'])){
		    $name = $_POST['name'];
		    $pwd = $_POST['pwd'];
		    unset($_POST['pwd']);
		    if($this->model->signup($name,$pwd)){
		    	echo "true";
			} else {
				echo "false";
			}

		} else {
		    echo "false";
		}
	}

	function success(){
		$this->view->render('signup/success');
	}

}