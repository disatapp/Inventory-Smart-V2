<?php

class Controller {

    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
    }
    
    /**
     * the defualt controller
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = 'models/') {
        
        $path = $modelPath . $name.'_model.php';
        
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }        
    }

    public function find_part() {
        $localid = $_POST['localid'];
        $arr = $this->model->get_part_data($localid);
        if($arr){
            echo json_encode($arr);
        }
    }

    public function find_cus(){
        $id = $_POST['id'];
        $arr = $this->model->get_cus_data($id);
        if($arr){
            echo json_encode($arr);
        } else {
            echo 'false';
        }
    }
}