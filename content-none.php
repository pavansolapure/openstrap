<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */
?>

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

</article>