<?php
	require_once(__DIR__ . '/../config.php');
	require_once(DB . 'db_config.php');

	class DatabaseConnection
	{
		private static $conn = null;

		public static function getConnection()
		{
			if(self::$conn == null)
			{
				global $DB;
				$db_user = $DB[User];
				$db_pass = $DB[Pass];
				$db_name = $DB[Name];
				$db_host = $DB[Host];

				self::$conn = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user,
					$db_pass, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
			}
			return self::$conn;
		}
	}

?>

