<?php

require_once(__DIR__ . '/../config.php');
require_once(DB .  'connection.php');

class QueryManager
{
	private static $queryPath ='/sql/';

	private static function loadQuery($filename)
	{
		return file_get_contents(__DIR__ . self::$queryPath . $filename);
	}

	private static function executeQuery($filename, $obj=null)
	{
		$conn = DatabaseConnection::getConnection();
		$stmt = $conn -> prepare(self::loadQuery($filename));
		if($obj != null)
		{
			$query = self::loadQuery($filename);
			$stmt = $conn -> prepare($query);
			foreach($obj as $key => $value)
			{
				// bind the value if the query has that parameter in it
				if(strpos($query, ":$key"))
				{
					$type = PDO::PARAM_STR;
					if(is_int($value))
						$type = PDO::PARAM_INT;
					$stmt -> bindValue(":$key", $value, $type);
				}
			}
		}
		$stmt -> execute();
		return $stmt;
	}

	public static function query($filename, $obj=null)
	{
		$stmt = self::executeQuery($filename, $obj);
		return $stmt -> fetchAll();
	}

	public static function insert($filename, $obj=null)
	{
		$stmt = self::executeQuery($filename, $obj);
		return DatabaseConnection::getConnection() -> lastInsertId();
	}
	
	public static function update($filename, $obj=null)
	{
		$stmt = self::executeQuery($filename, $obj);
		return $stmt -> rowCount();
	}
}
?>
