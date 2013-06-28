<?php
	abstract class controllers_baseController {
		
		private $view;
		private $model;
		
		public $defaultAction="index";
		
		public function __construct($model,$route) {
			$this->model=$model;
			$action=$this->getView($route);
		}
		
		public abstract function getControllerName();
		
		public function getView($route) {
			if(count($route)==0 || $route[0]=='' || is_numeric($route[0]))
				$action=$this->defaultAction;
			else {
				$action=$route[0];
				array_shift($route);
			}
			if(method_exists($this,$action))
				$this->$action($route);
			else
				die("Could not find action $action on viewcontroller ".$this->getControllerName());
		}
		
		public function index($args) {
			helper::debugPrint("Show view Index with args: ".json_encode($args),"viewcontroller");
			if(count($args)==0 || $args[0]=='')
				$this->view=new ViewTemplate($this->getControllerName(),"list",$this->model);			
			else
				$this->view=new ViewTemplate($this->getControllerName(),"index",$this->model[0]);
		}
		
		function __destruct() {
			$this->view->render();
		}
	}
	
	class ViewTemplate {
		
		private $action;
		private $model;
		private $controller;
		
		function __construct($controller,$action,$model) {
			$this->action=$action;
			$this->model=$model;
			$this->controller=$controller;
		}
		
		function render() {
			$ds=DIRECTORY_SEPARATOR;
			$loader=new Twig_Loader_Filesystem(array(ROOT.$ds."views".$ds.$this->controller.$ds,ROOT.$ds."views".$ds."_shared".$ds,ROOT.$ds."views".$ds));
			$twig=new Twig_Environment($loader);
			echo $twig->render($this->action.".htm",array('model'=>$this->model,'viewModel'=>$this,'html'=>new html_htmlHelper($this->controller),'url'=>$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']));
		}
		
		function renderPartialView($view,$controller=false) {
			if(!$controller)
				$controller=$this->controller;
			$loader=new Twig_Loader_Filesystem(array(ROOT.$ds."views".$ds.$controller.$ds,ROOT.$ds."views".$ds."_shared".$ds));
			$twig=new Twig_Environment($loader);
			echo $twig->render($this->action.".htm",array('model'=>$this->model,'viewModel'=>$this,'html'=>new html_htmlHelper($this->controller)));
		}
		
		/*
		function render() {
			extract(array('model'=>$this->model,'viewModel'=>$this));
			$ds=DIRECTORY_SEPARATOR;
			if(file_exists(ROOT.$ds."views".$ds.$this->controller.$ds.$this->action.".php"))
				$view=ROOT.$ds."views".$ds.$this->controller.$ds.$this->action.".php";
			elseif(file_exists(ROOT.$ds."views".$ds."_shared".$ds.$this->action.".php"))
				$view=ROOT.$ds."views".$ds."_shared".$ds.$this->action.".php";
			else {
				print "File not found: ".ROOT.$ds."views".$ds.$this->controller.$ds.$this->action.".php<br />";
				print "File not found: ".ROOT.$ds."views".$ds."_shared".$ds.$this->action.".php<br />";
			}
			extract(array('view'=>$view));
			if(!file_exists(ROOT.$ds."views".$ds."_shared".$ds."_root.php"))
				print "File not found: ".ROOT.$ds."views".$ds."_shared".$ds."_root.php.<br />";
			else
				include(ROOT.$ds."views".$ds."_shared".$ds."_root.php");
		}
		
		public function renderPartialView($controller,$action,$model) {
			$ds=DIRECTORY_SEPARATOR;
			if(file_exists(ROOT.$ds."views".$ds.$controller.$ds.$action.".php"))
				$view=ROOT.$ds."views".$ds.$controller.$ds.$action.".php";
			elseif(file_exists(ROOT.$ds."views".$ds."_shared".$ds.$action.".php"))
				$view=ROOT.$ds."views".$ds."_shared".$ds.$action.".php";
			else {
				print "File not found: ".ROOT.$ds."views".$ds.$controller.$ds.$action.".php<br />";
				print "File not found: ".ROOT.$ds."views".$ds."_shared".$ds.$action.".php<br />";
			}
			extract(array('model'=>$model));
			include($view);
			extract(array('model'=>$this->model));
			
		}
		*/
	}