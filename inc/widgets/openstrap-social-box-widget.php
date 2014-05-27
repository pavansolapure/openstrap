<?php
/**
 * Social Icon Box Widget
 *
 * File : openstrap-social-box-widget.php
 * 
 * @package Openstrap
 * @since Openstrap 0.1
 */
?>
<?php

class openstrap_socialiconbox_widget extends WP_Widget {

         public function __construct() {

			/* Widget settings. */
			$widget_ops = array( 'classname' => 'social-icon-box', 'description' => __('Enable Social Icon Box for your site.', 'openstrap') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-social-icon-box' );

			/* Create the widget. */
			$this->WP_Widget( 'widget-social-icon-box', __('(Openstrap) Socal Icon Box', 'openstrap'), $widget_ops, $control_ops );		
		
        }
		
		/* Get Default values of fields. */
		function widget_defaults() {
			return array(
					'title' => '', 
					'show_facebook_icon' => '',
					'facebook_profile'=>'',		
					'show_twitter_icon' => '', 
					'twitter_profile' => '', 
					'show_googleplus_icon' => '', 
					'googleplus_profile' => '', 
					'show_linkedin_icon' => '', 
					'linkedin_profile' => '', 		
					'show_pinterest_icon' => '', 
					'pinterest_profile' => '',			
					'show_rss_icon' => '', 
					'rss_profile' => '',
					'show_youtube_icon' => '', 
					'youtube_profile' => '',					
					'icon_style' => ''
			);
		}			

        public function form( $instance ) {
		
			$instance = wp_parse_args( (array) $instance, $this->widget_defaults());
			
			//title
			openstrap_widget_field( $this, array ( 'field' => 'title', 'label' => __( 'Title:', 'openstrap' ) ), $instance['title'] );
											  
			//facebook 
			openstrap_widget_field( $this, array ('field' => 'show_facebook_icon', 'label' => __( 'Display Facebook Icon :', 'openstrap' ), 'type' => 'checkbox' ), $instance['show_facebook_icon'] );			
			openstrap_widget_field( $this, array ('field' => 'facebook_profile', 'label' => __( 'Facebook Profile:', 'openstrap' ), 'type' => 'text' ), $instance['facebook_profile'] );					
			
			//twitter			
			openstrap_widget_field( $this, array ('field' => 'show_twitter_icon', 'label' => __( 'Display Twitter Icon :', 'openstrap' ), 'type' => 'checkbox' ), $instance['show_twitter_icon'] );			
			openstrap_widget_field( $this, array ('field' => 'twitter_profile', 'label' => __( 'Twitter Profile:', 'openstrap' ), 'type' => 'text' ), $instance['twitter_profile'] );
			
			//googleplus			
			openstrap_widget_field( $this, array ('field' => 'show_googleplus_icon', 'label' => __( 'Display Google+ Icon :', 'openstrap' ), 'type' => 'checkbox' ), $instance['show_googleplus_icon'] );			
			openstrap_widget_field( $this, array ('field' => 'googleplus_profile', 'label' => __( 'Google+ Profile:', 'openstrap' ), 'type' => 'text' ), $instance['googleplus_profile'] );

			//linkedin			
			openstrap_widget_field( $this, array ('field' => 'show_linkedin_icon', 'label' => __( 'Display LinkedIn Icon :', 'openstrap' ), 'type' => 'checkbox' ), $instance['show_linkedin_icon'] );			
			openstrap_widget_field( $this, array ('field' => 'linkedin_profile', 'label' => __( 'LinkedIn Profile:', 'openstrap' ), 'type' => 'text' ), $instance['linkedin_profile'] );

			//pinterest			
			openstrap_widget_field( $this, array ('field' => 'show_pinterest_icon', 'label' => __( 'Display Pinterest Icon :', 'openstrap' ), 'type' => 'checkbox' ), $instance['show_pinterest_icon'] );			
			openstrap_widget_field( $this, array ('field' => 'pinterest_profile', 'label' => __( 'LinkedIn Pinterest:', 'openstrap' ), 'type' => 'text' ), $instance['pinterest_profile'] );

			//rss			
			openstrap_widget_field( $this, array ('field' => 'show_rss_icon', 'label' => __( 'Display RSS Icon :', 'openstrap' ), 'type' => 'checkbox' ), $instance['show_rss_icon'] );			
			openstrap_widget_field( $this, array ('field' => 'rss_profile', 'label' => __( 'LinkedIn RSS:', 'openstrap' ), 'type' => 'text' ), $instance['rss_profile'] );

			//rss			
			openstrap_widget_field( $this, array ('field' => 'show_youtube_icon', 'label' => __( 'Display Youtube Icon :', 'openstrap' ), 'type' => 'checkbox' ), $instance['show_youtube_icon'] );			
			openstrap_widget_field( $this, array ('field' => 'youtube_profile', 'label' => __( 'Youtube Profile:', 'openstrap' ), 'type' => 'text' ), $instance['youtube_profile'] );
					
			
			openstrap_widget_field( $this, array ( 'field' => 'icon_style', 'type' => 'select', 
												   'label' => __( 'Select Style: ', 'openstrap' ),
												   'options' => array (
														array(	'key' => 'small',
																'name' => __( 'Small', 'openstrap' ) ),
														array(	'key' => 'large',
																'name' => __( 'Default', 'openstrap' ) ),
														array(	'key' => '2x',
																'name' => __( 'Large', 'openstrap' ) ),
														array(	'key' => '3x',
																'name' => __( 'Extra Large', 'openstrap' ) ),					
																 ), 'class' => '' ), $instance['icon_style'] );			
			   
        }

        public function update( $new_instance, $old_instance ) {	
			$instance = $old_instance;		
			
			$new_instance = wp_parse_args( (array) $new_instance, $this->widget_defaults());
											  
			$instance['title'] = strip_tags(stripslashes($new_instance['title']));
			$instance['show_facebook_icon'] = $new_instance['show_facebook_icon'] ? 1 : 0;
			$instance['facebook_profile'] = $new_instance['facebook_profile'];
			
			$instance['show_twitter_icon'] = $new_instance['show_twitter_icon'] ? 1 : 0;
			$instance['twitter_profile'] = $new_instance['twitter_profile'];			

			$instance['show_googleplus_icon'] = $new_instance['show_googleplus_icon'] ? 1 : 0;
			$instance['googleplus_profile'] = $new_instance['googleplus_profile'];		

			$instance['show_linkedin_icon'] = $new_instance['show_linkedin_icon'] ? 1 : 0;
			$instance['linkedin_profile'] = $new_instance['linkedin_profile'];		

			$instance['show_pinterest_icon'] = $new_instance['show_pinterest_icon'] ? 1 : 0;
			$instance['pinterest_profile'] = $new_instance['pinterest_profile'];	

			$instance['show_rss_icon'] = $new_instance['show_rss_icon'] ? 1 : 0;
			$instance['rss_profile'] = $new_instance['rss_profile'];	
			
			$instance['show_youtube_icon'] = $new_instance['show_youtube_icon'] ? 1 : 0;
			$instance['youtube_profile'] = $new_instance['youtube_profile'];			

			$instance['icon_style'] = $new_instance['icon_style'];			

			return $instance;
        }

        public function widget( $args, $instance ) {
			extract( $args );			
			$instance = wp_parse_args($instance, $this->widget_defaults());
			extract( $instance, EXTR_SKIP );
			
			$show_facebook_icon = ! empty( $instance['show_facebook_icon'] ) ? '1' : '0';
			$show_twitter_icon = ! empty( $instance['show_twitter_icon'] ) ? '1' : '0';
			$show_googleplus_icon = ! empty( $instance['show_googleplus_icon'] ) ? '1' : '0';
			$show_linkedin_icon = ! empty( $instance['show_linkedin_icon'] ) ? '1' : '0';
			$show_pinterest_icon = ! empty( $instance['show_pinterest_icon'] ) ? '1' : '0';
			$show_rss_icon = ! empty( $instance['show_rss_icon'] ) ? '1' : '0';
			$show_youtube_icon = ! empty( $instance['show_youtube_icon'] ) ? '1' : '0';
			
			//$title = apply_filters('widget_title', empty($instance['title']) ? __('Social', 'openstrap') : $instance['title'], $instance, $this->id_base);
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
			
			$facebook_profile = ! empty( $instance['facebook_profile'] ) ? $instance['facebook_profile'] : '';			
			$twitter_profile = ! empty( $instance['twitter_profile'] ) ? $instance['twitter_profile'] : '';			
			$googleplus_profile = ! empty( $instance['googleplus_profile'] ) ? $instance['googleplus_profile'] : '';
			$linkedin_profile = ! empty( $instance['linkedin_profile'] ) ? $instance['linkedin_profile'] : '';
			$pinterest_profile = ! empty( $instance['pinterest_profile'] ) ? $instance['pinterest_profile'] : '';
			$rss_profile = ! empty( $instance['rss_profile'] ) ? $instance['rss_profile'] : '';
			$youtube_profile = ! empty( $instance['youtube_profile'] ) ? $instance['youtube_profile'] : '';
			
			$icon_style = ! empty( $instance['icon_style'] ) ? $instance['icon_style'] : 'small';
			
			echo $before_widget;
			?>
			<div class="social-icon-box-inner">
				<ul class="list-inline">
			<?php
			if ( $title )
			echo $before_title . $title . $after_title;				
				if($show_facebook_icon): ?><li><a href="<?php echo esc_url($facebook_profile); ?>" ><i class="icon-facebook icon-<?php echo $icon_style;?>"></i></a> </li><?php endif; 
				if($show_twitter_icon): ?> <li><a href="<?php echo esc_url($twitter_profile); ?>" ><i class="icon-twitter icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_googleplus_icon): ?> <li><a href="<?php echo esc_url($googleplus_profile); ?>" ><i class="icon-google-plus icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_linkedin_icon): ?> <li><a href="<?php echo esc_url($linkedin_profile); ?>" ><i class="icon-linkedin icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_pinterest_icon): ?> <li><a href="<?php echo esc_url($pinterest_profile); ?>" ><i class="icon-pinterest icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_rss_icon): ?> <li><a href="<?php echo esc_url($rss_profile); ?>" ><i class="icon-rss icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_youtube_icon): ?> <li><a href="<?php echo esc_url($youtube_profile); ?>" ><i class="icon-youtube icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;											
			?>	
				</ul>
			</div>
			<?php
			echo $after_widget;
        }
}
?>