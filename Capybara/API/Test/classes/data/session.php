<?php
	class data_session {
	
		public $error;
		public $secondError;
		protected $db;
		public $loginFormHeadline;
		public $usernameString;
		public $passwordString;
		public $loginButtonText;
		public $timeLeftUntilLogout;
		protected $lang;
		private $loggedApi=false;
		
		function __construct() {
			session_start();
			if($_GET['errors']=='on') {
				error_reporting(E_ALL);
				ini_set("display_errors",1);
			} elseif($_GET['errors']=='off') {
				error_reporting(0);
				ini_set("display_errors",0);				
			}
			if(isset($_GET['debug']) && $_GET['debug']=='session') {
				print 'Session started<br>';
				print json_encode($_SESSION).'<br>';
			}
			$db = new data_securityDatabase();
			$conf=config_conf::getSingleton();
			$db->selectDB($conf->get('db_security_database'));
			$this->db=$db;
			
			if(isset($_REQUEST['lang']))
				$_SESSION['lang']=$_REQUEST['lang'];
			if(!isset($_SESSION['lang']))
				$_SESSION['lang']=$conf->get('lang','en');
			$lang=lang_lang::getSingleton($_SESSION['lang'],$this->db);	
			$this->lang=$lang;
			$this->loginFormHeadline=$lang->get('Log_in');
			$this->usernameString=$lang->get('Username');
			$this->passwordString=$lang->get('Password');
			$this->loginButtonText=$lang->get('Log in');
		}
		
		function __destruct() {
			@$this->db->close();
			unset($this->db);		
		}
	
		function checkLogin($showLoginForm=false,$updateCookie=true) {
			helper::debugPrint('Check login','login');
			$db=$this->db;
			if(isset($_REQUEST['logout'])) {
				helper::debugPrint("Log out","login"); 
				$this->doLogout();
			}
			
			$this->timeSinceLastActivity=0;
			
			if(isset($_SESSION['session_variable']) && isset($_SESSION['userid']))
			{
				helper::debugPrint("Session variable set","login"); 
				$timestamp = date('YmdHis');
				$limit=config_conf::getSingleton()->get('login_timeout',60*30);
				$query = 'select id,' . $timestamp . '-latest_login as timePassed from user_logins where userid = ' . addslashes($_SESSION['userid']) .' and cookiestring = "' . addslashes($_SESSION['session_variable']) . '" and ' . $timestamp . '-latest_login <'.$limit;
				
				helper::debugPrint("Query for login details","login"); 
				
				$db->query($query,0);
				$row = $db->getRow();
				
				$this->timeLeftUntilLogout=$limit-$row->timePassed;
				
				helper::debugPrint($query,'login');				
				if($row)
				{
					if($this->checkUrl($_SESSION['userid'],$_SERVER['SCRIPT_NAME'],true,true)) 
					{
						helper::debugPrint("User is still logged in. Update db.","login"); 
						$db->pointer(0);
						
						$query = 'update user_logins set latest_login = ' . $timestamp . ' where id=' . $row->id;
						
						if($updateCookie)
							$db->query($query);
						
						helper::debugPrint("Session variable: ".$_SESSION['session_variable'],'login');
							
						//helper::debugPrint("Set session variable","login");
						//$_SESSION['userid'] = $_SESSION['userid'];
						//$_SESSION['session_variable'] = $_SESSION['session_variable'];
						return true;				
					}
				} else {
					helper::debugPrint("Session timed out","login"); 
					$this->doLogout();
					$this->error='Session timed out';
					if($showLoginForm)
						$this->showLogin();
					else
						return false;
				}
			} elseif(isset($_POST['loginUsername']) and isset($_POST['loginPassword']))	 {
				helper::debugPrint("Login credentials posted","login"); 
				#Initial login. Checking password.
				
				if($this->checkId($db,$_POST['loginUsername'], $_POST['loginPassword']))
				{
					helper::debugPrint("Login ok. Check credentials.","login"); 
					$query = 'select id from users where email = "' . addslashes($_POST['loginUsername']) . '" and password = md5(sha1("'. addslashes($_POST['loginPassword']) .'"))';
					$db->query($query,0);
					$row = $db->getRow();
					if($row and $this->checkUrl($row->id,$_SERVER['SCRIPT_NAME']))
					{
						$this->authorize($row,$db);	
						return true;				
					} else {
						helper::debugPrint("User not permitted to watch page","login"); 
						$this->error = "Invalid username or password or user has no access to this page";
						if($showLoginForm)
							$this->showLogin();
						else
							return false;						
					}
				} else {
					#username / password is wrong
					helper::debugPrint("Invalid username or password","login"); 
					$query = 'insert into false_logins values(null, now(), "' . addslashes($_POST['loginUsername']) . '","","' . addslashes($_SERVER['REMOTE_ADDR']) . '")';
					$db->query($query);
					$this->error="Invalid username or password";
					if($showLoginForm)
						$this->showLogin();
					else
						return false;						
				}
			} elseif (isset($_GET['api_key'])) {
				$query = 'select id from users where apiKey = "' . addslashes($_GET['api_key']).'"';
				$db->query($query,0);
				$row = $db->getRow();
				if($row and $this->checkUrl($row->id,$_SERVER['SCRIPT_NAME']))
				{
					if(!$this->verifyApiAccessLimits($_GET['api_key']))
						return false;
					$_SESSION['userid'] = $row->id;
					//$this->authorize($row,$db);	
					if(!$this->loggedApi) {
						$query = 'insert into user_logins (latest_login,cookiestring,userid) VALUES (NOW(),"'.$_GET['api_key'].'",' . $row->id.')';
						$db->query($query);
						$this->loggedApi=true;
					}
					return true;				
				}
				$this->error="Not authorized.";
			} else {
				$this->secondError="";
				if(isset($_SESSION['session_variable']))
					$this->secondError.='session_variable SET,';
				else
					$this->secondError.='session_variable NOT SET,';
				if(isset($_SESSION['userid']))
					$this->secondError.='userid SET';
				else
					$this->secondError.='userid NOT SET';
				
				if($showLoginForm)
					$this->showLogin();
				else
					return false;				
			} 
		}	
		
		public function getLoggedInUserPrefsPath() {
			if(!$this->checkLogin(false,false))
				return false;
			$query = 'SELECT configFile FROM users WHERE id='.$_SESSION['userid'];
			$this->db->query($query);
			if($row=$this->db->getRow())
			{
				return $row->configFile;
			}
			return false;
		}
		
		private function verifyApiAccessLimits($apiKey) {
			$sql="SELECT count(id) as c FROM `user_logins` WHERE latest_login>(NOW()-INTERVAL 1 MINUTE) AND cookiestring='$apiKey'";
			$res=$this->db->query($sql);
			$row=$this->db->getRow();
			if($row->c>1000) {
				$this->error="You have reached your api limit. Please try again in a little while.";
				return false;
			}
			return true;
		}
		
		private function authorize($row,$db) {
			helper::debugPrint("Url permissions ok.","login"); 
			$timestamp = date('YmdHis');
			$_SESSION['userid'] = $row->id;
			$_SESSION['session_variable'] = md5($timestamp);
			
			session_write_close();
			
			session_start();
			
			$arr = array();
			$arr['latest_login'] = $timestamp;
			$arr['datetime'] = $timestamp;
			$arr['cookiestring'] = md5($timestamp);
			$arr['userid'] = $row->id;
			$res = $db->performInsert('user_logins', $arr);		
		}
		
		function checkUrl($userId=false, $requestUri,$autoDie=false,$showLinkOnAutoDie=false) {
			$db=$this->db;
			if(!$userId)
				$userId=$this->getLoggedInUserId();
			if($userId=='')
				return false;
			$query = 'select id from user_access_rights where userid="' . addslashes($userId) . '" and scope="' . addslashes($requestUri) . '" and privileges=0';
			$db->query($query,0);
			if(!$db->getRow())
			{			
				if(!$this->checkGroupPrivilege($userId,$requestUri,0))
				{
					$query = 'select id,privileges from user_access_rights where userid="' . addslashes($userId) . '" and scope="ALL"';
					$db->query($query,0);
					if($row=$db->getRow())
						if($row->privileges>0)
							return true;
					
					if($this->checkGroupPrivilege($userId,$requestUri,1))
						return true;
						
					$query = 'select id from user_access_rights where userid="' . addslashes($userId) . '" and scope="' . addslashes($requestUri) . '" and privileges>0';
					$db->query($query,0);
					if($db->getRow())
						return true;
						
				}
			}
			if($autoDie) {
				print "<p class='headline'>".$this->lang->get('You_do_not_have access_rights to this page'). ' ('. $requestUri .").</p>";
				if($showLinkOnAutodie)
					print "<p><a href='index.php'>&lt;-- ".$this->lang->get('Back to menu')."</a>";
				die("");
			}
			return false;
		
		}
		
		protected function checkGroupPrivilege($userId,$group,$privileges) {
			$db=$this->db;
			$query = 'select id from user_access_rights where userid="' . addslashes($userId) . '" and scope="' . addslashes($group) . '" and privileges='.$privileges;
			$db->query($query,0);
			if($db->getRow())
				return true;

			$query = 'select id from user_access_rights where userid="' . addslashes($userId) . '" and scope="' . addslashes($group) . '" and privileges='.!$privileges;
			$db->query($query,0);
			if($db->getRow())
				return false;
				
			$query = 'SELECT DISTINCT user_access_group.groupName FROM user_access_group WHERE scope="' . addslashes($group) . '"';
			$db->query($query,0);
			if($row=$db->getRow())
				return $this->checkGroupPrivilege($userId,$row->groupName,$privileges);
			
			return false; 
		}
		
		protected function checkId($db,$user,$pass) {
			$query = 'select id from users where email = "' . addslashes($user) . '" and password = md5(sha1("'. addslashes($pass) .'"))';
			$db->query($query,0);
			if($db->getRow())
				return true;
			else
				return false;
		
		}
		
		function getLoggedInUserId() {
			return $_SESSION['userid'];
		}
		
		function doLogout() {
			@session_destroy();
			data_dataStore::clearStore();
			helper::debugPrint("Logout",'login');
		}
		
		public function showLogin($thenDie=true) {
			unset($_SESSION['session_variable']);
			unset($_SESSION['userid']);
			
			$loginDiv=new html_div();
			$loginDiv->id='loginForm';
			$qStr=(isset($_SERVER['QUERY_STRING'])?"?":"").$_SERVER['QUERY_STRING'];
			if(stristr($_SERVER['QUERY_STRING'],'logout'))
				$qStr='';
			$loginForm=new html_form($_SERVER['SCRIPT_NAME'].$qStr);
			$loginForm->id='loginFormForm';
			$loginTable=new html_table();
			$loginTable->id='loginTable';
			$loginTable->addEntity(new html_tr('',array(new html_td($this->loginFormHeadline,2,'loginHeadline'))));
			$usernameInput=new html_text();
			$usernameInput->id='loginUsername';
			$usernameInput->name='loginUsername';
			$loginTable->addEntity(new html_tr('',array($this->usernameString.':',$usernameInput)));
			$passwordInput=new html_password();
			$passwordInput->id='loginPassword';
			$passwordInput->name='loginPassword';
			$loginTable->addEntity(new html_tr('',array($this->passwordString.':',$passwordInput)));
			if($this->error!='')
				$loginTable->addEntity(new html_tr('',array(new html_td($this->lang->get($this->error).'.',2,'error'))));	
			$loginButton=new html_button($this->loginButtonText);
			$loginButton->id='loginButton';
			$loginButton->isSubmit=true;
			$loginTable->addEntity(new html_tr('',array('&nbsp;',$loginButton)));
			
			$loginForm->addEntity($loginTable);
			$loginDiv->addEntity($loginForm);
			$loginDiv->printHTML();	
			if($thenDie)
				die();
		}
	}
?>