<?php
class User
{
	public $username = 'nobody';
	public $isAuthenticated = false;
	public $loginTime = null;

	public static $timeoutInSeconds = 600;
	
	public static function authenticate($user, $pass)
	{
		// for now we hard code
		$obj = new User();

		// TODO Read from htaccess file
		
		return $obj;
	}

	public static function checkLogin($user=null, $pass=null)
	{
		session_start();
		// check what's in session
		if($user == null)
		{
			if(!isset($_SESSION['user'])) return false;
			if(!$_SESSION['user'] -> isAuthenticated) return false;
			
			$lastActivityDelay = time() - $_SESSION['user'] -> loginTime;
			if($lastActivityDelay > User::$timeoutInSeconds) return false;

			$_SESSION['user'] -> loginTime = time();
			return true;
		}
		// otherwise check what was passed
		else
		{
			$obj = User::authenticate($user, $pass);
			if($obj -> isAuthenticated)
			{
				$_SESSION['user'] = $obj;
				return true;
			}
			else
				return false;
		}

	}
}
?>
