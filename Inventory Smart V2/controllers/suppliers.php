<?php

class Suppliers extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->js = array('suppliers/js/supFunction.js');
	}

	function index(){
		$this->view->render('header', true);
		$this->view->render('suppliers/index', true);
		$this->view->render('suppliers/add', true);
		$this->view->render('suppliers/edit', true);
		$this->view->render('footer', true);
	}

	function get(){
		if(isset($_GET['name']) || isset($_GET['contname'])){
			$adding_array = array('name' => $_GET['name'],
								'contname' => $_GET['contname']);

			if($result_array = $this->model->sup_searcher($adding_array)) {
				echo json_encode($result_array,JSON_UNESCAPED_UNICODE);
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
	}

	function post(){
		if(isset($_POST['name'])){
			$adding_array = array('name' => $_POST['name'],
								'contname' => $_POST['contname'],
								'address' => $_POST['address'],
								'bldname' => $_POST['bldname'],
								'muu' => $_POST['muu'],
								'soi' => $_POST['soi'],
								'road' => $_POST['road'],
								'subdis' => $_POST['subdis'],
								'dis' => $_POST['dis'],
								'prov' => $_POST['prov'],
								'zip' => $_POST['zip'],
								'tel' => $_POST['tel'],
								'fax' => $_POST['fax'],);
			

			if($this->model->sup_adder($adding_array)){
				echo "true";
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
	}

	function update(){	
		if(isset($_POST['name'])){
			$adding_array = array('name' => $_POST['name'],
								'contname' => $_POST['contname'],
								'address' => $_POST['address'],
								'bldname' => $_POST['bldname'],
								'muu' => $_POST['muu'],
								'soi' => $_POST['soi'],
								'road' => $_POST['road'],
								'subdis' => $_POST['subdis'],
								'dis' => $_POST['dis'],
								'prov' => $_POST['prov'],
								'zip' => $_POST['zip'],
								'tel' => $_POST['tel'],
								'fax' => $_POST['fax']);
			

			if($this->model->sup_updater($adding_array,$_POST['supID'])){
				echo "true";
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
}

	function check(){
		if(isset($_GET['name'])){
			$search_result = $this->model->sup_exist_search($_GET['name']);
			if($search_result){
				echo "existed";
			}else if($search_result === 0){
				echo "none-existed";
			}else {
				echo "false";
			}
		} else {
			echo "false";
		}

	}

}


