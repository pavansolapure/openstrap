<?php
/**
 * Feedburner Widget
 *
 * File : openstrap-feedburner-widget.php
 * 
 * @package Openstrap
 * @since Openstrap 1.0
 */
?>
<?php

class openstrap_feedburner_subscription_widget extends WP_Widget {

         public function __construct() {

			/* Widget settings. */
			$widget_ops = array( 'classname' => 'feedburner', 'description' => __('Enable Feedburner form on Your Website.', 'feedburner') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-feedburner' );

			/* Create the widget. */
			$this->WP_Widget( 'widget-feedburner', __('(Openstrap) Feedburner','openstrap'), $widget_ops, $control_ops );					
        }
		
		/* Get Default values of fields. */
		function widget_defaults() {
			return array(
				'title' => '',
				'feedburner_unique_id' => '',				
				'feedburner_title_text' => 'Email Newsletter',
				'feedburner_sub_text' => "Sign up to receive email updates and to hear what's going on with our company!",
				'feedburner_style' => ''
			);
		}			

        public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->widget_defaults());
			
			openstrap_widget_field( $this, array ( 'ptag' => false, 'field' => 'feedburner_unique_id', 'desc' => __( 'Feedburner Id:', 'openstrap' ),'type' => 'label'), $instance['feedburner_unique_id'] );
			openstrap_widget_field( $this, array ( 'ptag' => false, 'field' => 'feedburner_unique_id','type' => 'text'), $instance['feedburner_unique_id'] );
			openstrap_widget_field( $this, array ( 'field' => 'feedburner_unique_id', 'type' => 'label', 'desc' => __( '(e.g: opencodez) ', 'openstrap' ) ) , '' );

			openstrap_widget_field( $this, array ( 'ptag' => false, 'field' => 'feedburner_title_text', 'desc' => __( 'Title Text:', 'openstrap' ),'type' => 'label'), $instance['feedburner_title_text'] );
			openstrap_widget_field( $this, array ( 'ptag' => false, 'field' => 'feedburner_title_text','type' => 'text'), $instance['feedburner_title_text'] );
			openstrap_widget_field( $this, array ( 'field' => 'feedburner_title_text', 'type' => 'label', 'desc' => __( '(e.g: Email Newsletter) ', 'openstrap' ) ) , '' );

			openstrap_widget_field( $this, array ( 'ptag' => false, 'field' => 'feedburner_sub_text', 'desc' => __( 'Sub Text:', 'openstrap' ),'type' => 'label'), $instance['feedburner_sub_text'] );
			openstrap_widget_field( $this, array ( 'ptag' => false, 'field' => 'feedburner_sub_text','type' => 'text'), $instance['feedburner_sub_text'] );
			openstrap_widget_field( $this, array ( 'field' => 'feedburner_sub_text', 'type' => 'label', 'desc' => __( "(e.g: Sign up to receive email updates and to hear what's going on with our company!)", 'openstrap' ) ) , '' );

			openstrap_widget_field( $this, array ( 'field' => 'feedburner_style', 'type' => 'select', 
												   'label' => __( 'Style: ', 'openstrap' ),
												   'options' => array (
														array(	'key' => 'dark',
																'name' => __( 'Dark', 'openstrap' ) ),
														array(	'key' => 'light',
																'name' => __( 'Light', 'openstrap' ) )
													), 'class' => '' ), $instance['feedburner_style'] );
			   
        }

        public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['feedburner_unique_id'] = $new_instance['feedburner_unique_id'];
			$instance['feedburner_style'] = $new_instance['feedburner_style'];
			$instance['feedburner_title_text'] = $new_instance['feedburner_title_text'];
			$instance['feedburner_sub_text'] = $new_instance['feedburner_sub_text'];

			return $instance;
        }

        public function widget( $args, $instance ) {
			extract( $args );			
			$feedburner_unique_id = $instance['feedburner_unique_id'];		
			$feedburner_style = $instance['feedburner_style'];
			$feedburner_title_text = $instance['feedburner_title_text'];	
			$feedburner_sub_text = $instance['feedburner_sub_text'];
			echo $before_widget;	
			?>
			<div>
		<!-- Begin FeedBurner Signup Form -->
		<div id="<?php echo "optin_".$feedburner_style; ?>">
			<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner_unique_id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">    
				<h4><?php echo $feedburner_title_text; ?></h4>
				<p><?php echo $feedburner_sub_text; ?></p>
				<input type="text" size="25" value="Enter your name" name="name" class="name" id="mce-FNAME" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
				<input type="email" size="25" value="Enter your email" name="email" class="required email" id="mce-EMAIL" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">		
				<input type="hidden" value="<?php echo $feedburner_unique_id; ?>" name="uri"/>
				<input type="hidden" name="loc" value="en_US"/>	
				<div class="clear">
					<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
					<span class="text-privacy">We respect your privacy.</span>
				</div>
			</form>
		</div>
		</div>
		<!-- End FeedBurner Signup Form -->						
			<?php  
			echo $after_widget;	
        }

}
?>