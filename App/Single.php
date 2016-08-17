<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Blog/App/Post.php');

class SinglePost extends Post
{
	public function havePosts($id)
	{
		$sql = "SELECT * FROM $this->table WHERE id = :id LIMIT 1";		
		$stm = DB::prepare($sql);
		$stm->bindParam(':id',$id,PDO::PARAM_INT);
		$stm->execute();
		if(	$stm->rowCount() > 0){
			return $stm->fetchAll();
		}
		return false;		
	}
}