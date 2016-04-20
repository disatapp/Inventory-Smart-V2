<?php

class Sell extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->js = array('sell/js/sellItem.js', 'sell/js/viewInvoice.js');
	}

	function index(){
		$this->view->render('sell/index');
	}

	function find(){
		$this->view->render('sell/find');
	}

	function get(){
		$invoicenumber = $_GET['invoicenumber'];
		$rows = $this->model->fetch_invoice($invoicenumber);
		echo json_encode($rows);
	}

	function submit() {
		$stack = json_decode($_POST['stack'], TRUE);
		$invoice = json_decode($_POST['invoice'], TRUE);
		// echo $invoice['id'];
		if(isset($stack)){
			$storingdate = date('Y-m-d');

			//get ordernumber
			$ordernum = $this->model->get_invoice();

			//get inserted ordernumber
			if($this->model->insert_sellnumber($ordernum, $storingdate, $invoice) !== true){
				echo 'false';
			}	
			//get posting string
			$string = $this->model->post_sell($stack, $ordernum);

			//insert order detail
			if($this->model->insert_selldetail($string) !== true){
				echo 'false';
			}
			//update part table
			if($this->model->update_part($stack, '-') !== true){
				echo 'false';
			}

			echo $ordernum;
		} else {
			echo 'false';
		}

	}



}