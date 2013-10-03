<?php
/**
 * Front Page Text
 *
 * File : openstrap-front-page-text.php
 * 
 * @package Openstrap
 * @since Openstrap 0.1
 */
?>
<?php

class openstrap_frontpage_text_widget extends WP_Widget {

         public function __construct() {

			/* Widget settings. */
			$widget_ops = array( 'classname' => 'front-page-text', 'description' => __('Front Paget Text for Marketing.', 'openstrap') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-front-page-text' );

			/* Create the widget. */
			$this->WP_Widget( 'widget-front-page-text', __('(Openstrap) Front Page Text', 'openstrap'), $widget_ops, $control_ops );		
		
        }
		
		/* Get Default values of fields. */
		function widget_defaults() {
			return array(
				'title' => '',
				'headline' => '',
				'tagline' => '',
				'image' => '',
				'action_url' => '',
				'action_label' => 'Learn More',
				'action_color' => 'primary',
				'alignment' => '',
				'thumbnail' => 'large',
			);
		}		

        public function form( $instance ) {
	
			$instance = wp_parse_args( (array) $instance, $this->widget_defaults());									  
				
			openstrap_widget_field( $this, array ( 'field' => 'title', 'label' => __( 'Title:', 'openstrap' ) ), $instance['title'] );
			openstrap_widget_field( $this, array ( 'field' => 'image', 'label' => __( 'Image:', 'openstrap' ), 'type' => 'media' ), $instance['image'] );
			openstrap_widget_field( $this, array ( 'field' => 'thumbnail', 'type' => 'select', 
												   'label' => __( 'Image Size:', 'openstrap' ), 
												   'options' => openstrap_thumbnail_array(), 
												   'class' => '' ), $instance['thumbnail'] );
			if ( $instance['image'] )
				echo wp_get_attachment_image( $instance['image'], openstrap_thumbnail_size( $instance['thumbnail'] ), false, array( 'class' => 'widget-image' ) );
				
			openstrap_widget_field( $this, array ( 'field' => 'headline', 'label' => __( 'Headline:', 'openstrap' ) ), $instance['headline'] );
			openstrap_widget_field( $this, array ( 'field' => 'tagline', 'label' => __( 'Tagline:', 'openstrap' ), 'type' => 'textarea' ), $instance['tagline'] );
			openstrap_widget_field( $this, array ( 'field' => 'action_url', 'label' => __( 'Action URL:', 'openstrap' ), 'type' => 'url' )
									, $instance['action_url'] );
									
			openstrap_widget_field( $this, array ( 'field' => 'action_label', 'label' => __( 'Action Label:', 'openstrap' ) ), $instance['action_label'] );
			
			openstrap_widget_field( $this, array ( 'field' => 'alignment', 'type' => 'select', 
												   'label' => __( 'Alignment: ', 'openstrap' ),
												   'options' => array (
														array(	'key' => 'left',
																'name' => __( 'Left', 'openstrap' ) ),
														array(	'key' => 'center',
																'name' => __( 'Center', 'openstrap' ) ),
														array(	'key' => 'right',
																'name' => __( 'Right', 'openstrap' ) ),			
																 ), 'class' => '' ), $instance['alignment'] );
																 
			openstrap_widget_field( $this, array ( 'field' => 'action_color', 'type' => 'select', 
															   'label' => __( 'Action Button: ', 'openstrap' ),
															   'options' => array (
																	array(	'key' => 'primary',
																			'name' => __( 'Primary', 'openstrap' ) ),
																	array(	'key' => 'info',
																			'name' => __( 'Info', 'openstrap' ) ),
																	array(	'key' => 'warning',
																			'name' => __( 'Warning', 'openstrap' ) ),
																	array(	'key' => 'danger',
																			'name' => __( 'Danger', 'openstrap' ) ),
																	array(	'key' => 'success',
																			'name' => __( 'Success', 'openstrap' ) ),													
																	array(	'key' => 'default',
																			'name' => __( 'Default', 'openstrap' ) ),				
																			 ), 'class' => '' ), $instance['action_color'] );																 
			   
        }

        public function update( $new, $old ) {				
			$instance = $old;
			$instance['title'] = strip_tags( $new['title'] );
			$instance['headline'] = wp_kses_stripslashes($new['headline']);
			$instance['tagline'] = wp_kses_stripslashes($new['tagline']);
			$instance['image'] =  $new['image'];
			$instance['thumbnail'] = $new['thumbnail'];
			$instance['action_url'] = esc_url_raw($new['action_url']);
			$instance['action_label'] = wp_kses_stripslashes($new['action_label']);
			$instance['action_color'] = wp_kses_stripslashes( $new['action_color'] );
			$instance['alignment'] = wp_kses_stripslashes( $new['alignment'] );			
			return $instance;			
        }

        public function widget( $args, $instance ) {	
		
			extract( $args, EXTR_SKIP );
			$instance = wp_parse_args($instance, $this->widget_defaults());
			extract( $instance, EXTR_SKIP );
			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base);		

			echo $before_widget; 
			if ( ! empty( $title ) ) {
				echo $before_title;
				echo $title;
				echo $after_title;
			} 
			echo '<div class="frontpage-widget-inner-text text-'.esc_attr( $alignment ).'">';
			if ( ! empty( $image ) ) {
				if ( ! empty( $action_url ) )
					echo '<a href="' . esc_url( $action_url ) . '">';
				echo wp_get_attachment_image( $image, openstrap_thumbnail_size( $thumbnail ) );
				if ( ! empty( $action_url ) )
					echo '</a>';			
			}
			
			if ( ! empty( $headline ) )
				echo '<h2>' . esc_attr( $headline ) . '</h2>';
			if ( ! empty( $tagline ) )
				echo '<p>' . do_shortcode( $tagline ) .'</p>';
			if ( ! empty( $action_url ) && ! empty( $action_label ) ) {
				echo '<p><a href="' . esc_url( $action_url );
				echo '" class="action-label btn btn-' . esc_attr( $action_color ) . '">';
				echo esc_attr( $action_label ) . '</a></p>';
			}
			echo '</div>';

			echo $after_widget;

        }
}

?>