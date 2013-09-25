<?php
/**
 * Author Box
 *
 * Loop content in single post template (author-box.php)
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */
?>


<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : 
// If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>	
<div class="panel panel-default author-info">	
<div class="panel-body">
<div class="media author-avatar">
  <a class="pull-left" href="#">
    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'openstrap_author_bio_avatar_size', 70 ) ); ?>
  </a>
  <div class="media-body author-description">
    <h3 class="media-heading"><?php printf( __( 'About %s', 'openstrap' ), get_the_author() ); ?></h3>
    <p><?php the_author_meta( 'description' ); ?></p>
	<div class="author-link">
	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
		<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'openstrap' ), get_the_author() ); ?>
	</a>
	</div><!-- .author-link	-->
  </div><!-- .author-description -->
</div><!-- .author-avatar -->
</div>
</div><!-- .author-info -->	
<?php endif; ?>	

