<?php
/**
 * Openstrap functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Openstrap supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Openstrap 0.1
 */
function openstrap_setup() {

	// Load up our theme options page and related code. Options Framework	
	require_once(get_template_directory() . '/inc/options-panel.php');
	
	/*
	 * Makes Openstrap available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Openstrap, use a find and replace
	 * to change 'openstrap' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'openstrap', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'openstrap' ) );	
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'openstrap' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'openstrap' ) );

	
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop	

}
add_action( 'after_setup_theme', 'openstrap_setup' );

//Google Custom Search Widget
require(get_template_directory() . '/inc/widgets/openstrap-google-cse-widget.php');

//Social Icon Box
require(get_template_directory() . '/inc/widgets/openstrap-social-box-widget.php');

//Front Page Text
require(get_template_directory() . '/inc/widgets/openstrap-front-page-text.php');


//Feedburner Subscription
require(get_template_directory() . '/inc/widgets/openstrap-feedburner-widget.php');

function openstrap_load_custom_widgets() {
	register_widget( 'openstrap_googlecse_widget' );	
	register_widget( 'openstrap_socialiconbox_widget' );	
	register_widget( 'openstrap_frontpage_text_widget' );	
	register_widget( 'openstrap_feedburner_subscription_widget' );	
}
add_action('widgets_init', 'openstrap_load_custom_widgets');


/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Openstrap 0.1
 */
function openstrap_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );


	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'openstrap-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'openstrap' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'openstrap' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		//wp_enqueue_style( 'openstrap-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}

	// Load JavaScripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.0.0', true );		


	
	// Load Stylesheets. Load bootstrap css as per theme option selected
	$theme_style = of_get_option('theme_style');	
	if($theme_style=="default") {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css' );
		wp_enqueue_style( 'bootstrap-custom', get_template_directory_uri().'/css/custom.css' );
	} else {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/'.$theme_style.'/bootstrap.css' );
		wp_enqueue_style( 'bootstrap-custom', get_template_directory_uri().'/css/'.$theme_style.'/custom.css' );
	}
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );	

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'openstrap-ie', get_template_directory_uri() . '/css/font-awesome-ie7.min.css');
	$wp_styles->add_data( 'openstrap-ie', 'conditional', 'lt IE 9' );		
	
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		//WooCommerce
		wp_register_style('custom-woocommerce', get_template_directory_uri() . '/css/custom-woocommerce.css', array( 'openstrap-style','woocommerce_frontend_styles'));
		wp_enqueue_style('custom-woocommerce');
	}		
	
	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'openstrap-style', get_stylesheet_uri() );	

}
add_action( 'wp_enqueue_scripts', 'openstrap_scripts_styles' );

// queue up the necessary js
function openstrap_admin_scripts($hooks)
{
	if ( 'widgets.php' == $hooks ) {
		wp_enqueue_media();			
		wp_enqueue_script( 'openstrap-widgets', get_template_directory_uri() . '/js/widgets.js', array( 'jquery-ui-sortable' ) );			
	}
}
add_action('admin_enqueue_scripts', 'openstrap_admin_scripts');

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Openstrap 0.1
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function openstrap_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'openstrap' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'openstrap_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Openstrap 0.1
 */
function openstrap_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'openstrap_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Openstrap 0.1
 */
