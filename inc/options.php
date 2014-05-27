<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$theme_footer_widgets = array(
		'3' => __('Three', 'options_check'),
		'4' => __('Four', 'options_check')
	);
	
	$theme_layout_array = array(
		'boxed' => __('Boxed', 'options_check'),
		'wide' => __('Wide', 'options_check')
	);
	
	$wider_sidebar = array(
		'1' => __('Yes', 'options_check'),
		'0' => __('No', 'options_check')
	);	

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	
	$imagepath =  get_template_directory_uri() . '/inc/admin/images/';

	$options = array();
	
	//Settings for Basic Settings Tab
	$options[] = array(
		'name' => __('Basic Settings', 'options_check'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => "Theme Style",
		'desc' => "These are the beautiful color theme styles you can choose from for your website.",
		'id' => "theme_style",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'default-style.png',
			'style1' => $imagepath . 'style1.png',
			'style2' => $imagepath . 'style2.png',
			'style3' => $imagepath . 'style3.png')
	);			
	
	$options[] = array(
		'name' =>  __('Header Background', 'options_check'),
		'desc' => __('Change the header background CSS. Recommended Sizes 1216x105', 'options_check'),
		'id' => 'site_header_background',
		'std' => $background_defaults,
		'type' => 'background' );		
		
	$options[] = array(
		'name' =>  __('Body Background', 'options_check'),
		'desc' => __('Change the body background CSS.', 'options_check'),
		'id' => 'body_background',
		'std' => $background_defaults,
		'type' => 'background' );		
		
	$options[] = array(
		'name' => __('Site Logo', 'options_check'),
		'desc' => __('If set this will be used as your sites logo. Recommended Sizes 200x99, 250x99', 'options_check'),
		'id' => 'site_logo',
		'type' => 'upload');			
		
	$options[] = array(
		'name' => __('Theme Layout', 'options_check'),
		'desc' => __('This option allows you to set theme layout Boxed or Full Width/Wide.', 'options_check'),
		'id' => 'theme_layout',
		'std' => 'Boxed',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $theme_layout_array);			
		
	$options[] = array(
		'name' => "Page Layout",
		'desc' => "These are layouts for your posts & archive. Pages will follow different templates that are available in template dropdown.",
		'id' => "page_layouts",
		'std' => "content-sidebar",
		'type' => "images",
		'options' => array(
			'full-width' => $imagepath . 'full-width.png',
			'sidebar-content' => $imagepath . 'sidebar-content.png',
			'content-sidebar' => $imagepath . 'content-sidebar.png',
			'sidebar-content-sidebar' => $imagepath . 'sidebar-content-sidebar.png',
			'sidebar-sidebar-content' => $imagepath . 'sidebar-sidebar-content.png',
			'content-sidebar-sidebar' => $imagepath . 'content-sidebar-sidebar.png')
	);		
	
	$options[] = array(
		'name' => __('Wider Sidebar', 'options_check'),
		'desc' => __('If this option is set to Yes, the sidebar will be little wider. This setting is applicable on 2 column layout only.', 'options_check'),
		'id' => 'wider_sidebar',
		'std' => 'No',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $wider_sidebar);		
	
	
	
	$options[] = array(
		'name' => __('Widget Areas in Extended Footer', 'options_check'),
		'desc' => __('This option allows you to set how many widget areas you want in footer. Default is 3.', 'options_check'),
		'id' => 'extended_footer_count',
		'std' => '3',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $theme_footer_widgets);			
	

	$options[] = array(
		'name' => __('Copyright Text', 'options_check'),
		'desc' => __('Your sites copyright statement.', 'options_check'),
		'id' => 'copyright_text',
		'std' => '&copy; All rights reserved.',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Header Contact Phone', 'options_check'),
		'desc' => __('Your contact phone will be displayed on header top left area.', 'options_check'),
		'id' => 'header_contact_phone',
		'std' => '',
		'type' => 'text');		
		
	$options[] = array(
		'name' => __('Header Contact Mail', 'options_check'),
		'desc' => __('Your contact mail will be displayed on header top left area.', 'options_check'),
		'id' => 'header_contact_mail',
		'std' => '',
		'type' => 'text');				
		
	$options[] = array(
		'name' => __('Front Page Settings', 'options_check'),
		'type' => 'heading');	
		
	$options[] = array(
		'name' => __('Settings for Slider on Home page. (This is displayed on Front Page template with Slider Only.)', 'options_check'),
		'desc' => __('Check to display Slider. Defaults to False.', 'options_check'),
		'id' => 'display_slider',
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Slider Speed', 'options_check'),
		'desc' => __('Set Slider Interval (in miliseconds).', 'options_check'),
		'id' => 'slider_interval',
		'std' => '2500',
		'type' => 'text');		

	$options[] = array(
		'name' => __('Slider Pause on Mouse Hover', 'options_check'),
		'desc' => __('Check if you want Slider to pause on mouse hover.', 'options_check'),
		'id' => 'pause_on_hover',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		'name' => __('Slider Image 1', 'options_check'),
		'desc' => __('Set image for slider. Preferred size 1170x500', 'options_check'),
		'id' => 'slider_img_1',
		'type' => 'upload');
		
	$options[] = array(		
		'desc' => __('Heading of Image 1.', 'options_check'),
		'id' => 'slider_image_heading_1',
		'std' => 'Heading 1',
		'type' => 'text');		
		
	$options[] = array(		
		'desc' => __('Caption of Image 1.', 'options_check'),
		'id' => 'slider_image_caption_1',
		'std' => 'Caption 1',
		'type' => 'textarea');		

	$options[] = array(		
		'desc' => __('Set title for Button.', 'options_check'),
		'id' => 'slider_image_button_1',
		'std' => 'Learn more',
		'type' => 'text');		
		
	$options[] = array(		
		'desc' => __('Link for Button', 'options_check'),
		'id' => 'slider_image_button_1_link',
		'type' => 'select',
		'options' => $options_pages);		

	$options[] = array(
		'name' => __('Slider Image 2', 'options_check'),
		'desc' => __('Set image for slider. Preferred size 1170x500', 'options_check'),
		'id' => 'slider_img_2',
		'type' => 'upload');
		
	$options[] = array(		
		'desc' => __('Heading of Image 2.', 'options_check'),
		'id' => 'slider_image_heading_2',
		'std' => 'Heading 2',
		'type' => 'text');			
		
	$options[] = array(		
		'desc' => __('Caption of Image 2.', 'options_check'),
		'id' => 'slider_image_caption_2',
		'std' => 'Caption 2',
		'type' => 'textarea');		
		
	$options[] = array(		
		'desc' => __('Set title for Button.', 'options_check'),
		'id' => 'slider_image_button_2',
		'std' => 'Learn more',
		'type' => 'text');		
		
	$options[] = array(		
		'desc' => __('Link for Button', 'options_check'),
		'id' => 'slider_image_button_2_link',
		'type' => 'select',
		'options' => $options_pages);			

	$options[] = array(
		'name' => __('Slider Image 3', 'options_check'),
		'desc' => __('Set image for slider. Preferred size 1170x500', 'options_check'),
		'id' => 'slider_img_3',
		'type' => 'upload');	

	$options[] = array(		
		'desc' => __('Heading of Image 3.', 'options_check'),
		'id' => 'slider_image_heading_3',
		'std' => 'Heading 3',
		'type' => 'text');			
		
	$options[] = array(		
		'desc' => __('Caption of Image 3.', 'options_check'),
		'id' => 'slider_image_caption_3',
		'std' => 'Caption 3',
		'type' => 'textarea');		

	$options[] = array(		
		'desc' => __('Set title for Button.', 'options_check'),
		'id' => 'slider_image_button_3',
		'std' => 'Learn more',
		'type' => 'text');		
		
	$options[] = array(		
		'desc' => __('Link for Button', 'options_check'),
		'id' => 'slider_image_button_3_link',
		'type' => 'select',
		'options' => $options_pages);		
		
	$options[] = array(
		'name' => __('Slider Image 4', 'options_check'),
		'desc' => __('Set image for slider. Preferred size 1170x500', 'options_check'),
		'id' => 'slider_img_4',
		'type' => 'upload');	

	$options[] = array(		
		'desc' => __('Heading of Image 4.', 'options_check'),
		'id' => 'slider_image_heading_4',
		'std' => 'Heading 4',
		'type' => 'text');			
		
	$options[] = array(		
		'desc' => __('Caption of Image 4.', 'options_check'),
		'id' => 'slider_image_caption_4',
		'std' => 'Caption 4',
		'type' => 'textarea');		
		
	$options[] = array(		
		'desc' => __('Set title for Button.', 'options_check'),
		'id' => 'slider_image_button_4',
		'std' => 'Learn more',
		'type' => 'text');		
		
	$options[] = array(		
		'desc' => __('Link for Button', 'options_check'),
		'id' => 'slider_image_button_4_link',
		'type' => 'select',
		'options' => $options_pages);		
		
	$options[] = array(
		'name' => __('Blurb Settings - Following section allows you to configure your blurb on front page.', 'options_check'),
		'desc' => __('<b>Following section will allow you to set text and button settings</b>', 'options_check'),
		'type' => 'info');				
		
	$options[] = array(
		//'name' => __('Check to display Blurb Text on home page.', 'options_check'),
		'desc' => __('Check to display Blurb on home page.', 'options_check'),
		'id' => 'display_blurb',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		//'name' => __('Blurb Text', 'options_check'),
		'desc' => __('Enter text here to be displayed in Blurb Heading.', 'options_check'),
		'id' => 'blurb_heading',
		'std' => 'Hello World!',
		'type' => 'text');			
		
	$options[] = array(
		//'name' => __('Blurb Text', 'options_check'),
		'desc' => __('Enter text here to be displayed in Blurb Section.', 'options_check'),
		'id' => 'blurb_text',
		'std' => 'Welcome to Our Agency. We specialize in Web Design and Development. Check out our outstanding portfolio, and get in touch with Us!',
		'type' => 'textarea');	

	$options[] = array(
		//'name' => __('Check to display Blurb Button.', 'options_check'),
		'desc' => __('Check to display Blurb Button.', 'options_check'),
		'id' => 'display_blurb_button',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		//'name' => __('Blurb Button Title', 'options_check'),
		'desc' => __('Set title for Blurb Button.', 'options_check'),
		'id' => 'blurb_button_title',
		'std' => 'Get In Touch',
		'type' => 'text');		
		
	$options[] = array(
		//'name' => __('Select a Page to link to Blurb Button', 'options_check'),
		'desc' => __('Link for Blurb Button', 'options_check'),
		'id' => 'blurb_button_link_page',
		'type' => 'select',
		'options' => $options_pages);	

	$options[] = array(
		'name' => __('Widget Areas in Front Page', 'options_check'),
		'desc' => __('This option allows you to set how many widget areas you want in Frontpage. Default is 3.', 'options_check'),
		'id' => 'front_page_widget_section_count',
		'std' => '3',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $theme_footer_widgets);			
		
		
	//Settings for Adding custom css/js code in head or footer
	$options[] = array(
		'name' => __('Custom Codes', 'options_check'),
		'type' => 'heading');			

	$options[] = array(
		'name' => __('Code Setting', 'options_check'),
		'desc' => __('Check to add following CSS in Header Section', 'options_check'),
		'id' => 'add_code_in_wp_head',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		
		'desc' => __('Code to add in header.', 'options_check'),
		'id' => 'code_for_wp_head',
		'std' => '',
		'type' => 'textarea');			
		
	$options[] = array(
		
		'desc' => __('Check to add following code in Footer section', 'options_check'),
		'id' => 'add_code_in_wp_footer',
		'std' => '1',
		'type' => 'checkbox');				
		
	$options[] = array(
		
		'desc' => __('Code to add in footer.', 'options_check'),
		'id' => 'code_for_wp_footer',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'name' => __('Misc Settings', 'options_check'),
		'type' => 'heading');		
	

	$options[] = array(
		'name' => __('Set your Favicon', 'options_check'),
		'desc' => __('Set your Favicon. Add complete url for icon image' , 'options_check'),
		'id' => 'favicon_url',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'name' => __('Display Search Icon in Nav Menu', 'options_check'),
		'desc' => __('Check to display Search in Nav Menu. Defaults to True.', 'options_check'),
		'id' => 'display_nav_search',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		'name' => __('Open Submenu on Mouse Click', 'options_check'),
		'desc' => __('Check to display submenu  on Mouse Click. Default is Mouse Hoover', 'options_check'),
		'id' => 'display_nav_on_mouse_click',
		'std' => '0',
		'type' => 'checkbox');			
	
	$options[] = array(
		'name' => __('Make Parent Menu Clickable', 'options_check'),
		'desc' => __('Check to make Parent  Menu Clickable. Default is false. <b style="color:red;">This feature will NOT work properly on Mobile devices. So plesae use cautiously.</b>', 'options_check'),
		'id' => 'make_parent_menu_clickable',
		'std' => '0',
		'type' => 'checkbox');			

	
	$options[] = array(
		'name' => __('Display Post Meta Information', 'options_check'),
		'desc' => __('Check to display Post Meta Information. Defaults to True.', 'options_check'),
		'id' => 'display_post_meta_info',
		'std' => '1',
		'type' => 'checkbox');		
		
	$options[] = array(
		'name' => __('Display Post/Page Navigation and Category/Tags on Single Post/Page', 'options_check'),
		'desc' => __('Check to display Post/Page Navigation and Category/Tags on Single Post/Page. Defaults to True.', 'options_check'),
		'id' => 'display_post_page_nav',
		'std' => '1',
		'type' => 'checkbox');	
		
	
	return $options;
}