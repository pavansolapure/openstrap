<?php
	$imagepath =  get_template_directory_uri() . '/images/';
	
	$slider_img_1 = of_get_option('slider_img_1'); if(($slider_img_1 == "")) unset($slider_img_1);
	$slider_img_2 = of_get_option('slider_img_2'); if(($slider_img_2 == "")) unset($slider_img_2);
	$slider_img_3 = of_get_option('slider_img_3'); if(($slider_img_3 == "")) unset($slider_img_3);
	$slider_img_4 = of_get_option('slider_img_4'); if(($slider_img_4 == "")) unset($slider_img_4);	
	
	$heading_1 = trim(of_get_option('slider_image_heading_1')); if(($heading_1 == "")) unset($heading_1);
	$heading_2 = trim(of_get_option('slider_image_heading_2')); if(($heading_2 == "")) unset($heading_2);
	$heading_3 = trim(of_get_option('slider_image_heading_3')); if(($heading_3 == "")) unset($heading_3);
	$heading_4 = trim(of_get_option('slider_image_heading_4'));	if(($heading_4 == "")) unset($heading_4);	
	
	$caption_1 = trim(of_get_option('slider_image_caption_1')); if(($caption_1 == "")) unset($caption_1);
	$caption_2 = trim(of_get_option('slider_image_caption_2')); if(($caption_2 == "")) unset($caption_2);
	$caption_3 = trim(of_get_option('slider_image_caption_3')); if(($caption_3 == "")) unset($caption_3);
	$caption_4 = trim(of_get_option('slider_image_caption_4')); if(($caption_4 == "")) unset($caption_4);	
	
	$button_1 = trim(of_get_option('slider_image_button_1')); if(($button_1 == "")) unset($button_1);
	$button_2 = trim(of_get_option('slider_image_button_2')); if(($button_2 == "")) unset($button_2);
	$button_3 = trim(of_get_option('slider_image_button_3')); if(($button_3 == "")) unset($button_3);
	$button_4 = trim(of_get_option('slider_image_button_4')); if(($button_4 == "")) unset($button_4);		
	
	$link_1 = trim(of_get_option('slider_image_button_1_link')); if(($link_1 == "")) unset($link_1);
	$link_2 = trim(of_get_option('slider_image_button_2_link')); if(($link_2 == "")) unset($link_2);
	$link_3 = trim(of_get_option('slider_image_button_3_link')); if(($link_3 == "")) unset($link_3);
	$link_4 = trim(of_get_option('slider_image_button_4_link')); if(($link_4 == "")) unset($link_4);	
	
?>    
<?php if(isset($slider_img_1) || isset($slider_img_2) || isset($slider_img_3) || isset($slider_img_4)) :?>	
	<!-- Carousel
    ================================================== -->
	<div class="slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
	
	  <!-- Indicators -->
      <ol class="carousel-indicators">
	  <?php if(isset($slider_img_1)): ?>
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	  <?php endif;?>	
	  <?php if(isset($slider_img_2)): ?>
        <li data-target="#myCarousel" data-slide-to="1"></li>
	  <?php endif;?>
	  <?php if(isset($slider_img_3)): ?>
        <li data-target="#myCarousel" data-slide-to="2"></li>
	  <?php endif;?>
	  <?php if(isset($slider_img_4)): ?>
        <li data-target="#myCarousel" data-slide-to="3"></li>
	  <?php endif;?>
      </ol>

      <div class="carousel-inner">	  
		<?php if(isset($slider_img_1)): ?>
        <div class="item active">
          <img src="<?php echo esc_url($slider_img_1);?>" alt="">
          <div class="container">
            <div class="carousel-caption">
			  <?php if(isset($heading_1)): ?>	
              <h1><?php echo $heading_1;?></h1>
			  <?php endif;?>
			  <?php if(isset($caption_1)): ?>	
              <p><?php echo $caption_1; ?></p>
			  <?php endif;?>
			  <?php if(isset($link_1)): ?>
              <p><a class="btn btn-large btn-primary" href="<?php echo get_permalink( $link_1); ?>"><?php echo $button_1; ?></a></p>
			  <?php endif;?>
            </div>
          </div>
        </div>
		<?php endif;?>
		
		<?php if(isset($slider_img_2)): ?>
        <div class="item">
          <img src="<?php echo esc_url($slider_img_2);?>" alt="">
          <div class="container">
            <div class="carousel-caption">
			  <?php if(isset($heading_2)): ?>	
              <h1><?php echo $heading_2;?></h1>
			  <?php endif;?>
			  <?php if(isset($caption_2)): ?>	
              <p><?php echo $caption_2; ?></p>
			  <?php endif;?>
			  <?php if(isset($link_2)): ?>
              <p><a class="btn btn-large btn-primary" href="<?php echo get_permalink( $link_2); ?>"><?php echo $button_2; ?></a></p>
			  <?php endif;?>
            </div>
          </div>
        </div>
		<?php endif;?>

		<?php if(isset($slider_img_3)): ?>
        <div class="item">
          <img src="<?php echo esc_url($slider_img_3);?>" alt="">
          <div class="container">
            <div class="carousel-caption">
			  <?php if(isset($heading_3)): ?>	
              <h1><?php echo $heading_3;?></h1>
			  <?php endif;?>
			  <?php if(isset($caption_3)): ?>	
              <p><?php echo $caption_3; ?></p>
			  <?php endif;?>
			  <?php if(isset($link_3)): ?>
              <p><a class="btn btn-large btn-primary" href="<?php echo get_permalink( $link_3); ?>"><?php echo $button_3; ?></a></p>
			  <?php endif;?>
            </div>
          </div>
        </div>
		<?php endif;?>

		<?php if(isset($slider_img_4)): ?>
        <div class="item">
          <img src="<?php echo esc_url($slider_img_4);?>" alt="">
          <div class="container">
            <div class="carousel-caption">
			  <?php if(isset($heading_4)): ?>	
              <h1><?php echo $heading_4;?></h1>
			  <?php endif;?>
			  <?php if(isset($caption_4)): ?>	
              <p><?php echo $caption_4; ?></p>
			  <?php endif;?>
			  <?php if(isset($link_4)): ?>
              <p><a class="btn btn-large btn-primary" href="<?php echo get_permalink( $link_4); ?>"><?php echo $button_4; ?></a></p>
			  <?php endif;?>
            </div>
          </div>
        </div>
		<?php endif;?>				
      </div>	  
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span><i class="icon-chevron-sign-left icon-prev-c"></i></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span><i class="icon-chevron-sign-right icon-next-c"></i></span></a>
    </div><!-- /.carousel -->
	</div><!-- /.slider -->
<?php endif;?>	