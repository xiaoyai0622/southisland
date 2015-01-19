<?php  if ( of_get_option('pm_carousel') ) { //Right slider if enabled ?>
	<div id="carousel" class="span2">
	
		<?php // Query to get posts with thumbnails only

		if (is_category( )) {
			
			$cat = get_query_var('cat');
			$yourcat = get_category ($cat);
			
			/* Category Query */
			$args = array(
			'posts_per_page' => 5,
			'meta_key' => '_thumbnail_id',
			'category_name' => $yourcat->slug
			);
			
		} else {
			
			/* Homepage Query */			
			$args = array(
			'posts_per_page' => 5,
			'meta_key' => '_thumbnail_id'
			);
			
		}
		query_posts($args); 	
		?>
		<?php while(have_posts()) : the_post(); ?>
		
			<div>
				<span><?php the_title(); ?></span>
				<?php the_post_thumbnail('carousel-thumbs'); ?>
			</div>
	
		<?php endwhile; 
		wp_reset_query();
		?>

	</div>
<?php } ?>