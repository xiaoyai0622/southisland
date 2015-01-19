<?php

add_action('widgets_init', 'pm_text_only_widget_custom');

function pm_text_only_widget_custom()
{
	register_widget('pm_Text_only_Widget');
}

class pm_Text_only_Widget extends WP_Widget {
	
	function pm_Text_only_Widget()
	{
		$widget_ops = array('classname' => 'widget-text-only', 'description' => 'Text Only Recent Post Widget for Main Content');

		$control_ops = array('id_base' => 'pm_text_only-widget');

		$this->WP_Widget('pm_text_only-widget', 'PowerMag - HP Text Only', $widget_ops, $control_ops);
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
		$excerpt_secondary = isset($instance['excerpt-secondary']) ? 'true' : 'false';

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
	
	<div class="text-only">			
		<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
		
	
		<?php //////////// OUPUT //////////// ?>
		
		<div class="widget-post pm-rest clearfix">
			<div class="entry-info pull-right">
		
				<h4 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
				</h4>
				
				<?php if($excerpt_secondary == 'true'): ?>
				<p><?php echo string_limit_words(get_the_excerpt(), $instance['words-secondary']); ?><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"> [...]</a></p>
				<?php endif; ?>
	
			</div><!--entry-info-->
		</div><!-- .widget-post -->
	
		<?php  endwhile; 
		wp_reset_query(); //@since PM 1.7.3 ?>
		
		<?php include( 'cat-angle.php'); ?>
	</div><!-- .boxed -->

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
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'categories' => 'all', 'posts' => 3, 'words-primary' => 25, 'excerpt-secondary' => 25, 'words-secondary' => 25 );
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
	<label for="<?php echo $this->get_field_id('excerpt-secondary'); ?>">Show Excerpt</label>
	<input class="checkbox" type="checkbox" <?php checked($instance['excerpt-secondary'], 'on'); ?> id="<?php echo $this->get_field_id('excerpt-secondary'); ?>" name="<?php echo $this->get_field_name('excerpt-secondary'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('words-secondary'); ?>">Words Limit</label>
	<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('words-secondary'); ?>" name="<?php echo $this->get_field_name('words-secondary'); ?>" value="<?php echo $instance['words-secondary']; ?>" />
</p>

<?php }
}
?>
