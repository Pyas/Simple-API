<?php
/**
 * 
 */
class Database
{
	private static $host,$db_name,$username,$password,$connection;
	function __construct($host,$db_name,$username,$password)
	{
		self::$host=$host;
		self::$db_name=$db_name;
		self::$username=$username;
		self::$password=$password;
		self::$connection=null;
		// $this->host=$host;
		// $this->db_name=$db_name;
		// $this->username=$username;
		// $this->password=$password;
		// $this->connection=null;
	}
	 static function connect()
	{
		try{

			self::$connection=new PDO('mysql:host='.self::$host.';dbname='.self::$db_name,self::$username,self::$password);
			self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			// $this->connection=new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
			// $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo "Connection Error<br>".$e->getMessage();
		}
		//return $this->connection;
		return self::$connection;
	}
}