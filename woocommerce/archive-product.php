<?php
/**
 * The template for displaying Product Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Openstrap already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */

get_header(); ?>

<?php 
	$col =  openstrap_get_content_cols();
	$col = 9;
	$os_layout = of_get_option('page_layouts'); 	
?>
<?php get_sidebar('shop'); ?>
<div class="col-md-<?php echo $col;?>" role="content">
	<section id="primary" class="site-content">
		<div id="content" role="main">
		<article class="article">			
				<?php do_action('woocommerce_before_main_content'); ?>
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
					<?php do_action( 'woocommerce_archive_description' ); ?>
					<?php if ( have_posts() ) : ?>
						<?php do_action( 'woocommerce_before_shop_loop' ); ?>
						<?php woocommerce_product_loop_start(); ?>
							<?php woocommerce_product_subcategories(); ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php woocommerce_get_template_part( 'content', 'product' ); ?>
							<?php endwhile; // end of the loop. ?>
						<?php woocommerce_product_loop_end(); ?>
						<?php do_action( 'woocommerce_after_shop_loop' ); ?>
					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
						<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
					<?php endif; ?>
				<?php do_action('woocommerce_after_main_content'); ?>
			
		</article>

		</div><!-- #content -->
	</section><!-- #primary -->
</div><!-- .col-md-<?php echo $col;?> -->
<?php get_footer(); ?>

