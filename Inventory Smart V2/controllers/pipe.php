<?php

class Pipe extends Controller{

	function __construct(){
		parent::__construct();
		$this->view->js = array('pipe/js/orderPipe.js', 'pipe/js/viewRequest.js');
	}

	function index(){
		$this->view->sheetcount = $this->model->get_parts('ZE001');
		$this->view->render('pipe/index');
	}

	function manage(){
		$this->view->render('pipe/manage');
	}

	function get(){
		$start = $_GET['start'];
		$end = $_GET['end'];
		$rows = $this->model->fetch_request($start, $end);
		echo json_encode($rows);
	}

	function update(){
		$stack = json_decode($_POST['data'], TRUE);

		if(isset($stack)){
			// $storingdate = date('Y-m-d');
			//get posting string
			if(($string = $this->model->update_requestdetail($stack)) !== true){
				echo "false";
			}

			//update part table
			if($this->model->update_partquantity($stack, '+') !== true){
				echo 'false';
			}

			echo 'true';
		} else {
			echo 'false';
		}
	}

	function submit() {
		$stack = json_decode($_POST['stack'], TRUE);
		$squantity = $_POST['squantity'];

		if(isset($stack)){
			$orderingdate = date('Y-m-d');
			// echo $orderingdate;
			// get ordernumber
			$ordernum = $this->model->get_request();
			//get inserted ordernumber

			if($this->model->insert_requestnumber($ordernum, $orderingdate, $squantity) !== true){
				echo 'false';
			}

			// //get posting string
			$string = $this->model->post_request($stack, $ordernum);
			// echo $string;
			// //insert order detail
			if($this->model->insert_requestdetail($string) !== true){
				echo 'false';
			}
			//update part table
			if($this->model->update_steelsheet($squantity) !== true){
				echo 'false';
			}
			if($this->model->update_parts($stack, '+') !== true){
				echo 'false';
			}

			echo 'true';
		} else {
			echo 'false';
		}
	}

}