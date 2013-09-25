<?php
/**
 * The template for displaying 404 pages (Not Found).
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
	
			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'openstrap' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'openstrap' ); ?></p>
					<div class="row">
						<div class="col-md-6">
							<?php get_search_form(); ?>
						</div>
					</div>
					
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- .col-md-<?php echo $col;?> -->
<?php get_sidebar(); ?>	
<?php get_footer(); ?>