function openstrap_widgets_init() {

	// Header Right
	register_sidebar( array(
			'id' => 'openstrap_header_right',
			'name' => __( 'Header Right', 'openstrap' ),
			'description' => __( 'This sidebar is located on the right-hand side of header area.', 'openstrap' ),
			'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="header-widget-title">',
			'after_title' => '</h4>',
		) );
		
	// Sidebar Right
	register_sidebar( array(
			'id' => 'openstrap_sidebar_right',
			'name' => __( 'Sidebar Right', 'openstrap' ),
			'description' => __( 'This sidebar is located on the right-hand side of each page. This is Default Side bar.', 'openstrap' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		
	// Sidebar Left
	register_sidebar( array(
			'id' => 'openstrap_sidebar_left',
			'name' => __( 'Sidebar Left', 'openstrap' ),
			'description' => __( 'This sidebar is located on the left-hand side of each page.', 'openstrap' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );		
		
	// Sidebar Footer
	register_sidebar( array(
			'id' => 'extended_footer_one',
			'name' => __( 'Footer One', 'openstrap' ),
			'description' => __( 'This sidebar is located on Footer and its First section. Occupies 4 Columns out of 12.', 'openstrap' ),
			'before_widget' => '<div class="row"><div class="col-md-12 footer-widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="footer-widget-title">',
			'after_title' => '</h4>',
		) );	
	// Sidebar Footer
	register_sidebar( array(
			'id' => 'extended_footer_two',
			'name' => __( 'Footer Two', 'openstrap' ),
			'description' => __( 'This sidebar is located on Footer and its Second section.Occupies 4 Columns out of 12.', 'openstrap' ),
			'before_widget' => '<div class="row"><div class="col-md-12 footer-widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="footer-widget-title">',
			'after_title' => '</h4>',
		) );
	// Sidebar Footer
	register_sidebar( array(
			'id' => 'extended_footer_three',
			'name' => __( 'Footer Three', 'openstrap' ),
			'description' => __( 'This sidebar is located on Footer and its Third section. Occupies 4 Columns out of 12.', 'openstrap' ),
			'before_widget' => '<div class="row"><div class="col-md-12 footer-widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="footer-widget-title">',
			'after_title' => '</h4>',
		) );		
	
	if(of_get_option('extended_footer_count')=='4') {
			register_sidebar( array(
			'id' => 'extended_footer_four',
			'name' => __( 'Footer Four', 'openstrap' ),
			'description' => __( 'This sidebar is located on Footer and its Third section. Occupies 4 Columns out of 12.', 'openstrap' ),
			'before_widget' => '<div class="row"><div class="col-md-12 footer-widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="footer-widget-title">',
			'after_title' => '</h4>',
		) );
	} else {
		unregister_sidebar( 'extended_footer_four' );
	}	
	
	//Front Page Widget Section	
	register_sidebar( array(
		'id' => 'openstrap_front_page_one',
		'name' => __( 'Front Page Widget One', 'openstrap' ),
		'description' => __( 'This widget area is active only on frontpage and first widget.', 'openstrap' ),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="front-page-widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'id' => 'openstrap_front_page_two',
		'name' => __( 'Front Page Widget Two', 'openstrap' ),
		'description' => __( 'This widget area is active only on frontpage and second widget.', 'openstrap' ),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="front-page-widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'id' => 'openstrap_front_page_three',
		'name' => __( 'Front Page Widget Three', 'openstrap' ),
		'description' => __( 'This widget area is active only on frontpage and third widget.', 'openstrap' ),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="front-page-widget-title">',
		'after_title' => '</h4>',
	) );

	if(of_get_option('front_page_widget_section_count')=='4') {
	register_sidebar( array(
		'id' => 'openstrap_front_page_four',
		'name' => __( 'Front Page Widget Four', 'openstrap' ),
		'description' => __( 'This widget area is active only on frontpage and fourth widget.', 'openstrap' ),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="front-page-widget-title">',
		'after_title' => '</h4>',
	) );	
	} else {
		unregister_sidebar( 'openstrap_front_page_four' );
	}	

	
}
add_action( 'widgets_init', 'openstrap_widgets_init' );

/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Openstrap 0.1
 */
function openstrap_content_nav( $html_id ) {
	//Call Custom Pagination here instead of calling it on each and every page where its required
	openstrap_custom_pagination();	
}


add_filter('get_avatar','openstrap_change_avatar_css');

function openstrap_change_avatar_css($class) {
$class = str_replace("class='avatar", "class='media-object avatar", $class) ;
return $class;
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own openstrap_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Openstrap 0.1
 */

function openstrap_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'openstrap' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'openstrap' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	
	<li <?php comment_class("media"); ?> id="li-comment-<?php comment_ID(); ?>">
	<div class="panel panel-default">
		
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<a class="pull-left link-avatar" href="#">
			<?php echo get_avatar( $comment, 64 ); ?>
			</a>
			<div class="media-body">
			<p class="media-heading">		
				<?php printf( '<cite class="fn">%1$s %2$s</cite>',
							  get_comment_author_link(),
							  // If current post author is also comment author, make it known visually.
							 ( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'openstrap' ) . '</span>' : '');
				?>				
				<?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'openstrap' ), get_comment_date(), get_comment_time() ));
				?>
			</p>
		 	<?php if ( '0' == $comment->comment_approved ) : ?>
				<div class="alert alert-warning">
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'openstrap' ); ?></p>
				</div>	
			<?php endif; ?>

			<div class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'openstrap' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'openstrap' ), 'after' => ' <span>&rarr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div>		
		
	
		</article><!-- #comment-## -->

	<?php
		break;
	endswitch; // end comment_type check
}
 

