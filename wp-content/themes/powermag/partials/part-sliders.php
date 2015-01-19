<!-- Primary Slider
================================================== -->

<div class="row sliders">

<?php
$featured_post = get_post_meta(get_the_ID(), 'pm_featured_post_1', true);
$dual_slider = of_get_option('pm_slider_2');
$carousel =  of_get_option('pm_carousel');
$slider_1_words = of_get_option('pm_slider_1_words');

if ( $carousel AND of_get_option('pm_carousel_position') == 'left' ) get_template_part ('partials/part', 'carousel'); ?>

	<div class="flex-container slider1">	
		<?php  if ( $dual_slider AND $carousel ) { //Slider1 + Slider2 + Carousel ?>
		<div class="flexslider span5">
		<?php } elseif ( $dual_slider AND !$carousel ) { //Slider1 + Slider 2 ?>
		<div class="flexslider span6">
		<?php } elseif ( !$dual_slider AND $carousel ) { // Slider1 + Carousel ?>
		<div class="flexslider span10">
		<?php } elseif ( !$dual_slider AND !$carousel ) { //Slider1 ?>
		<div class="flexslider span12">
		<?php } ?>
		
			<ul class="slides">
			
			<?php //Slider 1 query
		
			$querydetails = "
			SELECT wposts.*
			FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
			WHERE wposts.ID = wpostmeta.post_id
			AND wpostmeta.meta_key = 'pm_featured_post_1'
			AND wpostmeta.meta_value = '1'
			AND wposts.post_status = 'publish'
			AND wposts.post_type IN ('post', 'page')
			ORDER BY wposts.post_date DESC
			";
			
			$pageposts = $wpdb->get_results($querydetails, OBJECT);
			
			$i = 0;
			if ($pageposts):
			foreach ($pageposts as $post):
			setup_postdata($post);
			
			$slider1_count = of_get_option('pm_slider_1_count');

			$i++;
			$format = get_post_format();
			if ($i < $slider1_count + 1)
			
			{ ?>
			
				<li>
					<?php if ( $dual_slider  AND !$carousel ) { the_post_thumbnail('slider-double'); }
					 
						  elseif ( $dual_slider AND $carousel ) { the_post_thumbnail('slider-double-carousel'); }
						  
						  elseif ( !$dual_slider AND $carousel ) { the_post_thumbnail('slider-carousel'); }
						  
						  else { the_post_thumbnail('slider-single'); }
					?>
					
					<?php if ( $post->post_type == 'post' ) { ?>
						<span class="flex-cat">
						<?php
						$category = get_the_category($post->ID);
						$cat_id = get_cat_ID( $name );
						$link = get_category_link( $cat_id );
							
							if ( of_get_option('pm_parentcat') == 'end' ) {
								echo '<a href="'. get_category_link( end($category)->term_id ) .'">'. end($category)->cat_name .'</a>';
							} else {
							
							$parentscategory ="";
								foreach((get_the_category()) as $category) {
									if ($category->category_parent == 0) {
										$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
									}
								}
								echo substr($parentscategory,0,-2);
							}
						?>
						</span>
					<?php } ?>
					
					<div class="flex-caption">
						<h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'powermag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title();?></a></h1>
						<p><?php echo string_limit_words(get_the_excerpt(), $slider_1_words); if ($slider_1_words != '0') echo '...' ?></p>
					</div>
				</li>
				<?php } endforeach; 	endif; wp_reset_query();?>
			</ul>
		</div><!-- .flexslider -->
	
	</div><!-- .flex-container -->

<?php  if ( $carousel AND of_get_option('pm_carousel_position') == 'center' ) get_template_part ('partials/part', 'carousel'); ?>


<!-- Secondary Slider
================================================== -->

<?php 
$featured_post_2 = get_post_meta(get_the_ID(), 'pm_featured_post_2', true);
$slider_2_words = of_get_option('pm_slider_2_words');

if ( $dual_slider ) { //Right slider if enabled ?>

	<div class="flex-container slider2">
	
		<?php  if ( $dual_slider AND $carousel ) { //Slider1 + Slider2 + Carousel?>
		<div class="flexslider span5">
		<?php } elseif ( $dual_slider AND !$carousel ) { //Slider1 + Slider 2 ?>
		<div class="flexslider span6">
		<?php } ?>	
		
			<ul class="slides">
			<?php //Slider 2 query
			
			$slider2_count = of_get_option('pm_slider_2_count');
		
			$querydetails = "
			SELECT wposts.*
			FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
			WHERE wposts.ID = wpostmeta.post_id
			AND wpostmeta.meta_key = 'pm_featured_post_2'
			AND wpostmeta.meta_value = '1'
			AND wposts.post_status = 'publish'
			AND wposts.post_type IN ('post', 'page')
			ORDER BY wposts.post_date DESC
			";
			
			$pageposts = $wpdb->get_results($querydetails, OBJECT);
			
			$i = 0;
			if ($pageposts):
			foreach ($pageposts as $post):
			setup_postdata($post);
			
			//$pm_is_video = get_post_meta(get_the_ID(), 'pm_is_video', true);  
			$i++;
			$format = get_post_format();
			if ($i < $slider2_count + 1)
			
			{ ?>
				<li>
					<?php 
						if ( $dual_slider  AND !$carousel ) { the_post_thumbnail('slider-double'); }
						
						else {the_post_thumbnail('slider-double-carousel'); }
					 ?>
					
					<?php if ( $post->post_type == 'post' ) { ?>
						<span class="flex-cat">
						<?php
						$category = get_the_category($post->ID);
						$cat_id = get_cat_ID( $name );
						$link = get_category_link( $cat_id );
							
							if ( of_get_option('pm_parentcat') == 'end' ) {
								echo '<a href="'. get_category_link( end($category)->term_id ) .'">'. end($category)->cat_name .'</a>';
							} else {
							
							$parentscategory ="";
								foreach((get_the_category()) as $category) {
									if ($category->category_parent == 0) {
										$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
									}
								}
								echo substr($parentscategory,0,-2);
							}
						?>			
						</span>
					<?php } ?>
					
					<div class="flex-caption">
						<h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'powermag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title();?></a></h1>
						<p><?php echo string_limit_words(get_the_excerpt(), $slider_2_words); if ($slider_2_words != '0') echo '...' ?></p>
					</div>
				</li>
				<?php } endforeach; 	
				endif; 
				wp_reset_query();
				?>
			</ul>
		</div><!-- .flexslider -->
	</div><!-- .flex-container -->
<?php } ?>
	
<?php  if ( $carousel AND of_get_option('pm_carousel_position') == 'right' ) get_template_part ('partials/part', 'carousel'); ?>

</div><!--.row .sliders-->