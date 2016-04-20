<?php

class Model {

    function __construct() {
        $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die();
    }

	//function used to get the part data
	//@para: {Object} $this->db
	//@return: {Array} $row 
	//
	public function get_part_data($LocalId){
		$this->db->set_charset("utf8");
		$query = "SELECT PartName, PartNumber, PricePerUnit
	    		FROM parts
	   			WHERE LocalId = ?
	    		LIMIT 1";
	    $stmt = $this->db->prepare($query);
	    if($stmt){
			if(!$stmt->bind_param('s',$LocalId)){
				return "binding param failed";
			}
			$stmt->execute();
			if(!$stmt->bind_result($name, $number, $price)){
				return "binding result failed";
			}
			while($stmt->fetch()){
				$row = array();
				$row['name'] = $name;
				$row['id'] = $number;
				$row['ppu'] = $price;
			}
			if(empty($row)){
				$row['false'] = 'false';
			}
	        return $row;
		} else {
			die();
		}
	}


}