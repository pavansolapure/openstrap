<?php 
	$col =  openstrap_get_sidebar_cols(); 
	$col = 3;
?>

<!-- Sidebar -->
<div class="col-md-<?php echo $col;?> sidebar-left" >

<?php if ( dynamic_sidebar('openstrap_shop_sidebar') ) : elseif( current_user_can( 'edit_theme_options' ) ) : ?>

	<h5><?php _e( 'No widgets found.', 'openstrap' ); ?></h5>
	<p><?php printf( __( 'It seems you don\'t have any widgets in your sidebar! Would you like to %s now?', 'openstrap' ), '<a href=" '. get_admin_url( '', 'widgets.php' ) .' ">populate your sidebar</a>' ); ?></p>

<?php endif; ?>

</div>
<!-- End Sidebar -->
