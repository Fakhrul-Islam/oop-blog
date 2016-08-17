<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Blog/App/Post.php');

class Archive extends Post
{
	public function havePosts()
	{
		if( isset($_GET['cat']) && !empty($_GET['cat']) && filter_var($_GET['cat'],FILTER_VALIDATE_INT) )
		{
			$id = $_GET['cat'];
			$sql = "SELECT * FROM $this->table WHERE postCategory = :id ORDER BY id DESC";
		}elseif( isset($_GET['author']) && !empty($_GET['author']) && filter_var($_GET['author'],FILTER_VALIDATE_INT) )
		{
			$id = $_GET['author'];
			$sql = "SELECT * FROM $this->table WHERE postUser = :id ORDER BY id";
		}				
		$stm = DB::prepare($sql);
		$stm->bindParam(':id',$id,PDO::PARAM_INT);
		$stm->execute();
		if(	$stm->rowCount() > 0){
			return $stm->fetchAll();
		}
		return false;		
	}


}