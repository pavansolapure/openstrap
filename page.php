<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */

get_header(); ?>

<?php $col =  openstrap_get_content_cols(); ?>

<div class="col-md-<?php echo $col;?>" role="content">
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- .col-md-<?php echo $col;?> -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>