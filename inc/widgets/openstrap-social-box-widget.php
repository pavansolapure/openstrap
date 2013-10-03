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

        public function form( $instance ) {
	
			$instance = wp_parse_args( (array) $instance, 
										array( 
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
												'icon_style' => ''	
											  ));
											  
			$title = strip_tags($instance['title']);
			
			$show_facebook_icon = $instance['show_facebook_icon'] ? 'checked="checked"' : '';
			$facebook_profile = $instance['facebook_profile'];
			
			$show_twitter_icon = $instance['show_twitter_icon'] ? 'checked="checked"' : '';			
			$twitter_profile = $instance['twitter_profile'];
			
			$show_googleplus_icon = $instance['show_googleplus_icon'] ? 'checked="checked"' : '';			
			$googleplus_profile = $instance['googleplus_profile'];

			$show_linkedin_icon = $instance['show_linkedin_icon'] ? 'checked="checked"' : '';			
			$linkedin_profile = $instance['linkedin_profile'];

			$show_pinterest_icon = $instance['show_pinterest_icon'] ? 'checked="checked"' : '';			
			$pinterest_profile = $instance['pinterest_profile'];

			$show_rss_icon = $instance['show_rss_icon'] ? 'checked="checked"' : '';			
			$rss_profile = $instance['rss_profile'];		
			
			$icon_style = $instance['icon_style'];					

			$styles = array(
							 "small"=> "small", 
							 "large" => "default",							 
							 "2x"=> "2x",
							 "3x"=> "3x"
							);		
				
			?>			
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'openstrap'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>			
		<p>  
			<input class="checkbox" type="checkbox" <?php echo $show_facebook_icon; ?> id="<?php echo $this->get_field_id('show_facebook_icon'); ?>" name="<?php echo $this->get_field_name('show_facebook_icon'); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_facebook_icon' ); ?>"><?php _e('Display Facebook Icon', 'openstrap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'facebook_profile' ); ?>" name="<?php echo $this->get_field_name( 'facebook_profile' ); ?>" value="<?php echo $instance['facebook_profile']; ?>" style="width:90%;" />  (e.g: http://facebook.com/my-profile)				
		</p>  			
		
		<p>  
			<input class="checkbox" type="checkbox" <?php echo $show_twitter_icon; ?> id="<?php echo $this->get_field_id('show_twitter_icon'); ?>" name="<?php echo $this->get_field_name('show_twitter_icon'); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_twitter_icon' ); ?>"><?php _e('Display Twitter Icon', 'openstrap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_profile' ); ?>" name="<?php echo $this->get_field_name( 'twitter_profile' ); ?>" value="<?php echo $instance['twitter_profile']; ?>" style="width:90%;" />  (e.g: http://twitter.com/my-profile)				
		</p> 		
		
		<p>  
			<input class="checkbox" type="checkbox" <?php echo $show_googleplus_icon; ?> id="<?php echo $this->get_field_id('show_googleplus_icon'); ?>" name="<?php echo $this->get_field_name('show_googleplus_icon'); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_googleplus_icon' ); ?>"><?php _e('Display GooglePlus Icon', 'openstrap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'googleplus_profile' ); ?>" name="<?php echo $this->get_field_name( 'googleplus_profile' ); ?>" value="<?php echo $instance['googleplus_profile']; ?>" style="width:90%;" />  (e.g: http://twitter.com/my-profile)				
		</p> 		
		
		<p>  
			<input class="checkbox" type="checkbox" <?php echo $show_linkedin_icon; ?> id="<?php echo $this->get_field_id('show_linkedin_icon'); ?>" name="<?php echo $this->get_field_name('show_linkedin_icon'); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_linkedin_icon' ); ?>"><?php _e('Display LinkedIn Icon', 'openstrap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'linkedin_profile' ); ?>" name="<?php echo $this->get_field_name( 'linkedin_profile' ); ?>" value="<?php echo $instance['linkedin_profile']; ?>" style="width:90%;" />  (e.g: http://linkedin.com/my-profile)				
		</p> 		
		
		<p>  
			<input class="checkbox" type="checkbox" <?php echo $show_pinterest_icon; ?> id="<?php echo $this->get_field_id('show_pinterest_icon'); ?>" name="<?php echo $this->get_field_name('show_pinterest_icon'); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_pinterest_icon' ); ?>"><?php _e('Display Pinterest Icon', 'openstrap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'pinterest_profile' ); ?>" name="<?php echo $this->get_field_name( 'pinterest_profile' ); ?>" value="<?php echo $instance['pinterest_profile']; ?>" style="width:90%;" />  (e.g: http://linkedin.com/my-profile)				
		</p> 		
		
		<p>  
			<input class="checkbox" type="checkbox" <?php echo $show_rss_icon; ?> id="<?php echo $this->get_field_id('show_rss_icon'); ?>" name="<?php echo $this->get_field_name('show_rss_icon'); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_rss_icon' ); ?>"><?php _e('Display RSS Icon', 'openstrap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'rss_profile' ); ?>" name="<?php echo $this->get_field_name( 'rss_profile' ); ?>" value="<?php echo $instance['rss_profile']; ?>" style="width:90%;" />  (e.g: http://linkedin.com/my-profile)				
		</p> 			
		
		<p>
			<label for="<?php echo $this->get_field_id('icon_style'); ?>"><?php _e('Select Style:','openstrap'); ?></label>
			<select id="<?php echo $this->get_field_id('icon_style'); ?>" name="<?php echo $this->get_field_name('icon_style'); ?>">			
		<?php
			foreach ( $styles as $style_id => $style_name ) {
				echo '<option value="' . $style_id . '"'
					. selected( $icon_style, $style_id, false )
					. '>'. $style_name . '</option>';
			}
		?>
			</select>
		</p>		
			
			<?php
			   
        }

        public function update( $new_instance, $old_instance ) {	
			$instance = $old_instance;			
			$new_instance = wp_parse_args( (array) $new_instance, 
										array( 
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
											  ));
											  
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

			$instance['icon_style'] = $new_instance['icon_style'];			

			return $instance;
        }

        public function widget( $args, $instance ) {
			extract( $args );			
			
			$show_facebook_icon = ! empty( $instance['show_facebook_icon'] ) ? '1' : '0';
			$show_twitter_icon = ! empty( $instance['show_twitter_icon'] ) ? '1' : '0';
			$show_googleplus_icon = ! empty( $instance['show_googleplus_icon'] ) ? '1' : '0';
			$show_linkedin_icon = ! empty( $instance['show_linkedin_icon'] ) ? '1' : '0';
			$show_pinterest_icon = ! empty( $instance['show_pinterest_icon'] ) ? '1' : '0';
			$show_rss_icon = ! empty( $instance['show_rss_icon'] ) ? '1' : '0';
			//$title = apply_filters('widget_title', empty($instance['title']) ? __('Social', 'openstrap') : $instance['title'], $instance, $this->id_base);
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
			
			$facebook_profile = ! empty( $instance['facebook_profile'] ) ? $instance['facebook_profile'] : '';			
			$twitter_profile = ! empty( $instance['twitter_profile'] ) ? $instance['twitter_profile'] : '';			
			$googleplus_profile = ! empty( $instance['googleplus_profile'] ) ? $instance['googleplus_profile'] : '';
			$linkedin_profile = ! empty( $instance['linkedin_profile'] ) ? $instance['linkedin_profile'] : '';
			$pinterest_profile = ! empty( $instance['pinterest_profile'] ) ? $instance['pinterest_profile'] : '';
			$rss_profile = ! empty( $instance['rss_profile'] ) ? $instance['rss_profile'] : '';
			
			$icon_style = ! empty( $instance['icon_style'] ) ? $instance['icon_style'] : 'small';
			
			echo $before_widget;
			?>
			<div class="social-icon-box-inner">
				<ul class="list-inline">
			<?php
			if ( $title )
			echo $before_title . $title . $after_title;				
				if($show_facebook_icon): ?><li><a href="<?php echo $facebook_profile ?>" ><i class="icon-facebook icon-<?php echo $icon_style;?>"></i></a> </li><?php endif; 
				if($show_twitter_icon): ?> <li><a href="<?php echo $twitter_profile ?>" ><i class="icon-twitter icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_googleplus_icon): ?> <li><a href="<?php echo $googleplus_profile ?>" ><i class="icon-google-plus icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_linkedin_icon): ?> <li><a href="<?php echo $linkedin_profile ?>" ><i class="icon-linkedin icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_pinterest_icon): ?> <li><a href="<?php echo $pinterest_profile ?>" ><i class="icon-pinterest icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;
				if($show_rss_icon): ?> <li><a href="<?php echo $rss_profile ?>" ><i class="icon-rss icon-<?php echo $icon_style;?>"></i></a> </li><?php endif;							
			?>	
				</ul>
			</div>
			<?php
			echo $after_widget;
        }
}
?>