/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own openstrap_entry_meta() to override in a child theme.
 *
 * @since Openstrap 0.1
 */
function openstrap_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'openstrap' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'openstrap' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'openstrap' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'openstrap' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'openstrap' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'openstrap' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}


/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Openstrap 0.1
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function openstrap_body_class( $classes ) {
	$background_color = get_background_color();

	if (is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/front-page-2.php' )) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
	}
	
	if ( is_active_sidebar( 'openstrap_sidebar_right' ) && is_active_sidebar( 'openstrap_sidebar_left' ) )
		$classes[] = 'two-sidebars';	

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'openstrap-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';
		
	$body_background = of_get_option('body_background');
	if(!empty($body_background))
		$classes[] = 'openstrap-custom-background';			

	return $classes;
}
add_filter( 'body_class', 'openstrap_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Openstrap 0.1
 */
function openstrap_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'openstrap_sidebar_right' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'openstrap_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Openstrap 0.1
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function openstrap_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'openstrap_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Openstrap 0.1
 */
function openstrap_customize_preview_js() {
	wp_enqueue_script( 'openstrap-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'openstrap_customize_preview_js' );



class openstrap_theme_navigation extends Walker_Nav_Menu {

        /**
         * @see Walker::start_lvl()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of page. Used for padding.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
                $indent = str_repeat( "\t", $depth );
                $output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu\">\n";
        }

        /**
         * @see Walker::start_el()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param int $current_page Menu item ID.
         * @param object $args
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
                $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

                /**
                 * Dividers, Headers or Disabled
                 * =============================
                 * Determine whether the item is a Divider, Header, Disabled or regular
                 * menu item. To prevent errors we use the strcasecmp() function to so a
                 * comparison that is not case sensitive. The strcasecmp() function returns
                 * a 0 if the strings are equal.
                 */
                if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
                        $output .= $indent . '<li role="presentation" class="divider">';
                } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
                        $output .= $indent . '<li role="presentation" class="divider">';
                } else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
                        $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
                } else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
                        $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
                } else {

                        $class_names = $value = '';

                        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                        $classes[] = 'menu-item-' . $item->ID;

                        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

                        if ( $args->has_children ) {
							if ( $depth === 0 )
                                $class_names .= ' dropdown';
							else
								$class_names .= ' dropdown-submenu';
						}		

                        if ( in_array( 'current-menu-item', $classes ) )
                                $class_names .= ' active';

                        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

                        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
                        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

                        $output .= $indent . '<li' . $id . $value . $class_names .'>';

                        $atts = array();
                        $atts['title']  = ! empty( $item->attr_title )        ? $item->attr_title        : '';
                        $atts['target'] = ! empty( $item->target )        ? $item->target        : '';
                        $atts['rel']    = ! empty( $item->xfn )                ? $item->xfn        : '';

                        // If item has_children add atts to a.
                        if ( $args->has_children) {
                                //$atts['href']                   = '#';
								$atts['href'] = ! empty( $item->url ) ? $item->url : '#';
                                $atts['data-toggle']        = 'dropdown';
                                $atts['class']                        = 'dropdown-toggle';
                        } else {
                                $atts['href'] = ! empty( $item->url ) ? $item->url : '';
                        }

                        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

                        $attributes = '';
                        foreach ( $atts as $attr => $value ) {
                                if ( ! empty( $value ) ) {
                                        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                                        $attributes .= ' ' . $attr . '="' . $value . '"';
                                }
                        }

                        $item_output = $args->before;

                        /*
                         * Glyphicons
                         * ===========
                         * Since the the menu item is NOT a Divider or Header we check the see
                         * if there is a value in the attr_title property. If the attr_title
                         * property is NOT null we apply it as the class name for the glyphicon.
                         */
                        if ( ! empty( $item->attr_title ) )
                                $item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
                        else
                                $item_output .= '<a'. $attributes .'>';

                        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                        $item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
                        $item_output .= $args->after;

                        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
                }
        }

        /**
         * Traverse elements to create list from elements.
         *
         * Display one element if the element doesn't have any children otherwise,
         * display the element and its children. Will only traverse up to the max
         * depth and no ignore elements under that depth.
         *
         * This method shouldn't be called directly, use the walk() method instead.
         *
         * @see Walker::start_el()
         * @since 2.5.0
         *
         * @param object $element Data object
         * @param array $children_elements List of elements to continue traversing.
         * @param int $max_depth Max depth to traverse.
         * @param int $depth Depth of current element.
         * @param array $args
         * @param string $output Passed by reference. Used to append additional content.
         * @return null Null on failure with no changes to parameters.
         */
        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

        /**
         * Menu Fallback
         * =============
         * If this function is assigned to the wp_nav_menu's fallback_cb variable
         * and a manu has not been assigned to the theme location in the WordPress
         * menu manager the function with display nothing to a non-logged in user,
         * and will add a link to the WordPress menu manager if logged in as an admin.
         *
         * @param array $args passed from the wp_nav_menu function.
         *
         */
        public static function fallback( $args ) {
                if ( current_user_can( 'manage_options' ) ) {

                        extract( $args );

                        $fb_output = null;

                        if ( $container ) {
                                $fb_output = '<' . $container;

                                if ( $container_id )
                                        $fb_output .= ' id="' . $container_id . '"';

                                if ( $container_class )
                                        $fb_output .= ' class="' . $container_class . '"';

                                $fb_output .= '>';
                        }

                        $fb_output .= '<ul';

                        if ( $menu_id )
                                $fb_output .= ' id="' . $menu_id . '"';

                        if ( $menu_class )
                                $fb_output .= ' class="' . $menu_class . '"';

                        $fb_output .= '>';
                        $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
                        $fb_output .= '</ul>';

                        if ( $container )
                                $fb_output .= '</' . $container . '>';

                        echo $fb_output;
                }
        }
}


