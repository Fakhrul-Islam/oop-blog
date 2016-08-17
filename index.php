<?php 
require_once('inc/header.php');
require_once('App/Post.php');
$postC = new Post();

if( isset($_GET['page']) && !empty($_GET['page']) && filter_var($_GET['page'],FILTER_VALIDATE_INT) ){
	$postC->SetPageNumber($_GET['page']);
}
?>
<!-- === BEGIN CONTENT === -->
<div id="content" class="container">
<di+v class="row margin-vert-30">
<!-- Main Column -->
<div class="col-md-9">
	<?php if($postC->havePosts()) : ?>
	<?php foreach( $postC->havePosts() as $post) : ?>
	<!-- Blog Post -->
	<div class="blog-post padding-bottom-20">
		<!-- Blog Item Header -->
		<div class="blog-item-header">
			<!-- Date -->
			<div class="blog-post-date pull-left">
				<span class="day"><?php Post::theDate($post,'d'); ?></span>
				<span class="month"><?php Post::theDate($post,'M'); ?></span>
			</div>
			<!-- End Date -->
			<!-- Title -->
			<h2><a href="<?php Post::thePermalink($post); ?>"><?php Post::theTitle($post); ?></a></h2>
			<div class="clearfix"></div>
			<!-- End Title -->
		</div>
		<!-- End Blog Item Header -->
		<!-- Blog Item Details -->
		<div class="blog-post-details">
			
			<!-- End Author Name -->
			<!-- Tags -->
			<div class="blog-post-details-item blog-post-details-item-left blog-post-details-tags tags-icon">
				<i class="fa fa-tag"></i>
				<?php Post::theCategory($post); ?>
			</div>
			<!-- End Tags -->
			<!-- # of Comments -->
			<div
				class="blog-post-details-item blog-post-details-item-left blog-post-details-item-last comments-icon">
			</div>
			<!-- End # of Comments -->
		</div>
		<!-- End Blog Item Details -->
		<!-- Blog Item Body -->
		<div class="blog">
			<div class="clearfix"></div>
			<div class="blog-post-body row margin-top-15">
				<div class="col-md-5">
					<?php Post::theThumbnail($post); ?>
				</div>
				<div class="col-md-7">
					<p><?php Post::theExcerpt($post); ?></p>
					<!-- Read More -->
					<a href="<?php Post::thePermalink($post); ?>" class="btn btn-primary">
						Read More <i class="icon-chevron-right readmore-icon"></i>
					</a>
					<!-- End Read More -->
				</div>
			</div>
		</div>
		<!-- End Blog Item Body -->
	</div>
<?php endforeach; ?>
<?php else: ?>
<?php header('Location:404.php'); ?>
<?php endif; ?>
	<!-- End Blog Item -->
	<!-- Pagination -->
	<?php 

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page= 1;
	}

	?>
	<?php $postC->thePagination($page); ?>
	
</div>
<!-- End Main Column -->
<?php require_once('inc/sidebar.php'); ?>
		<!-- End Side Column -->
	</div>
</div>
<!-- === END CONTENT === -->
<?php require_once('inc/footer.php'); ?>