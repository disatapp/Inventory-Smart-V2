<?php

class Cus extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->js = array('cus/js/cusFunction.js');
	}

	function index(){
		$this->view->render('header', true);
		$this->view->render('cus/index', true);
		$this->view->render('cus/add', true);
		$this->view->render('cus/edit', true);
		$this->view->render('footer', true);
	}

	function get(){
		if(isset($_GET['name']) || isset($_GET['surname'])){
			$adding_array = array('name' => $_GET['name'],
								'surname' => $_GET['surname']);

			if($result_array = $this->model->cus_searcher($adding_array)) {
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
								'surname' => $_POST['surname'],
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
								'fax' => $_POST['fax'],
								'taxnum' => $_POST['taxnum']);
			if($this->model->cus_adder($adding_array)){
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
								'surname' => $_POST['surname'],
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
								'fax' => $_POST['fax'],
								'taxnum' => $_POST['taxnum']);
			if($this->model->cus_updater($adding_array,$_POST['cusID'])){
				echo "true";
			} else {
				echo "false";
			}
		} else {
			echo "false";
		}
	}

	function check(){
		if(isset($_GET['name']) || isset($_GET['surname'])){
			$search_result = $this->model->cus_exist_search($_GET['name'],$_GET['surname']);
			if($search_result){
				echo "existed";
			}else if($search_result === 0){
				echo "none-existed";
			}else {
				echo "false check";
			}
		} else {
			echo "false con";
		}

	}

}

