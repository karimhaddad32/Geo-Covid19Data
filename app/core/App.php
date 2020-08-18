<?php

class App
{
	protected $controller = 'Covid19Controller';
	protected $method = 'Index';
	protected $params = [];
	
	public function __construct() {
		$url = $this->parseURL();
		if (!isset($url[0])) {
			header('location:/Covid19/index');
			return;
		}
		

		//setting the controller
		if (file_exists('app/controllers/' . $url[0] . 'Controller.php')) {
			$this->controller = $url[0] . 'Controller';
		}else{
			header('location:/Covid19/index');
			return;
		}

		unset($url[0]);

		require_once 'app/controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller();

		
		//setting the action in the controller
		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
			}else{
		
					header('location:/Covid19/index');
					return;
				
			}
			unset($url[1]);
		}
		
		//setting the parameters
		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	//return "/controller/action/param1/param2" as
	//array('controller','action','param1','param2')
	public function parseUrl() {
		if (isset($_GET['url'])) {
			return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}

?>
