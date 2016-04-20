<?php

class Parts extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->js = array('parts/js/partFunction.js');
	}

	function index(){
		$this->view->render('header', true);
		$this->view->render('parts/index', true);
		$this->view->render('parts/add', true);
		$this->view->render('parts/edit', true);
		$this->view->render('footer', true);
	}

	function get(){
		if(isset($_GET['localid']) || isset($_GET['partname']) || isset($_GET['partnumber']) || isset($_GET['storingplace'])){
			$adding_array = array('localid' => $_GET['localid'],
								'partname' => $_GET['partname'],
								'partnumber' => $_GET['partnumber'],
								'storingplace' => $_GET['storingplace']);
			// echo $result_array = json_encode($this->model->part_searcher($adding_array));
			if($result_array = $this->model->part_searcher($adding_array)) {
				echo json_encode($result_array,JSON_UNESCAPED_UNICODE);
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
	}

	function post(){
		if(isset($_POST['partname'], $_POST['partnumber'])){
			$adding_array = array('localid' => $_POST['localid'],
								'partname' => $_POST['partname'],
								'partnumber' => $_POST['partnumber'],
								'storingplace' => $_POST['storingplace'],
								'priceperunit' => $_POST['priceperunit'],
								'quantity' => $_POST['quantity'],
								'regularprice' => $_POST['regularprice'],
								'commissionprice' => $_POST['commissionprice'],
								'warningquantity' => $_POST['warningquantity'],
								'note' => $_POST['note']);

			if($this->model->part_adder($adding_array)){
				echo "true";
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
	}

	function update(){	
		if(isset($_POST['partname'])){
			$adding_array = array('partname' => $_POST['partname'],
								'partnumber' => $_POST['partnumber'],
								'storingplace' => $_POST['storingplace'],
								'priceperunit' => $_POST['priceperunit'],
								'quantity' => $_POST['quantity'],
								'regularprice' => $_POST['regularprice'],
								'commissionprice' => $_POST['commissionprice'],
								'warningquantity' => $_POST['warningquantity'],
								'note' => $_POST['note']);
			
			// echo $this->model->part_updater($adding_array,$_POST['localid']);
			if($this->model->part_updater($adding_array,$_POST['localid'])){
				echo "true";
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
	}

	function check(){
		if(isset($_GET['localid'])){

			if($id_result = $this->model->last_id_searcher($_GET['localid'])){
				//if the initial id exists
				echo $id_result;
			} else{
				//error
				echo "false";
			}

		} else {
			echo "false";
		}

	}

}