function openstrap_nav_menu_css_class( $classes ) {
	if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) )
		$classes[]	=	'active';

	return $classes;
}
add_filter( 'nav_menu_css_class', 'openstrap_nav_menu_css_class' );

// Create a graceful fallback to wp_page_menu
function openstrap_theme_page_menu() {

	$args = array(
	'sort_column' => 'menu_order, post_title',
	'menu_class'  => 'navbar-link',
	'include'     => '',
	'exclude'     => '',
	'echo'        => true,
	'show_home'   => false,
	'link_before' => '',
	'link_after'  => '',
	'items_wrap' => ''
	);

	wp_page_menu($args);
}

function openstrap_custom_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  
	 
     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination-centered'><ul class=\"pagination\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         //if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Prev</a></li>";		 
		 if($paged > 1 && $showitems < $pages) echo "<li>".get_previous_posts_link("&lsaquo; Prev")."</li>";	 		 

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='active'><a href=''>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }
		 
		 if ($paged < $pages && $showitems < $pages) echo "<li>".get_next_posts_link("Next &rsaquo;")."</li>";
         //if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>Next &rsaquo;</a></</li>";  		 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "</ul></div> <!-- .pagination-centered -->";
     }
}	

function openstrap_wp_head() {
	$body_background = of_get_option('body_background');	
	$customcss = array();
	$bcss = '';
	if(!empty($body_background['color']) || !empty($body_background['image'])) {
		$bcss = 'body.openstrap-custom-background { background:';
		$bcss .= (!empty($body_background['color'])) ? " ".$body_background['color'] : '';
		$bcss .= (!empty($body_background['image'])) ? " url('".$body_background['image']."')" : '';
		$bcss .= (!empty($body_background['image']) && !empty($body_background['repeat'])) ? " ".$body_background['repeat'] : '';
		$bcss .= (!empty($body_background['image']) && !empty($body_background['attachment'])) ? " ".$body_background['attachment'] : '';
		$bcss .= (!empty($body_background['image']) && !empty($body_background['position'])) ? " ".$body_background['position'] : '';
		$bcss .= ';}';
		$customcss[] = $bcss;
	}
	
	$header_background = of_get_option('site_header_background');	
	if(!empty($header_background['color']) || !empty($header_background['image'])) {
		$bcss = '.site-header .header-body { background:';
		$bcss .= (!empty($header_background['color'])) ? " ".$header_background['color'] : '';
		$bcss .= (!empty($header_background['image'])) ? " url('".$header_background['image']."')" : '';
		$bcss .= (!empty($header_background['image']) && !empty($header_background['repeat'])) ? " ".$header_background['repeat'] : '';
		$bcss .= (!empty($header_background['image']) && !empty($header_background['attachment'])) ? " ".$header_background['attachment'] : '';
		$bcss .= (!empty($header_background['image']) && !empty($header_background['position'])) ? " ".$header_background['position'] : '';
		$bcss .= ';}';	
		$customcss[] = $bcss;
	}
	
	$display_nav_on_mouse_click = of_get_option('display_nav_on_mouse_click');	
	if($display_nav_on_mouse_click ==0) {
	?>
	<style type="text/css"> 	
	@media (min-width: 768px) {
	/* Required to make menu appear on mouse hover. */
	ul.nav li.dropdown:hover > ul.dropdown-menu{
	display: block;    
	}

	ul.nav li.dropdown > ul.dropdown-menu li.dropdown-submenu:hover > ul.dropdown-menu {
	display: block;    
	}
	}
	</style>		
	<?php
	}
	
	if(!empty($customcss)) { ?>
	<style type="text/css" media="all"> 
	<?php 
		$cnt = count($customcss);
		foreach($customcss as $index => $css) {
			echo $css;
			if($index < $cnt-1) echo "\r\n";
		}
	?> 
	</style>	
	<?php }	


	if(of_get_option('add_code_in_wp_head') == '1'):
		if('' != trim(of_get_option('code_for_wp_head'))):			
			?><style type="text/css" media="all"> <?php echo of_get_option('code_for_wp_head'); ?></style>
			<?php
		endif;
	endif;
	
	$theme_layout = of_get_option('theme_layout'); 
	if("boxed" == $theme_layout) {
	?>
	<style type="text/css" media="all"> #bodychild{width:90%;}</style><?php	
	}
}
add_action( 'wp_head', 'openstrap_wp_head',100);


