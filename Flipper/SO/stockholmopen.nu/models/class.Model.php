<?php
require_once(BASE_DIR . "classes/class.MDB2Wrapper.php");

class Model
{
	protected $oDB = null;
	protected $oMDB2Wrapper = null;	

	public function __construct()
	{
        $this->oDB = MDB2::singleton(unserialize(DSN));
		$this->oDB->setFetchMode(MDB2_FETCHMODE_ASSOC);
		$this->oMDB2Wrapper = new MDB2Wrapper($this->oDB);
	}
}
?>