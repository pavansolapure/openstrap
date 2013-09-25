<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to openstrap_comment() which is
 * located in the functions.php file.
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
	
		<h3 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'openstrap' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>
		<ul class="media-list commentlist">
			<?php wp_list_comments( array( 'callback' => 'openstrap_comment', 'style' => 'ul' ) ); ?>
		</ul><!-- .commentlist -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'openstrap' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'openstrap' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'openstrap' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'openstrap' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
	
	
	
	<?php 	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$comment_args = array( 'title_reply'=>'Speak Your Mind',

	'fields' => apply_filters( 'comment_form_default_fields', 
				array(

				'author' => '<div class="form-group">
								<div class="row">
								<div class="col-md-7 col-xs-8">	
								<label class="control-label" for="focusedInput">Name ' . ($req ? '<span>*</span>' : '' ). '</label>									
								<input class="form-control" id="focusedInput" type="text" name="author" placeholder="Enter your Name" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . '>
								</div>
								</div>												
							 </div>', 		

				'email' => '<div class="form-group">
								<div class="row">
								<div class="col-md-7 col-xs-8">	
								<label class="control-label" for="focusedInput">Email ' . ($req ? '<span>*</span>' : '' ). '</label>
								<input class="form-control" id="focusedInput" type="text" name="email" placeholder="Enter your Email" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . '>	
								</div>
								</div>	
							</div>', 		
							
				'url' => '<div class="form-group">
								<div class="row">
								<div class="col-md-7 col-xs-8">					
								<label class="control-label" for="focusedInput">Website ' .  '</label>
								<input class="form-control" id="focusedInput" type="text" name="url" placeholder="Enter your Website (Optional)" value="' . esc_attr( $commenter['comment_author_url'] ) . '"' . $aria_req . '>	
								</div>
								</div>									
							</div>', 	

		 ) ),
	
		'comment_field' => '<div class="form-group">
							<div class="row">
							<div class="col-md-11 col-xs-10">		
							<label class="control-label" for="focusedInput">Comment ' .  '</label>
							<textarea class="form-control" rows="6" id="textArea" name="comment"></textarea>			
							</div>
							</div>								
							</div>',	

		'comment_notes_after' => '<div class="row"><div class="col-md-11 col-xs-10"><span class="help-block"><pre><strong>XHTML:</strong> You can use these tags: <code>'. allowed_tags() .'</code></pre></span></div></div>',

	);
?>

<?php if(comments_open()): ?>
<div class="panel panel-default" role="commentform" id="respond">
<div class="col-md-12">
<?php	
	comment_form($comment_args); 
?>
</div>
</div> <!--.panel commentform-->
<?php endif; ?>
</div><!-- #comments .comments-area -->