function openstrap_wp_footer() {
	if(of_get_option('add_code_in_wp_footer') == '1'):
		if('' != trim(of_get_option('code_for_wp_footer'))):?>
		<script type='text/javascript'>
			<?php echo of_get_option('code_for_wp_footer'); ?>
		</script>
		<?php endif;
	endif;

	?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.min.js" type="text/javascript"></script>
	<![endif]-->
	<!-- Bootstrap 3 dont have core support to multilevel menu, we need this JS to implement that -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/theme-menu.js" type="text/javascript"></script>
	<script type='text/javascript'>
		jQuery.noConflict();
	</script>	
	<?php 
		$make_parent_menu_clickable = of_get_option('make_parent_menu_clickable');
		if($make_parent_menu_clickable==1):		
		?>
		<script type='text/javascript'>
			jQuery( "a.dropdown-toggle" ).on( "click", function( event ) {
				event.preventDefault();
				jQuery(location).attr('href', jQuery(this).attr("href"));
			});		
		</script>
		<?php
		endif;
		//Add this piece of JS only when Slider/carousel template is used.
		if(is_front_page() || is_page_template('page-templates/front-page-2.php')):		
		$slider_interval = (of_get_option('slider_interval') > 0) ? of_get_option('slider_interval') : 2500;;
		$pause_on_hover = (of_get_option('pause_on_hover')=='1') ? "hover" : "none";
		?>
		<script type='text/javascript'>		
		jQuery(document).ready(function(){
			jQuery('.carousel').carousel({ interval: <?php echo $slider_interval; ?>, cycle: true, wrap: true, pause:"<?php echo $pause_on_hover;?>" });	
		});				
		</script>
		<?php	
		endif;
}
add_action( 'wp_footer', 'openstrap_wp_footer',100);

