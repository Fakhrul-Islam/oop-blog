<?php 
require_once('inc/header.php'); 
require_once('App/Single.php');

if( isset($_GET['post']) && !empty($_GET['post']) && filter_var($_GET['post'],FILTER_VALIDATE_INT) ){
	$id = $_GET['post'];
	$postC = new SinglePost();
	$singlePost = $postC->havePosts($id);
}
?>

		<!-- === BEGIN CONTENT === -->
		<div id="content" class="container">
			<div class="row margin-vert-30">
				<!-- Main Column -->
				<?php if( $singlePost ) : ?>
					<?php foreach($singlePost as $post) : ?>
				<div class="col-md-9">
					<div class="blog-post">
						<div class="blog-item-header">
							<div class="blog-post-date pull-left">
				<span class="day"><?php Post::theDate($post,'d'); ?></span>
				<span class="month"><?php Post::theDate($post,'M'); ?></span>
							</div>
							<h2>
							<a href="<?php Post::thePermalink($post); ?>">
								<?php Post::theTitle($post); ?>
							</a>
							</h2>
						</div>
						<div class="blog-post-details">
							<!-- Author Name -->
							<div class="blog-post-details-item blog-post-details-item-left user-icon">
							</div>
							<!-- End Author Name -->
							<!-- Tags -->
							<div class="blog-post-details-item blog-post-details-item-left blog-post-details-tags tags-icon">
								<i class="fa fa-tag"></i>
								<?php Post::theCategory($post); ?>
							</div>
							<!-- End Tags -->
					
						</div>
						<div class="blog-item">
							<div class="clearfix"></div>
							<div class="blog-post-body row margin-top-15">
								<div class="col-md-5">
							<?php Post::theThumbnail($post); ?>
								</div>
								<div class="col-md-7">
								<p><?php Post::theContent($post); ?></p>
								</div>
							</div>
						
							
						</div>
					</div>
					<!-- End Blog Post -->		
					</div>
					<?php endforeach; ?>
				<?php else : ?>
					<?php header('Location:404.php'); ?>
				<?php endif; ?>
					<!-- End Main Column -->
					<!-- Side Column -->
					<?php require_once('inc/sidebar.php'); ?>
						</div>
					</div>
					<!-- === END CONTENT === -->
<?php require_once('inc/footer.php'); ?>