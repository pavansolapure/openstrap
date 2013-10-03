<?php
/**
 * Google Custom Search Widget
 *
 * File : openstrap-google-cse-form.php
 * 
 * @package Openstrap
 * @since Openstrap 0.1
 */
?>
<?php

class openstrap_googlecse_widget extends WP_Widget {

         public function __construct() {

			/* Widget settings. */
			$widget_ops = array( 'classname' => 'google-custom-search', 'description' => __('Enable Google Custom Search on Your Website.', 'openstrap') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-google-cse' );

			/* Create the widget. */
			$this->WP_Widget( 'widget-google-cse', __('(Openstrap) Google Custom Search', 'openstrap'), $widget_ops, $control_ops );		
		
        }

        public function form( $instance ) {		
			$instance = wp_parse_args( (array) $instance, array( 'google_cse_unique_id' => '', 'search_results_page_url' => '') );		
			if ( isset( $instance[ 'google_cse_unique_id' ] ) ) {
				$google_cse_unique_id = $instance[ 'google_cse_unique_id' ];
			}
			
			if ( isset( $instance[ 'search_results_page_url' ] ) ) {
				$search_results_page_url = $instance[ 'search_results_page_url' ];
			}				
			?>			
		<p>  
			<label for="<?php echo $this->get_field_id( 'google_cse_unique_id' ); ?>"><?php _e('Search Engine Id:', 'openstrap'); ?></label>  
			<input id="<?php echo $this->get_field_id( 'google_cse_unique_id' ); ?>" name="<?php echo $this->get_field_name( 'google_cse_unique_id' ); ?>" value="<?php echo $instance['google_cse_unique_id']; ?>" style="width:90%;" />  (e.g: 095382442174838362754:hisuukncdfg )	
		</p>  			
		<p>  
			<label for="<?php echo $this->get_field_id( 'search_results_page_url' ); ?>"><?php _e('Results Page URI:', 'openstrap'); ?></label>  
			<input id="<?php echo $this->get_field_id( 'google_cse_unique_id' ); ?>" name="<?php echo $this->get_field_name( 'search_results_page_url' ); ?>" value="<?php echo $instance['search_results_page_url']; ?>" style="width:90%;" />  (e.g: http://mysite.com/page-cse)	
		</p> 			
			<?php
			   
        }

        public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['google_cse_unique_id'] = $new_instance['google_cse_unique_id'];
			$instance['search_results_page_url'] = $new_instance['search_results_page_url'];

			return $instance;
        }

        public function widget( $args, $instance ) {
			extract( $args );			
			$google_cse_unique_id = $instance['google_cse_unique_id'];
			$search_results_page_url = $instance['search_results_page_url'];
			echo $before_widget;
			?>			
			
			<form class="form-inline" role="form" method="get" id="cse-search-box" action="<?php echo $search_results_page_url; ?>">					
				<input type="hidden" name="cx" value="<?php echo $google_cse_unique_id; ?>" />
				<input type="hidden" name="cof" value="FORID:11" />
				<input type="hidden" name="ie" value="UTF-8" />	
				<div class="input-group">
				<input type="text" class="form-control" name="q" id="q"  autocomplete="off">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary" name="sa"><i class="icon-search"></i></button>
				</span>
				</div>
			</form>	
			<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>			   
			<?php
			echo $after_widget;
        }
}
?>