add_filter('the_excerpt','openstrap_excerpt');
function openstrap_excerpt(){
	global $post;
	$link='<span class="readmore"><a href="'.get_permalink().'" > Continue reading &rarr;</a></span>';
	$excerpt=get_the_excerpt();		
	if ( preg_match('/<!--more(.*?)?-->/', $post->post_content) ) {	
		echo $excerpt.$link;
	} else {
		echo $excerpt;
	}
}

function openstrap_excerpt_read_more($text) {
   return '  <span><a href="'.get_permalink().'" class="readmore">Continue reading &rarr;</a></span>';
}
add_filter('excerpt_more', 'openstrap_excerpt_read_more');

function openstrap_custom_excerpt_length($length) {
	return 85;
}
add_filter('excerpt_length', 'openstrap_custom_excerpt_length');


function openstrap_get_branding() {	
	$note = "<span class=\"brand-note\"> | Design by <a href=\"http://www.opencodez.com/\" target=\"_blank\">Opencodez Themes</a></span>";
	return $note;
}


//Custom Functions for Widget area
function openstrap_widget_field( $widget, $args = array(), $value ) {
	$args = wp_parse_args($args, array ( 
		'field' => 'title',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'class' => 'widefat',
		'options' => array(),
		'label_all' => '',
		'ptag' => true,
		) );
	extract( $args, EXTR_SKIP );

	$field_id =  esc_attr( $widget->get_field_id( $field ) );
	$field_name = esc_attr( $widget->get_field_name( $field ) );
	
	if ( $ptag )
		echo '<p>';
	if ( ! empty( $label ) ) {
		echo '<label for="' . $field_id . '">';
		echo $label . '</label>';
	}
	switch ( $type ) {
		case 'media':
			echo '<input class="media-upload-url" id="' . $field_id;
			echo '" name="' . $field_name . '" type="hidden" value="';
			echo esc_attr( $value ) . '" />';
			echo '<input class="media-upload-btn" id="' . $field_id;
			echo '_btn" name="' . $field_name . '_btn" type="button" value="'. __( 'Choose', 'openstrap' ) . '">';
			echo '<input class="media-upload-del" id="' . $field_id;
			echo '_del" name="' . $field_name . '_del" type="button" value="'. __( 'Remove', 'openstrap' ) . '">';
			break;
		case 'text':
		case 'hidden':
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="' . $type .'" value="';
			echo esc_attr( $value ) . '" />';
			break;
		case 'url':
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="' . $type .'" value="';
			echo esc_url( $value ) . '" />';
			break;
		case 'textarea':
			echo '<textarea class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="' . $type .'" row="10" col="20">';
			echo esc_textarea( $value ) . '</textarea>';
			break;
		case 'number':
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="text" size="3" value="';
			echo esc_attr( $value ) . '" />';
			break;
		case 'checkbox':
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="' . $type .'" value="1" ';
			echo checked( '1', $value, false ) . ' /> ';
			echo '<label for="' . $field_id . '"> ' . $desc . '</label>';
			break;
		case 'label':
			echo '<label for="' . $field_id . '"> ' . $desc . '</label>';
			break;			
		case 'category':
			echo '<select id="' . $field_id . '" name="' . $field_name . '">';
			if ( ! empty( $label_all ) ) {
				if ( 0 == $value )
					$selected = 'selected="selected"';				
			 	else
				 	$selected = '';
			 	echo '<option value="0" ' . $selected;
			 	echo '>' . $label_all . '</option>';				
			}
			foreach ( $options as $option ) {
				if ( $option->term_id == $value )
					$selected = 'selected="selected"';
				else
					$selected = '';	
				echo '<option value="' . $option->term_id . '" ' . $selected;
				echo '>' . $option->name . '</option>';
			}
			echo '</select>';
			break;
		case 'select':
			echo '<select id="' . $field_id . '" name="' . $field_name . '">';
			foreach ( $options as $option ) {
				if ( $option['key'] == $value )
					$selected = 'selected="selected"';
				else
					$selected = '';	
				echo '<option value="' . $option['key'] . '" ' . $selected;
				echo '>' . $option['name'] . '</option>';
			}
			echo '</select>';
			break;			
		case 'icon-select':
			ksort($options, SORT_STRING);
			echo '<div class="icon-select"><select class="widget-icon widget-lib-font-awesome" id="' . $field_id . '" name="' . $field_name . '">';
			foreach ( $options as $k=>$v ) {
				if ( $k == $value )
					$selected = 'selected="selected"';
				else
					$selected = '';	
				echo '<option value="' . $k . '" ' . $selected. '>' . $v.'&nbsp;&nbsp;'.$k . '</option>';
			}
			echo '</select></div>';
			break;		

		// Color picker
		case "color":
			$default_color = '';
			echo '<input class="' . $class . '" id="' . $field_id;
			echo '" name="' . $field_name . '" type="text" value="';
			echo esc_attr( $value ) . '"'.$default_color.' />';			
 	
			break;			
	}
	if ( $ptag )
		echo '</p>';
}


