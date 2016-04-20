<?php

class Printing extends Controller {

	function __construct(){
		parent::__construct();	
	}

	function index(){
		$this->view->render('printing/index');

	}

	function preview($invoice, $printdate, $vat){

		if(empty($invoice)){
        	$this->view->render('printing/index');
	    } else {
	   		$this->view->printdate = (empty($printdate)) ? false : $printdate;
	   		$this->view->vat = (empty($vat)) ? 0.00 : $vat;
	   		$this->view->invoice = $invoice;

	   		// //get input data
	   		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	        $this->view->inputdata = $this->model->get_cus_invoice($this->view->invoice);
	        // $this->view->test = var_dump( $this->view->inputdata);
	    	$this->view->array = $this->model->get_address($this->view->inputdata['customerID']);
	    	$this->view->address = $this->model->concat_address($this->view->array);
	    	$this->view->today = getdate();
	    	$this->view->strMonthThai = $strMonthCut[$this->view->today['mon']];

	    	// get the invoice data 
	    	$rows = $this->model->get_item_invoice($this->view->invoice);
	    	// $this->view->test = var_dump($rows);

	    	//initialize some data
	    	$rowsCount = 0;
            $this->view->subtotal = $this->view->wage = $this->view->discount = $this->view->total =  0.00;
           	$this->view->combineName ='';
	    	$this->view->result = '';

            //return a result to be printed in the invoice 
            foreach ($rows as $key => $arr) {
                $perunit = number_format($rows[$key]['TotalAmount']/$rows[$key]['Quantity'], 2, '.', ',');
                $this->view->subtotal += $rows[$key]['TotalAmount'];

                $rowsCount++;
                if($rows[$key]['PartNumber']!=""){
                    $this->view->combineName .=" (".$rows[$key]['PartNumber'].")";
                    $this->view->result .= '<tr><td>'.$rowsCount.
                        '</td><td>'.$rows[$key]['PartName'].
                        '</td><td>฿ '.$perunit.
                        '</td><td>'.$rows[$key]['Quantity'].
                        '</td><td>฿ '.$rows[$key]['TotalAmount'].
                        '</td><td></tr>';
                }
            }
        	if(isset($this->view->inputdata['wage'])){
        	    $this->view->wage = $this->view->inputdata['wage'];
            }
            if(!empty($this->view->inputdata['discount'])){
                $this->view->discount = $this->view->inputdata['discount'];
            }

			$this->view->total = (float)$this->view->subtotal + (float)$this->view->vat + (float)$this->view->wage - (float)$this->view->discount;
            $this->view->numberToText = $this->model->numberToText($this->view->total);
            // format
            $this->view->total = number_format($this->view->total, 2 ,'.',',');
	    	$this->view->subtotal = number_format($this->view->subtotal, 2,'.',',');
	    	$this->view->wage = number_format($this->view->wage, 2,'.',',');
	    	$this->view->discount = number_format($this->view->discount, 2,'.',',');
	    	

	        $this->view->render('printing/preview');
	    }
	}

	function test() {
		$this->view->rows = $this->model->get_item_invoice('A201202015');
		$this->view->test = var_dump($this->view->rows);
		$this->view->render('printing/test');
	}
}