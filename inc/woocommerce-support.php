<?php
/*-----------------------------------------------------------------------------------*/
/* WooCommerce
/*-----------------------------------------------------------------------------------*/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	add_theme_support('woocommerce');

	register_sidebar( array(
			'id' => 'openstrap_shop_sidebar',
			'name' => __( 'Shop Page Sidebar', 'openstrap' ),
			'description' => __( 'This sidebar is located on the right-hand side of Shop Page.', 'openstrap' ),
			'before_widget' => '<div id="%1$s" class="woocommerce-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="woocommerce-widget-title">',
			'after_title' => '</h4>',
		) );

	register_sidebar( array(
			'id' => 'openstrap_single_product_sidebar',
			'name' => __( 'Single Product Sidebar', 'openstrap' ),
			'description' => __( 'This sidebar is located on the right-hand side of Single Product Page.', 'openstrap' ),
			'before_widget' => '<div id="%1$s" class="woocommerce-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="woocommerce-widget-title">',
			'after_title' => '</h4>',
		) );	
		


// Change number or products per row to 4
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4; // 4 products per row
	}
}

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
woocommerce_related_products(5,1); // Display 3 products in rows of 1
}

/*** Hook in on activation */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'openstrap_woocommerce_image_dimensions', 1 );
 
/*** Define image sizes */
function openstrap_woocommerce_image_dimensions() {

  	$catalog = array(
		'width' 	=> '150',
		'height'	=> '150',
		'crop'		=> 1
	);
	$single = array(
		'width' 	=> '300',
		'height'	=> '300',
		'crop'		=> 1
	);
	$thumbnail = array(
		'width' 	=> '75',
		'height'	=> '75',
		'crop'		=> 1
	); 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_filter ( 'woocommerce_product_thumbnails_columns', 'openstrap_thumb_cols' );
 function openstrap_thumb_cols() {
     return 4; // .last class applied to every 4th thumbnail
 }
 
add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' );
 
/**
 * woo_custom_product_searchform
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function woo_custom_product_searchform( $form ) {
	$form = '<form class="form-inline" role="form" method="get" id="searchform" action="'.esc_url( home_url( '/' ) ).'">	
		<div class="input-group">
		<input type="text" class="form-control" name="s" id="s" placeholder="'.__( 'Search Products..', 'openstrap' ).'">
		<input type="hidden" name="post_type" value="product" />
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">'.__( 'Search', 'openstrap' ).'</button>
		</span>
		</div>
	</form>';		
	return $form;	
} 
}

?>