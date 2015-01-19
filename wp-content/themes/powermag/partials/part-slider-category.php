<!--left slider-->
<div class="row sliders">

<?php
	$category_ID = get_query_var('cat');
	$cat_carousel = get_tax_meta($category_ID,'pm_featured_carousel') == 'on';
 ?>

	<div class="flex-container slider1">	
		<?php if ( $cat_carousel ) { // Slider + Carousel ?>
		<div class="flexslider span6">
		<?php } else { // Slider Only ?>
		<div class="flexslider span8">
		<?php } ?>
		
			<ul class="slides">
			<?php
			
			query_posts(array('cat' => $category_ID, 'posts_per_page' => '5', 'meta_key' => '_thumbnail_id' ));
			if(have_posts()) :
				while(have_posts()) : the_post();
			?>
				<li>
					<?php if ($cat_carousel) { the_post_thumbnail('slider-cat-carousel'); } else { the_post_thumbnail('slider-cat'); } /* @since PM 1.1 */?>
					<span class="flex-cat">
					<?php
					$category = get_the_category($post->ID);
					$cat_id = get_cat_ID( $name );
					$link = get_category_link( $cat_id );
						
						if (of_get_option('pm_parentcat') == 'end' ) {
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
					
					<div class="flex-caption">
						<h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'powermag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title() ?></a></h1>
						<?php echo string_limit_words(get_the_excerpt(), 18); ?>
					</div>
				</li>
				<?php
					endwhile;
				endif;
				wp_reset_query();
				?>
			</ul>
		</div><!-- .flexslider -->
	
	</div><!-- .flex-container -->
	
	<?php if ($cat_carousel) { get_template_part ('partials/part', 'carousel'); } ?>

</div><!--.row .sliders-->

<hr class="divider" />