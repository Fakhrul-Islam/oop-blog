<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/Blog/App/DB.php');

class Category 
{
	static public $table = 'categories';

	static function CatByID($id)
	{
		$sql = "SELECT * FROM categories WHERE id = :id LIMIT 1";
		$stm = DB::prepare($sql);
		$stm->bindParam(':id',$id,PDO::PARAM_INT);
		$stm->execute();
		$cat = $stm->fetchAll();
		
		return $cat[0]['category'];
	}
}