
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

<?php get_template_part( 'content', 'none' ); ?>

<?php endif; // end have_posts() check ?>

</div> <!-- .col-md-9 .content -->

<!-- End Main Content -->