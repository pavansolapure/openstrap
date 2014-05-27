<?php
/**
 * Content Single
 *
 * Loop content in single post template (single.php)
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */
?>
<?php 
	$display_post_meta_info = of_get_option('display_post_meta_info');
	$display_post_page_nav = of_get_option('display_post_page_nav');
?>
<article>
	<header class="entry-header">
		<hgroup>
			<h1><?php the_title(); ?></h1>		
			<?php if(!empty($display_post_meta_info)):?>		
			<div class="post-meta entry-header">
			
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="sticky"><i class="icon-pushpin"></i> <span class="badge"><?php _e( 'Sticky', 'openstrap' ); ?> </span></span>
				<?php endif; ?>
			
				<?php
						printf( __( '<span class="post_date"><i class="icon-calendar"></i> %2$s by %3$s', 'openstrap' ),'meta-prep meta-prep-author',
						sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>',
						get_permalink(),
						esc_attr( get_the_time() ),
						get_the_date()
						),
						sprintf( '<a class="url fn n" href="%1$s" title="%2$s">%3$s</a>',
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						sprintf( esc_attr__( 'View all posts by %s', 'openstrap' ), get_the_author() ),
						get_the_author()
						)
						);
					?>     
				<div class="pull-right postcomments">					
					<span class="post_comment"><i class="icon-comments"></i>
					<a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'openstrap'),__('One comment','openstrap'),__('% comments','openstrap')); ?></a></span>
				</div>				
			</div> 
		<?php endif;?>
		<hr class="post-meta-hr"/>			
		</hgroup>
	</header>
	
	<div class="entry-content">
	<?php the_content(); ?>
	</div><!-- .entry-content -->	
	<footer class="entry-meta">					
		<p><?php wp_link_pages(); ?></p>
		<hr/>
		<?php if(!empty($display_post_page_nav)):?>
		<div class="panel panel-default">
		  <div class="panel-heading">
		 
			<nav class="nav-single">
				<div class="row">	
					<div class="col-md-6">
						<span class="nav-previous pull-left"><?php previous_post_link( '%link', '<i class="icon-arrow-left"></i> %title' ); ?></span>
					</div>	
					<div class="col-md-6">
						<span class="nav-next pull-right"><?php next_post_link( '%link', '%title <i class="icon-arrow-right"></i>' ); ?></span>
					</div>	
				</div>	
			</nav><!-- .nav-single -->	
		  
		  </div>
		  
		  <div class="panel-body">
			<div class="cat-tag-info">
				<div class="row">
				<div class="col-md-12 post_cats">
				<?php _e('<i class="icon-folder-open"></i> &nbsp;', 'openstrap' );?>
				<?php the_category(', '); ?>
				</div>
				</div>
				<?php if(has_tag()):?>
				<div class="row">
				<div class="col-md-12 post_tags">
				<?php _e('<i class="icon-tags"></i> &nbsp;', 'openstrap' );?>
				<?php the_tags('',', ',''); ?>
				</div>				
				</div>
				<?php endif;?>
			</div>				
		  </div>
		</div>	
		<?php endif;?>	
		<?php get_template_part('author-box'); ?>		
		
		<?php comments_template( '', true ); ?>
	</footer>

</article>
