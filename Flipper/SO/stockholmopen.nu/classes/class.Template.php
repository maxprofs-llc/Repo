<?php
require_once(SMARTY_DIR . "Smarty.class.php");

class Template extends Smarty
{
	static $_instance = NULL;
	
	public function __construct($a_aConfig, $a_sLang)
	{
		$this->template_dir = $a_aConfig['smartyTemplateDir'];
		$this->compile_dir = $a_aConfig['smartyComplieDir'];
		$this->cache_dir = $a_aConfig['smartyCacheDir'];
		$this->config_dir = $a_aConfig['smartyConfigDir'];
		$this->assign("sLang", $a_sLang);
	}
	
	public function getInstance($a_aConfig, $a_sLang)
    {
    	if(Template::$_instance == NULL)
        {
    	    Template::$_instance = new Template($a_aConfig, $a_sLang);
        }
    	return Template::$_instance;
    } 
}