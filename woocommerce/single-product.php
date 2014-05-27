
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

<?php $col = 9; ?>
<div class="col-md-<?php echo $col;?>" role="content">
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php do_action('woocommerce_before_main_content'); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
				<?php endwhile; // end of the loop. ?>
			<?php do_action('woocommerce_after_main_content'); ?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- .col-md-<?php echo $col;?> -->
<?php get_sidebar('product'); ?>
<?php get_footer(); ?>