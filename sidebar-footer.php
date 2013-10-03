<?php
/**
 * The Footer widget areas.
 *
 * @package Openstrap
 * @since Openstrap 0.1
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'extended_footer_one'  )
		&& ! is_active_sidebar( 'extended_footer_two' )
		&& ! is_active_sidebar( 'extended_footer_three'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
	$divclass = (of_get_option('extended_footer_count')=='4') ? '3' : '4';
?>

<div id="extended-footer">	
	<div class="container">		
		<div class="row">		
			<div class="col-md-<?php echo $divclass; ?>">
				<?php if ( is_active_sidebar( 'extended_footer_one' ) ) : ?>
				<?php dynamic_sidebar( 'extended_footer_one' ); ?>	
				<?php endif; ?>	
			</div>		
			
			<div class="col-md-<?php echo $divclass; ?>">
				<?php if ( is_active_sidebar( 'extended_footer_two' ) ) : ?>
				<?php dynamic_sidebar( 'extended_footer_two' ); ?>
				<?php endif; ?>
			</div>

			<div class="col-md-<?php echo $divclass; ?>">
				<?php if ( is_active_sidebar( 'extended_footer_three' ) ) : ?>
				<?php dynamic_sidebar( 'extended_footer_three' ); ?>
				<?php endif; ?>
			</div>		
			
			<?php if($divclass=='3'): ?>	
				<div class="col-md-<?php echo $divclass; ?>">
				<?php if ( is_active_sidebar( 'extended_footer_four' ) ) : ?>
				<?php dynamic_sidebar( 'extended_footer_four' ); ?>
				<?php endif; ?>
				</div>
			<?php endif; ?>				
		</div>
	</div>
</div>


