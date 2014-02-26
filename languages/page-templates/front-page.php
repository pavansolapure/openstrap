<?php
/**
 * Template Name: Front Page Without Slider Template
 *
 * Page template for Front Page
 *
 * @package Openstrap
 * @since Openstrap 0.1
 */

get_header(); ?>

<?php
	$divclass = (of_get_option('front_page_widget_section_count')=='4') ? '3' : '4';
	$imagepath =  get_template_directory_uri() . '/images/';
?>

	<?php if(of_get_option('display_blurb') == '1'): ?>	
	<!--blurb-->
	<div class="col-md-12">
	<div class="jumbotron">	 
		<h1><?php echo of_get_option('blurb_heading'); ?></h1>
		<p class="lead"><?php echo of_get_option('blurb_text'); ?></p>
		<?php if(of_get_option('display_blurb_button') == '1'): ?>	
		<p><a class="btn btn-success btn-lg" href="<?php echo get_permalink( of_get_option('blurb_button_link_page')); ?>"><?php echo of_get_option('blurb_button_title'); ?></a></p>	 
		<?php endif; ?>	
	</div>
	</div>
	<!--/blurb-->
	<?php endif; ?>	
		
	<div class="col-md-<?php echo $divclass; ?>">
	<?php if ( is_active_sidebar( 'openstrap_front_page_one' ) ) : ?>
	<?php dynamic_sidebar( 'openstrap_front_page_one' ); ?>	
	<?php endif; ?>	
	</div>

	<div class="col-md-<?php echo $divclass; ?>">
	<?php if ( is_active_sidebar( 'openstrap_front_page_two' ) ) : ?>
	<?php dynamic_sidebar( 'openstrap_front_page_two' ); ?>	
	<?php endif; ?>	
	</div>

	<div class="col-md-<?php echo $divclass; ?>">
	<?php if ( is_active_sidebar( 'openstrap_front_page_three' ) ) : ?>
	<?php dynamic_sidebar( 'openstrap_front_page_three' ); ?>	
	<?php endif; ?>	
	</div>
	
	<?php if($divclass=='3'): ?>
	<div class="col-md-<?php echo $divclass; ?>">
	<?php if ( is_active_sidebar( 'openstrap_front_page_four' ) ) : ?>
	<?php dynamic_sidebar( 'openstrap_front_page_four' ); ?>	
	<?php endif; ?>	
	</div>
	<?php endif; ?>			

<?php get_footer(); ?>