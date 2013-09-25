
<?php 
	$wide_sidebar = of_get_option('wider_sidebar'); 
	$col = (empty($wide_sidebar)) ? 9 : 8;	
?>
	
<?php get_sidebar('left'); ?>

<!-- Main Blog Content -->
<div class="col-md-<?php echo $col;?>" role="content">

<?php if ( have_posts() ) : ?>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>

	<?php openstrap_content_nav( 'nav-below' ); ?>
<?php else : ?>

	<article id="post-0" class="post no-results not-found">

	<?php if ( current_user_can( 'edit_posts' ) ) :
		// Show a different message to a logged-in user who can add posts.
	?>
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'No posts to display', 'openstrap' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'openstrap' ), admin_url( 'post-new.php' ) ); ?></p>
		</div><!-- .entry-content -->

	<?php else :
		// Show the default message to everyone else.
	?>
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'openstrap' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'openstrap' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	<?php endif; // end current_user_can() check ?>	

<?php endif; // end have_posts() check ?>

</div> <!-- .col-md-9 .content -->

<!-- End Main Content -->