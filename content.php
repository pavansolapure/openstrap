<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<header>
		<hgroup>
			<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'openstrap' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
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
			<div class="pull-right">				
				<span class="post_comment"><i class="icon-comments"></i>
				<a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'openstrap'),__('One comment','openstrap'),__('% comments','openstrap')); ?></a>
				</span>
			</div>				
		</div> 
		</hgroup>
	</header>

	<?php if ( has_post_thumbnail()) : ?>
		<div class="featured-img pull-left">
		<a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
		</div>
	<?php endif; ?>
	
	<div class="entry-summary">
	<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<div class="clearfix"/>
</article>

<!--<hr>-->
	  
	 