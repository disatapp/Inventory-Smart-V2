<?php

class Order extends Controller{

	function __construct(){
		parent::__construct();
		$this->view->js = array('order/js/orderItem.js' ,'order/js/viewOrder.js');
	}

	function index(){
		$this->view->render('order/index');
	}

	function find(){
		$this->view->render('order/find');
	}

	function get(){
		$ordernumber = $_GET['ordernumber'];
		$rows = $this->model->fetch_order($ordernumber);
		echo json_encode($rows);
	}

	function submit() {
		$stack = json_decode($_POST['stack'], TRUE);
		$orderingdate = $_POST['orderingdate'];
		if(isset($stack)){
			echo var_dump($stack);
			//get ordernumber
			$ordernum = $this->model->get_invoice();

			//get inserted ordernumber
			if($this->model->insert_ordernumber($ordernum, $orderingdate) !== true){
				echo 'false';
			}

			//get posting string
			// $string = post_order($stack, $ordernum);
			$string = $this->model->post_order($stack, $ordernum);
			
			//insert order detail
			if($this->model->insert_orderdetail($string) !== true){
				echo 'false';
			}

			echo 'true';
		} else {
			echo 'false';
		}
	}

}