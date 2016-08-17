<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Blog/App/DB.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Blog/App/Category.php');

class Post
{
	protected $table = 'post';

	protected $postPerPage = 1;

	protected $page = 1;

	protected $startCount = 0;

	protected $totalPage;

	public function __construct(){

	}

	public function havePosts()
	{
		$sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT $this->startCount,$this->postPerPage";
		$stm = DB::prepare($sql);
		$stm->execute();
		if(	$stm->rowCount() > 0){
			return $stm->fetchAll();
		}
		return false;		
	}

	public function AllPosts()
	{
		$sql = "SELECT * FROM $this->table";
		$stm = DB::prepare($sql);
		$stm->execute();
		if(	$stm->rowCount() > 0){
			return $stm->rowCount();
		}
		return false;		
	}



	static public function theTitle(array $post)
	{
		echo $post['postTitle'];
	}

	static public function thePermalink(array $post)
	{
		echo 'single.php?post='.$post['id'];
	}

	static public function theContent(array $post){
		echo $post['postBody'];
	}

	static public function theExcerpt(array $post){
		
		$post = $post['postBody'];
		$post = explode(' ', $post);
		$post = array_slice($post,0,45);
		$post = implode(' ',$post);
		$post = $post.'....';
		echo $post;

	}

	static public function theCategory(array $post){
		$catID = $post['postCategory'];
		$cat = '<a href="archive.php?cat='.$catID.'">'.Category::CatByID($catID).'</a>';
		echo $cat;
	}

	static public function theDate(array $post,$format='d M Y'){
		echo date($format,strtotime($post['postDate']));
	}

	static public function theThumbnail(array $post)
	{
		
		$link = 'assets/img/thumbsgallery/'.$post['postThumb'];
		echo '<img class="pull-left" src="'.$link.'" alt="thumb3">';
	}

	public function SetPageNumber($page){
		$this->page = $page;
		$this->startCount= ($this->page*$this->postPerPage)-$this->postPerPage;
	}

	public function SetPostLimit($limit){
		$this->postPerPage = $limit;
	}

	public function thePagination($page){

		$totalPage = ceil( $this->AllPosts() / $this->postPerPage );
		$less = ($page>1)?$this->page-1:1;
		$greater = ($page<$totalPage)?$this->page+1:$totalPage;
		$pagi =  '<ul class="pagination">';
		$pagi .= '<li><a href="index.php?page='.($less).'">&laquo;</a></li>';
		for ( $i=1; $i<=$totalPage; $i++ ) {
			$pagi .= '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
		}
		$pagi .= '<li><a href="index.php?page='.($greater).'">&raquo;</a></li>';
		$pagi .= '</ul>';
		if( $totalPage > 1 ){
			echo $pagi;
		}

		return false;
	}


	

}
