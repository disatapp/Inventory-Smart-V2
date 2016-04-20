<?php

class Dashboard extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->js = array('dashboard/js/pendingItem.js');
	}

	function index(){
		$this->view->render('dashboard/index');
	}

	// function details(){
	// 	$this->view->render('index/index');
	// }

	function get(){
		$rows = $this->model->fetch_pending();
		echo json_encode($rows);
	}

	function update(){
		$stack = json_decode($_POST['data'], TRUE);
		$receivingdate = $_POST['receivingdate'];

		if(isset($stack)){
			$storingdate = date('Y-m-d');
			//get posting string
			if(($string = $this->model->update_orderdetail($stack, $receivingdate, $storingdate)) !== true){
				echo "false";
			}

			//update part table
			if($this->model->update_parts( $stack, '+') !== true){
				echo 'false';
			}

			echo 'true';
		} else {
			echo 'false';
		}
	}
}