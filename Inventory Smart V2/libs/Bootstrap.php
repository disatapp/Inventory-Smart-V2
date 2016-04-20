<?php

class Bootstrap {
	
	private $_url = null;
	private $_controller = null;

	private $_controllerPath = 'controllers/';
	private $_modelPath = 'models/';
	private $_errorFile = 'error.php';
	private $_defaultFile = 'dashboard.php';

	/**
	* initialize the page
	*/
	public function init(){
		$this->_getUrl();
		// echo var_dump($this->_url);
		if(empty($this->_url[0])){
			$this->_loadDefaultController();
		} else {
			if($this->_loadExistingController() == true){
				$this->_callControllerMethod();
			}
		}
		return false;
	}

	/**
	 * get the posted url and and turn it into mvc
	 */
	private function _getUrl(){
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$this->_url = explode('/', $url);
	}

	/**
	 * SET and run the controller to a default index page  
	 */
	private function _loadDefaultController(){
		require $this->_controllerPath.$this->_defaultFile;
		$this->_controller = new dashboard();
		$this->_controller->index();
	}

	/**
	 * SET and run the controller to an existing page  
	 */
	private function _loadExistingController(){
		
		$file = $this->_controllerPath.$this->_url[0]. '.php';
		if(file_exists($file)){
			require $file;
			$this->_controller = new $this->_url[0];
			$this->_controller->loadModel($this->_url[0], $this->_modelPath);
			return true;
		} else {
			$this->_error();
			return false;
		}
	}

    private function _callControllerMethod() {
	    $length = count($this->_url);
	    // Make sure the method we are calling exists
	    if ($length > 1) {
	        if (!method_exists($this->_controller, $this->_url[1])) {
	            $this->_error();
	            return false;
	        }
	    }

	    // Determine what to load
	    switch ($length) {
	        case 5:
	            //Controller->Method(Param1, Param2, Param3)
	            $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
	            break;
	        
	        case 4:
	            //Controller->Method(Param1, Param2)
	            $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
	            break;
	        
	        case 3:
	            //Controller->Method(Param1)
	            $this->_controller->{$this->_url[1]}($this->_url[2]);
	            break;
	        
	        case 2:
	            //Controller->Method(Param1)
	            $this->_controller->{$this->_url[1]}();
	            break;
	        
	        default:
	            $this->_controller->index();
	            break;
        }
    }

	/**
	* SET and run the controller to the error page
	*/ 
	private function _error() {
        require $this->_controllerPath . $this->_errorFile;
        $this->_controller = new Error();
        $this->_controller->index();
        return false;
    }
}