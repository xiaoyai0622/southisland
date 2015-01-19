<?php

add_action('widgets_init', 'pm_main_cat_regular_widget_custom');

function pm_main_cat_regular_widget_custom()
{
	register_widget('pm_Main_cat_regular_Widget');
}

class pm_Main_cat_regular_Widget extends WP_Widget {
	
	function pm_Main_cat_regular_Widget()
	{
		$widget_ops = array('classname' => 'widget-main-content', 'description' => 'Recent Post Widget for Main Content');

		$control_ops = array('id_base' => 'pm_main_cat_regular-widget');

		$this->WP_Widget('pm_main_cat_regular-widget', 'PowerMag - HP Category Regular', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		
		$show_excerpt = isset($instance['show_excerpt']) ? 'true' : 'false';
		
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$words_primary = $instance['words-primary'];
		$excerpt_secondary = isset($instance['excerpt-secondary']) ? 'true' : 'false';
		$words_secondary = $instance['words-secondary'];
		$thumb_secondary = isset($instance['thumb-secondary']) ? 'true' : 'false';
		echo $before_widget;
		?>
<?php
		$post_types = get_post_types();
		unset($post_types['page'], $post_types['reviews'], $post_types['gallery'], $post_types['portfolio'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}
		?>


	
	<?php $category_color = get_tax_meta($categories,'pm_color_field_id'); ?>
		
		<div class="widget-title-bg clearfix">

				<h2 class="widget-title">
					<span class="inner" style="background-color: <?php echo $category_color ?>"><a href="<?php echo get_category_link($categories); ?>"><?php echo $title; ?></a></span>
					<?php include( 'cat-diagonal.php'); ?>
				</h2>
			
		</div><!-- .widget-title-bg-->

	
	<a href="<?php echo get_category_link($categories); ?>"></a>
	
	<?php
				$recent_posts = new WP_Query(array(
					'showposts' => $posts,
					'cat' => $categories,
					'post_type' => $post_type_array,
				));
	?>
				
	<?php $count = 1; while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
	<?php if($count == 1): ?>

	<?php //////////// PRIMARY BLOCK //////////// ?>
	
	<?php include ( get_template_directory() . '/inc/rating-values.php'); // Get ratings output ?>
	
	<?php 
	$std_style = of_get_option('pm_blogstyle') == 'default';
	$pm_video = get_post_meta($post->ID, 'pm_video_encode', true);
	$pm_has_video = $pm_video != "";
	?>
	
	<div class="widget-post pm-first clearfix">
		<div class="left-wrap pull-left">
			<div class="img-frame <?php if ( !has_post_thumbnail() ) echo 'no-thumb'?>" style="background-color: <?php echo $category_color ?>">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'block-thumbs', array( 'alt' => get_the_title(), 'title' => get_the_title() ) );
						
						} else {
							
					echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="no-thumb-img"></span></a>'; }
				
					if ( $pm_has_video ) { echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="pm-icon"><i class="icon-play"></i></span></a>'; }
				?>
				
				<?php 			
				
				if ( $pm_review_enable ) { 
			
					if ( $pm_review_type == 'percent' ) {
				
					?>
				
					<div class="entry-rating-wrap">
						<span class="entry-rating"><?php echo $pm_overall_score ?></span>
					</div>
				
					<?php } else { ?>
					
					<div class="rw-criteria stars-preview">
						<span class="criteria-stars-color">
							<span class="criteria-stars-overlay" style="width:<?php echo $pm_overall_score; ?>%"></span>
						</span>
					</div>
					
					<?php } 
				} ?>
				
			</div>
		</div>
			
		<div class="entry-info pull-right">
	
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
			</h3>
			
			<?php if ($instance['words-primary'] != 0) { ?>
			<p>
			<?php echo string_limit_words(get_the_excerpt(), $instance['words-primary']); ?><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"> [...]</a>
			</p>
			<?php } ?>
			
			<div class="entry-meta">
				<span class="entry-date">
					<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago', 'powermag'); ?>
				</span>
				
				<span class="entry-comments">
				<?php comments_number( '0', '1', '%' ); ?>
				</span>
			</div><!--entry-meta-->
			
			<?php include( 'cat-angle.php'); ?>
	
		</div><!--entry-info-->
	</div><!-- .widget-post -->

	<?php else : ?>
	
	
	
	<?php //////////// SECONDARY BLOCK //////////// ?>
	
	<div class="widget-post pm-rest clearfix">
		<div class="entry-info pull-right">
	
			<h4 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
			</h4>
			
			<?php if($thumb_secondary == 'true'): ?>
	
			<div class="img-frame">
			<?php
				$pm_video = get_post_meta($post->ID, 'pm_video_encode', true);
				$pm_has_video = $pm_video != "";
				
				the_post_thumbnail( 'mini-thumbs', array( 'alt' => get_the_title(), 'title' => get_the_title() ));
				
				if ( $pm_has_video ) { echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="pm-icon"><i class="icon-play"></i></span></a>'; }	
			?>
			</div>
			<?php endif; ?>
			
			<?php if($excerpt_secondary == 'true'): ?>
			<p><?php echo string_limit_words(get_the_excerpt(), $instance['words-secondary']); ?><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"> [...]</a></p>
			<?php endif; ?>

			<div class="entry-meta">
				<span class="entry-date">
				<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago', 'powermag'); ?>
				</span>
				
				<span class="entry-comments">
				<?php comments_number( '0', '1', '%' ); ?>
				</span>
			</div>
						
			<?php include( 'cat-angle.php'); ?>
	
		</div><!--entry-info-->
	</div><!-- .widget-post -->
    
    <?php endif; ?>

	<?php $count++; endwhile; 
		  wp_reset_query(); //@since PM 1.7.3 ?>


	<?php //////////// ADMIN SETUP //////////// ?>
	
	<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['words-primary'] = $new_instance['words-primary'];
		$instance['excerpt-secondary'] = $new_instance['excerpt-secondary'];
		$instance['words-secondary'] = $new_instance['words-secondary'];
		$instance['thumb-secondary'] = $new_instance['thumb-secondary'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'categories' => 'all', 'posts' => 3, 'words-primary' => 25, 'excerpt-secondary' => 25, 'words-secondary' => 25, 'thumb-secondary' => false );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">Group Title:</label>
	<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category:</label>
	<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
		<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All categories</option>
		<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
		<?php foreach($categories as $category) { ?>
		<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
		<?php } ?>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id('posts'); ?>">Posts Number</label>
	<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('words-primary'); ?>">Primary Excerpt Words Limit</label>
	<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('words-primary'); ?>" name="<?php echo $this->get_field_name('words-primary'); ?>" value="<?php echo $instance['words-primary']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('excerpt-secondary'); ?>">Show Excerpt for Secondary Posts</label>
	<input class="checkbox" type="checkbox" <?php checked($instance['excerpt-secondary'], 'on'); ?> id="<?php echo $this->get_field_id('excerpt-secondary'); ?>" name="<?php echo $this->get_field_name('excerpt-secondary'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('words-secondary'); ?>">Secondary Excerpt Words Limit</label>
	<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('words-secondary'); ?>" name="<?php echo $this->get_field_name('words-secondary'); ?>" value="<?php echo $instance['words-secondary']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('thumb-secondary'); ?>">Show Post Thumbnail</label>
	<input class="checkbox" type="checkbox" <?php checked($instance['thumb-secondary'], 'on'); ?> id="<?php echo $this->get_field_id('thumb-secondary'); ?>" name="<?php echo $this->get_field_name('thumb-secondary'); ?>" />
</p>

<?php }
}
?>
