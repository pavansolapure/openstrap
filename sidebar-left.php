<?php
/**
 * Sidebar Left
 *
 * Content for our sidebar, provides prompt for logged in users to create widgets
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */
?>

<?php $col =  openstrap_get_sidebar_cols(); ?>

<!-- Sidebar -->
<div class="col-md-<?php echo $col;?> sidebar-left" >

<?php if ( dynamic_sidebar('openstrap_sidebar_left') ) : elseif( current_user_can( 'edit_theme_options' ) ) : ?>

	<h5><?php _e( 'No widgets found.', 'openstrap' ); ?></h5>
	<p><?php printf( __( 'It seems you don\'t have any widgets in your sidebar! Would you like to %s now?', 'openstrap' ), '<a href=" '. get_admin_url( '', 'widgets.php' ) .' ">populate your sidebar</a>' ); ?></p>

<?php endif; ?>

</div>
<!-- End Sidebar -->