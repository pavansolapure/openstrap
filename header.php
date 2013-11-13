<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="bodychild">
	<!-- Wrap all page content here -->  
	<div id="wrap">	
	
	<?php 
		$site_logo = of_get_option('site_logo');
		$header =  get_header_textcolor();	
		$header_background = of_get_option('header_background');
		
		//check and get if any header image set from WP Settings
		$wp_header_image = get_header_image();		
		if(empty($header_background) && !empty($wp_header_image)):
			$header_background = get_header_image();
		endif;
		
	?>	
	<?php if ( $header !== "blank" ) : ?>
		<header class="site-header" role="banner" <?php if(!empty($header_background)): ?> style="background:url('<?php echo esc_url($header_background); ?>');" <?php endif;?>> 	
		<div id="header-top">
			<div class="container hidden-xs">
				<div class="pull-right"  id="header-top-container">
					<div class="pull-right">
					<?php 
						wp_nav_menu( array( 'theme_location' => 'secondary', 
											'menu_class' => 'list-inline', 
											'depth' =>1, 
											'container' => false, 
											'fallback_cb' => false ) ); 
					?>
					</div>
				</div>
			</div>			
		</div>	

		<div class="container">		
		 <div class="row logo-row">
		  <div class="col-md-4 pull-left">
			<?php if ( $site_logo != '' ) : ?>
			<a href="<?php echo esc_url( home_url( '/' )); ?>"><img src="<?php echo esc_url($site_logo); ?>" alt="<?php bloginfo('description'); ?>" class="img-responsive" /></a>
			<?php elseif($site_logo == '' || !isset($site_logo)): ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<small><?php bloginfo( 'description' ); ?></small>
			<?php endif; ?>					
		  </div>	  
		  <div class="col-md-8 hidden-xs">
			<div class="pull-right">
				<?php if ( is_active_sidebar( 'openstrap_header_right' ) ) : ?>
					<?php dynamic_sidebar( 'openstrap_header_right' ); ?>	
				<?php endif; ?>	
			</div>
		  </div>
		</div>	  
	
	</header>
	<?php endif; ?>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand visible-xs" href="<?php echo esc_url (home_url( '/' )); ?>"><i class="icon-home"></i></a>
        </div>
        <div class="navbar-collapse collapse">
		<?php wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'menu_class' => 'nav navbar-nav', 
							'depth' =>4,
							'container' => false, 
							'fallback_cb' => false, 
							'walker' => new openstrap_theme_navigation() ) ); ?>	
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
    <div class="container" id="main-container">
	<div class="row" id="main-row">

