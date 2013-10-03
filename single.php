<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */

get_header(); ?>

<?php 
	$layout = of_get_option('page_layouts'); 
	$wide_sidebar = of_get_option('wider_sidebar'); 
	$col=9; 
	$side_bar_to_display = "right";
	if(isset($layout)) {
		switch($layout) {
			case "full-width":
				$col=12; 
				$side_bar_to_display = "none";
				break;
			case "sidebar-content":
				$col = (empty($wide_sidebar)) ? 9 : 8;
				//$col=9; 
				$side_bar_to_display = "left";
				break;
			case "content-sidebar":
				$col = (empty($wide_sidebar)) ? 9 : 8;
				//$col=9; 
				$side_bar_to_display = "right";
				break;
			case "content-sidebar-sidebar":	
			case "sidebar-sidebar-content":	
			case "sidebar-content-sidebar":	
				$col=6; 
				$side_bar_to_display = "both";	
				break;						
			default:
				$col = (empty($wide_sidebar)) ? 9 : 8;
				//$col=9; 
				$side_bar_to_display = "right";				
		}		
	}
?>

<?php	
	if($layout ==  "sidebar-sidebar-content") {
		get_sidebar('left');
		get_sidebar();
	} else if($layout ==  "sidebar-content-sidebar" || $layout ==  "sidebar-content") {
		get_sidebar('left');
	}
?>

<div class="col-md-<?php echo $col;?>" role="content">
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div> <!-- .col-md-<?php echo $col;?> .content -->	

<?php
	if($layout ==  "content-sidebar-sidebar") {
		get_sidebar('left');
		get_sidebar();
	} else if($layout ==  "sidebar-content-sidebar" || $layout ==  "content-sidebar") {
		get_sidebar();
	}	
?>
<?php get_footer(); ?>