function openstrap_thumbnail_array() {
	$sizes = array (
		array(	'key' => '',
				'name' => __( 'Thumbnail', 'openstrap' ) ),
		array(	'key' => 'medium',
				'name' => __( 'Medium', 'openstrap' ) ),
		array(	'key' => 'large',
				'name' => __( 'Large', 'openstrap' ) ),
		array(	'key' => 'full',
				'name' => __( 'Full', 'openstrap' ) ),
		array(	'key' => 'custom',
				'name' => __( 'Custom', 'openstrap' ) ),
		array(	'key' => 'none',
				'name' => __( 'None', 'openstrap' ) ),
	);
	global $_wp_additional_image_sizes;

	if ( isset( $_wp_additional_image_sizes ) )
		foreach( $_wp_additional_image_sizes as $name => $item) 
			$sizes[] = array( 'key' => $name, 'name' => $name );
	return apply_filters( 'openstrap_thumbnail_array', $sizes );
}

function openstrap_thumbnail_size( $option, $x = 96, $y = 96 ) {

	if ( empty( $option ) )
		return 'thumbnail';
	elseif ( 'custom' == $option ) {
		if (($x > 0) && ($y > 0) )
			return array( $x, $y);
		else
			return 'thumbnail';		
	}
	else 
		return $option;
}

function openstrap_get_sidebar_cols( ) {	
	$layout = of_get_option('page_layouts'); 
	$col = 3;	
	//theme puts default page, archive pages as 2 columns
	if($layout=="sidebar-content" || 
	   $layout=="content-sidebar" || 
	   is_page_template( 'page-templates/sidebar-content.php' ) || 
	   is_page_template( 'page-templates/content-sidebar.php' ))
	   {
			$wide_sidebar = of_get_option('wider_sidebar'); 
			$col = (empty($wide_sidebar)) ? 3 : 4;
		}
		
	if(is_page_template( 'page-templates/sidebar-content-sidebar.php' ) ||
	   is_page_template( 'page-templates/content-sidebar-sidebar.php' ) ||
	   is_page_template( 'page-templates/sidebar-sidebar-content.php' )) {
		$col = 3;
	}
	
	return $col;
}

function openstrap_get_content_cols( ) {	
	$wide_sidebar = of_get_option('wider_sidebar'); 
	
	$col = (empty($wide_sidebar)) ? 9 : 8;	
	$layout = of_get_option('page_layouts'); 
	
	if($layout=="sidebar-content" || 
	   $layout=="content-sidebar" || 
	   is_page_template( 'page-templates/sidebar-content.php' ) || 
	   is_page_template( 'page-templates/content-sidebar.php' ))
	   {			
			$col = (empty($wide_sidebar)) ? 9 : 8;
		}		
	else if(is_page_template( 'page-templates/sidebar-content-sidebar.php' ) ||
	   is_page_template( 'page-templates/content-sidebar-sidebar.php' ) ||
	   is_page_template( 'page-templates/sidebar-sidebar-content.php' ) ||
	   $layout == "sidebar-content-sidebar" || 
	   $layout == "content-sidebar-sidebar" 
	   || $layout == "sidebar-sidebar-content"
	   ) {
		$col = 6;
	}

	return $col;
}

require_once( get_template_directory() . '/inc/woocommerce-support.php' );
?>
