<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Blog/config/Config.php');
class DB
{

	static private function Connection()
	{
		try{
			$conn = new PDO('mysql:host='.Config::HOST.';dbname='.Config::DBNAME,Config::USER,Config::PASSWORD);
			return $conn;
		}catch(PDOException $e){
			return false;
		}
	}


	static public function prepare($sql){
		return self::Connection()->prepare($sql);
	}

	


}

